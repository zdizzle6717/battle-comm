<?php
/*
 DMXzone Database Connector
 Version: 1.2.0
 (c) 2013-2014 DMXzone.com
*/

$adapter = 'mysql';

class Adapter_mysql extends Adapter
{
	public $typeMapping = array(
		'tinyint'       => 'smallint',
		'smallint'      => 'smallint',
		'mediumint'     => 'integer',
		'int'           => 'integer',
		'integer'       => 'integer',
		'bigint'        => 'bigint',
		'tinytext'      => 'text',
		'mediumtext'    => 'text',
		'longtext'      => 'text',
		'text'          => 'text',
		'varchar'       => 'string',
		'string'        => 'string',
		'char'          => 'string',
		'date'          => 'date',
		'datetime'      => 'datetime',
		'timestamp'     => 'datetime',
		'time'          => 'time',
		'float'         => 'float',
		'double'        => 'float',
		'real'          => 'float',
		'decimal'       => 'decimal',
		'numeric'       => 'decimal',
		'year'          => 'string'
	);

	public $LikeFormat = array(
		'starts with'     => "%s LIKE CONCAT(%s, '%%') ESCAPE '!'",
		'not starts with' => "%s NOT LIKE CONCAT(%s, '%%') ESCAPE '!'",
		'ends with'       => "%s LIKE CONCAT('%%', %s) ESCAPE '!'",
		'not ends with'   => "%s NOT LIKE CONCAT('%%', %s) ESCAPE '!'",
		'contains'        => "%s LIKE CONCAT('%%', %s, '%%') ESCAPE '!'",
		'not contains'    => "%s NOT LIKE CONCAT('%%', %s, '%%') ESCAPE '!'"
	);

	public function getIdentifierQuoteCharacter() {
		return '`';
	}

	public function getVarcharMaxLength() {
		return 65535;
	}

	public function getConcatExpression() {
		$args = func_get_args();
		return 'CONCAT(' . implode(', ', $args) . ')';
	}
}

?>