<?php

namespace Framework\Lib;
// all the models extends this abstract model
class AbstractModel
{
	public static $db; 

	##### BuildSQLstring ##########
	// Parameters :- None
	// Return :- SQL Query
	//Purpose :- every database table has a model only for it
	// so because of that at every model we create an array contains the table's columns
	// and then we loop that array and arrange these coulmns and put the data on it and by that
	// this function can really generate the sql strings like insert and update
	###########################
	private function BuildSQLstring()
	{
		$params = '';
	 	foreach ($this->tableSchema as $columnName) {
	 		if ($this->$columnName != null) {
		 		if (is_int($this->$columnName)) {
		 			$params .= $columnName . ' = ' . $this->$columnName . ', ';
		 		} else {
		 			$params .= $columnName . " = '" . $this->$columnName . "', ";
		 		}
	 		}
	 	}
	 	return trim($params, ', ');
	}

	##### Create ##########
	// Parameters :- None
	// Return Type :- true/false
	// Purpose :- inserts data to the database,
	// this function uses the $tableName variable at the model and the BuildSQLstring function
	// to generate the whole SQL insert query automaticly.
	###########################
	public function Create()
	{
		$sql = 'INSERT INTO ' . static::$tableName . ' SET ' . self::BuildSQLstring();
        $stmt = self::$db->prepare($sql);
		if ($stmt->execute()) {
			$this->{static::$pk} = self::$db->lastInsertId();
			return true;
		}
	}

	##### Delete ##########
	// Parameters :- a: Primary Key
	// Return Type :- true/false
	// Purpose :- deletes something from the database, uses the $tableName variable at the model to figure out where 
	// to delete from
	###########################
	public static function Delete($pk)
	{
		$sql = 'DELETE FROM ' . static::$tableName . ' WHERE ' . $pk;
        $stmt = self::$db->prepare($sql);
		if ($stmt->execute()) {
			return true;
		}
	}

	##### Update ##########
	// Parameters :- a: Primary Key
	// Return Type :- true/false
	// Purpose :- same as the Create function above, but for updating instead of creating a new entry
	###########################
	public function Update($pk)
	{
		$sql = 'UPDATE ' . static::$tableName . ' SET ' . self::BuildSQLstring() . ' WHERE '.$pk;
        $stmt = self::$db->prepare($sql);
		if ($stmt->execute()) {
			return true;
		}
	}

	##### Count ##########
	// Parameters :- None
	// Return :- count (INT)
	// Purpose :- get the count of some database table ie. Products / Subscribers
	###########################
	public static function Count($options = '')
	{
		$sql = "SELECT * FROM " . static::$tableName . ' ' . $options;
		$stmt = self::$db->prepare($sql);
		$stmt->execute();
		$count = $stmt->rowCount();
		return $count;
	}

	public static function getAll($options = '')
	{
		$sql = "SELECT * FROM " . static::$tableName . ' ' . $options;
		$stmt = self::$db->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
		return $results;
	}

	public static function getOne($id)
	{
		$sql = "SELECT * FROM " . static::$tableName . " WHERE " . $id;
		$stmt = self::$db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchObject(__CLASS__);
		return $result;
	}

	public static function getSQL($sql, $fetch = false)
	{
		$sql = $sql;
		$stmt = self::$db->prepare($sql);
		$stmt->execute();
		if ($fetch != false) {
			$results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
			$results = array_shift($results);
		} else {
			$results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
		}
		return $results;
	}
}

