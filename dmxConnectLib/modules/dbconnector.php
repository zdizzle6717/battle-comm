<?php

namespace modules;

use \lib\core\Module;
use \lib\db\Connection;
use \lib\db\SqlBuilder;

class dbconnector extends Module
{
    public function connect($options) {
        return new Connection($this->app, $this->app->parseObject($options));
    }

    public function select($options) {
        option_require($options, 'connection');
        option_require($options, 'sql');
        option_require($options->sql, 'table');

        $options = $this->parseOptions($options);

        $options->sql->type = 'select';

        $connection = $this->app->scope->get($options->connection);

        if ($connection === NULL) {
            throw new \Exception('Connection "' . $options->connection . '" not found.');
        }

        $sql = new SqlBuilder($this->app, $connection);

        $sql->fromJSON($options->sql);
        $sql->compile();

        return $connection->execute($sql->query, $sql->params);
    }

    public function count($options) {
        option_require($options, 'connection');
        option_require($options, 'sql');
        option_require($options->sql, 'table');

        $options = $this->parseOptions($options);

        $options->sql->type = 'count';

        $connection = $this->app->scope->get($options->connection);

        if ($connection === NULL) {
            throw new \Exception('Connection "' . $options->connection . '" not found.');
        }

        $sql = new SqlBuilder($this->app, $connection);

        $sql->fromJSON($options->sql);
        $sql->compile();

        $result = $connection->execute($sql->query, $sql->params);

        return $result[0]['Total'];
    }

    public function paged($options) {
        option_require($options, 'connection');
        option_require($options, 'sql');
        option_require($options->sql, 'table');
        option_default($options->sql, 'offset', '{{$_GET.offset}}');
        option_default($options->sql, 'limit', '{{$_GET.limit}}');

        $options = $this->parseOptions($options);

        if (is_null($options->sql->offset)) $options->sql->offset = 0;
        if (is_null($options->sql->limit)) $options->sql->limit = 25;

        $connection = $this->app->scope->get($options->connection);

        if ($connection === NULL) {
            throw new \Exception('Connection "' . $options->connection . '" not found.');
        }

        $sql = new SqlBuilder($this->app, $connection);

        $options->sql->type = 'count';
        $sql->fromJSON($options->sql);
        $sql->compile();
        $result = $connection->execute($sql->query, $sql->params);
        $total = $result[0]['Total'];

        $options->sql->type = 'select';
        $sql->fromJSON($options->sql);
        $sql->compile();
        $result = $connection->execute($sql->query, $sql->params);

        return array(
            'offset' => intval($options->sql->offset),
            'limit' => intval($options->sql->limit),
            'total' => intval($total),
            'page' => array(
                'offset' => array(
                    'first' => 0,
                    'prev' => intval($options->sql->offset - $options->sql->limit > 0 ? $options->sql->offset - $options->sql->limit : 0),
                    'next' => intval($options->sql->offset + $options->sql->limit < $total ? $options->sql->offset + $options->sql->limit : $options->sql->offset),
                    'last' => (ceil($total / $options->sql->limit)-1) * $options->sql->limit
                ),
                'current' => floor($options->sql->offset / $options->sql->limit)+1,
                'total' => ceil($total / $options->sql->limit)
            ),
            'data' => $result
        );
    }

    protected function parseOptions($options) {
        $props = array('values', 'wheres', 'orders');

        foreach ($props as $prop) {
            if (isset($options->sql->{$prop})) {
                $options->sql->{$prop} = array_filter($options->sql->{$prop}, array($this, 'filter'));
            }
        }

        return $this->app->parseObject($options);
    }

	protected function filter($val) {
		if (!isset($val->condition)) return TRUE;
		return $this->app->parseObject($val->condition);
	}
}
