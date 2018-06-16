<?php

namespace Camagru;

function sql_build_query($params) {
	if (array_key_exists("id", $params)) {
		unset($params["id"]);
	}

	$fields = array();
	foreach ($params as $key => $value) {
		$fields[] = "$key=$value";
	}
	return join(", ", $fields);
}

function fill_models($array, $class_name) {
	$instances = [];
	foreach($array as $object) {
		$instance = new $class_name($object);
		array_push($instances, $instance);
	}
	return $instances;
}

abstract class Model {
	protected static $tableName = null;
	protected $id;

	public final function __construct(array $data) {
		foreach ($data as $var => $value) {
			if (property_exists(static::class, $var)) {
				$this->$var = $value;
			}
		}
	}

	private final function vars() {
		$reflect = new \ReflectionClass($this);
		$vars = [];
		$props = $reflect->getProperties(\ReflectionProperty::IS_PROTECTED);
		foreach ($props as $prop) {
			$var = $prop->getName();
			$vars[$prop->getName()] = $this->$var;
		}
		return $vars;
	}

	public function getId() {
		return $this->id;
	}

	protected static function getTableName() {
		return strtolower(
			array_pop(preg_split('#\\\#', static::class))
		);
	}

	public function save() {
		$object_vars = array_filter($this->vars());
		$table_name = $this->getTableName();
		$array_keys = implode(", ", array_keys($object_vars));
		$array_symbols = array_map(
			function ($str) {
				return ":" . $str;
			}, array_keys($object_vars)
		);
		if (array_key_exists("id", $object_vars)) {
			$array_keys_symbols = array_combine(
				array_keys($object_vars),
				$array_symbols
			);
			$sql_query = "UPDATE $table_name SET " .
				sql_build_query($array_keys_symbols) .
				" WHERE $table_name.id = $this->id;";
			unset($object_vars["id"]);
		} else {
			$sql_query = "INSERT INTO $table_name($array_keys) VALUES(" .
				implode(", ", $array_symbols) . ");";
		}
		\Camagru\Db::query($sql_query, $object_vars);
	}

	public function delete() {
		if ($this->getId()) {
			$pdo = \Camagru\Db::getPDO();
			$table_name = $this->getTableName();
			$pdo->beginTransaction();
			$stmt = $pdo->prepare(
				"DELETE FROM '$table_name' WHERE '$table_name'.'id' = :id;"
			);
			$stmt->execute(array("id" => $this->getId()));
			$pdo->commit();
		}
	}

	/**
	 * @param $column
	 * @param $value
	 * @return static
	 */
	public static function find($column, $value) {
		$pdo = \Camagru\Db::getPDO();
		$class_name = static::class;
		$table_name = static::getTableName();

		$sql_query = "SELECT * FROM $table_name WHERE $table_name.
			$column = '$value' LIMIT 1;";
		$query = $pdo->query($sql_query);
		$model = $query->fetch();
		if (empty($model)) {
			return null;
		} else {
			return new $class_name($model);
		}
	}

	/**
	 * @param $column
	 * @param $value
	 * @return static[]
	 */
	public static function where($column, $value) {
		$pdo = \Camagru\Db::getPDO();
		$class_name = static::class;
		$table_name = static::getTableName();

		$sql_query = "SELECT * FROM $table_name WHERE $table_name.
            $column = '$value';";
		$query = $pdo->query($sql_query);
		$models = $query->fetchAll();
		return fill_models($models, $class_name);
	}

	/**
	 * @return static[]
	 */
	public static function all() {
		$pdo = \Camagru\Db::getPDO();
		$class_name = static::class;
		$table_name = static::getTableName();

		$sql_query = "SELECT * FROM $table_name;";
		$query = $pdo->query($sql_query);
		$models = $query->fetchAll();
		return fill_models($models, $class_name);
	}
}
