<?php

namespace modules;

use \lib\core\Module;
use \lib\db\Connection;
use \lib\db\SqlBuilder;

class dbupdater extends Module
{
	public function insert($options) {
		option_require($options, 'connection');
		option_require($options, 'sql');
		option_require($options->sql, 'table');

		$options = $this->parseOptions($options);

        $options->sql->type = 'insert';

        $connection = $this->app->scope->get($options->connection);

        if ($connection === NULL) {
            throw new \Exception('Connection "' . $options->connection . '" not found.');
        }

        $sql = new SqlBuilder($this->app, $connection);

        $sql->fromJSON($options->sql);
		$sql->compile();

		if (isset($options->test)) {
			return (object)array(
				'query' => $sql->query,
				'params' => $sql->params
			);
		}

        return $connection->execute($sql->query, $sql->params);
	}

	public function update($options) {
		option_require($options, 'connection');
		option_require($options, 'sql');
		option_require($options->sql, 'table');

		$options = $this->parseOptions($options);

        $options->sql->type = 'update';

        $connection = $this->app->scope->get($options->connection);

        if ($connection === NULL) {
            throw new \Exception('Connection "' . $options->connection . '" not found.');
        }

        $sql = new SqlBuilder($this->app, $connection);

        $sql->fromJSON($options->sql);
		$sql->compile();

		if (isset($options->test)) {
			return (object)array(
				'query' => $sql->query,
				'params' => $sql->params
			);
		}

        return $connection->execute($sql->query, $sql->params);
	}

	public function delete($options) {
		option_require($options, 'connection');
		option_require($options, 'sql');
		option_require($options->sql, 'table');

		$options = $this->parseOptions($options);

        $options->sql->type = 'delete';

        $connection = $this->app->scope->get($options->connection);

        if ($connection === NULL) {
            throw new \Exception('Connection "' . $options->connection . '" not found.');
        }

        $sql = new SqlBuilder($this->app, $connection);

        $sql->fromJSON($options->sql);
		$sql->compile();

		if (isset($options->test)) {
			return (object)array(
				'query' => $sql->query,
				'params' => $sql->params
			);
		}

        return $connection->execute($sql->query, $sql->params);
	}

	public function execute($options) {
		option_require($options, 'connection');
		option_require($options, 'query');
		option_default($options, 'params', array());

		$options = $this->app->parseObject($options);

        $connection = $this->app->scope->get($options->connection);

        if ($connection === NULL) {
            throw new \Exception('Connection "' . $options->connection . '" not found.');
        }

		return $connection->execute($options->query, $options->params);
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
