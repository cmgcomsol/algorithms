<?php
class NoSQLSqlite3
{
	private $conn;
	public $keylist = [];

	function __construct($pathtofile)
	{
		//echo getcwd();
		if (!file_exists($pathtofile)) {
			//echo "<br/>creating new db";
			$this->conn = new SQLite3($pathtofile);
			assert(is_file($pathtofile), "NoSqlite File not created");
			//echo "<br/>creating new table";
			$this->conn->exec("CREATE TABLE 'tb' ('key' BLOB,'value' BLOB, PRIMARY KEY('key')) without rowid;");
			//echo "<br/>created table";
			//echo $this->conn->lastErrorMsg();

		} else {
			//echo "<br/>already existing db";
			$this->conn = new SQLite3($pathtofile);
		}
		$this->getKeylist();
	}

	function getKeylist()
	{
		$result = $this->conn->query("select key from  tb order by key");
		$this->keylist = [];
		while ($row = $result->fetchArray()) {
			$this->keylist[] = $row['key'];
		}

		return $this->keylist;
	}

	function get($key)
	{
		if (array_search($key, $this->keylist) === false) {
			//var_dump(array_search($key, $this->keylist));
			return null;
		}
		$query = "select value from  tb where key='{$key}'";
		//var_dump($query);
		$result = $this->conn->query($query);
		$row = $result->fetchArray();
		//var_dump($row);
		return $row['value'];
	}

	function getJson($key)
	{
		return json_decode($this->get($key), true);
	}

	function set($key, $value)
	{
		assert(gettype($value) == 'string', "Value must be of string type");

		if (array_search($key, $this->keylist) === false) { // key not found
			$this->keylist[] = $key;
			$query = "insert into tb values('{$key}','{$value}')";
			return $this->conn->exec($query);
		} else {
			$query = "update tb set value='{$value}' where key='{$key}'";
			return $this->conn->exec($query);
		}
	}

	function del($key)
	{
		$query = "delete from tb where key='{$key}'";

		return $this->conn->exec($query);
	}
}
