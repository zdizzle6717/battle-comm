<?php
/*
 DMXzone Database Updater
 Version: 1.2.0
 (c) 2013-2014 DMXzone.com
*/

function SqlBuilderEx($cfg) {
	global $adapter;
	return new SqlBuilderEx($cfg, $adapter);
}

class SqlBuilderEx extends SqlBuilder
{
	public function __construct($cfg, $adapter = NULL) {
		parent::__construct($cfg, $adapter);
	}

	public function insert($values) {
		$this->type = 'insert';
		$this->values = $values;
		return $this;
	}

	public function update($values) {
		$this->type = 'update';
		$this->values = $values;
		return $this;
	}

	public function del() {
		$this->type = 'delete';
		return $this;
	}

	protected function parameterizeValues($values) {
		return implode(', ', array_map(array(&$this, 'parameter'), $values));
	}

	protected function compileInsert() {
		return 'INSERT INTO ' . $this->escape($this->table) . ' (' . $this->columnize($this->values) . ') VALUES (' . $this->parameterizeValues($this->values) . ')';
	}

	protected function compileUpdate() {
		return 'UPDATE ' . $this->escape($this->table) . ' SET ' . $this->compileValues($this->values) . ' ' . $this->compileWheres($this->wheres);
	}

	protected function compileDelete() {
		return 'DELETE FROM ' . $this->escape($this->table) . ' ' . $this->compileWheres($this->wheres);
	}

	protected function compileValues($values) {
		return implode(', ', array_map(array(&$this, 'compileValue'), $values));
	}

	protected function compileValue($value) {
		return $this->column($value) . ' = ' . $this->parameter($value);
	}
}

class SqlConnectionEx extends SqlConnection
{
	protected function executeInsert($sql) {
		$statement = $this->pdo->prepare($sql);

		foreach ($sql->params as $key => $param) {
			if ($param->whereType == 'Like') {
				$param->bindValue = $sql->adapter->escapeLikeValue(strval($this->getParamValue($param->value)));
			} else {
				$param->bindValue = $this->convertToDatabaseValue($sql->adapter, $this->getParamValue($param->value), $param->type);
			}
			$param->bindType = $this->getBindingType($sql->adapter, $param->type);
			$statement->bindParam($key + 1, $param->bindValue, $param->bindType);
		}

		$statement->execute();

		return (object)array(
			'identity' => $this->pdo->lastInsertId(),
			'affected' => $statement->rowCount()
		);
	}

	protected function executeUpdate($sql) {
		$statement = $this->pdo->prepare($sql);

		foreach ($sql->params as $key => $param) {
			if ($param->whereType == 'Like') {
				$param->bindValue = $sql->adapter->escapeLikeValue(strval($this->getParamValue($param->value)));
			} else {
				$param->bindValue = $this->convertToDatabaseValue($sql->adapter, $this->getParamValue($param->value), $param->type);
			}
			$param->bindType = $this->getBindingType($sql->adapter, $param->type);
			$statement->bindParam($key + 1, $param->bindValue, $param->bindType);
		}

		$statement->execute();

		return (object)array(
			'affected' => $statement->rowCount()
		);
	}

	protected function executeDelete($sql) {
		$statement = $this->pdo->prepare($sql);

		foreach ($sql->params as $key => $param) {
			if ($param->whereType == 'Like') {
				$param->bindValue = $sql->adapter->escapeLikeValue(strval($this->getParamValue($param->value)));
			} else {
				$param->bindValue = $this->convertToDatabaseValue($sql->adapter, $this->getParamValue($param->value), $param->type);
			}
			$param->bindType = $this->getBindingType($sql->adapter, $param->type);
			$statement->bindParam($key + 1, $param->bindValue, $param->bindType);
		}

		$statement->execute();

		return (object)array(
			'affected' => $statement->rowCount()
		);
	}
}

?>