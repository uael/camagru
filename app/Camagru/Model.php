<?php

namespace Camagru;

abstract class Model {
	private $tableName = null;
	protected $id;

	public abstract function __construct(array $data);

	public function getId() {
		return $this->id;
	}

	protected function getTableName() {
		if (!$this->tableName)
			$this->tableName = strtolower(array_pop(preg_split('#\\\#', static::class)));
		return $this->tableName;
	}

	public function save() {
		$object_vars = array_filter(get_object_vars($this));
		$table_name = $this->getTableName();

		$array_keys = implode(", ", array_keys($object_vars));
		$array_symbols = array_map(
			function ($str) {
				return ":" . $str;
			}, array_keys($object_vars)
		);
		if (array_key_exists("id", $object_vars)) {
			$array_keys_symbols = array_combine(array_keys($object_vars), $array_symbols);
			$sql_query = "UPDATE $table_name SET " . sql_build_query($array_keys_symbols) . " WHERE $table_name.id = $this->id;";
			unset($object_vars["id"]);
		} else {
			$sql_query = "INSERT INTO $table_name($array_keys) VALUES(" . implode(", ", $array_symbols) . ");";
		}
		\Camagru\Service\Db::query($sql_query, $object_vars);
	}
}
