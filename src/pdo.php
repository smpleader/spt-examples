<?php
/**
 * SPT software - PDO wrapper
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: simpler way to work with PDO
 * 
 */

require_once 'log.php';

class PDOWrapper{
	
	/*
	protected $host;
	protected $username;
	protected $password;
	protected $database;
	*/

	protected $connection;
	public $connected = false;
	private $errors = true;

	function __construct($host, $username, $password, $database, $parameters=array()){
		
		try{ 
			$this->connected = true;

			if( isset($parameters['connection']))
			{
				$this->connection = new PDO($parameters['connection'], $username, $password);
			}
			else
			{
				$this->connection = new PDO("mysql:host=" . $host . ";dbname=" . $database, $username, $password);
			}

			if( isset($parameters['fetch_mode']))
			{
				$this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $parameters['fetch_mode']);
			}
			else
			{
				$this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			}

			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		}
		catch(PDOException $e){
			$this->connected = false;
			if($this->errors === true)
			{
				return $this->error($e->getMessage());
			}else{
				return false;
			}
		}
	}

	function __destruct(){
		$this->connected = false;
		$this->connection = null;
	}

	public function error($error)
	{
		Log::add($error);
	}

	public function fetch($query, $parameters = array()){
		if($this->connected === true)
		{
			try{
				$query = $this->connection->prepare($query);
				$query->execute($parameters);
				return $query->fetch();
			}
			catch(PDOException $e)
			{
				if($this->errors === true)
				{
					return $this->error($e->getMessage());
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}

	public function fetchAll($query, $parameters = array()){
		if($this->connected === true)
		{
			try{
				$query = $this->connection->prepare($query);
				$query->execute($parameters);
				return $query->fetchAll();
			}
			catch(PDOException $e)
			{
				if($this->errors === true)
				{
					return $this->error($e->getMessage());
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}

	public function count($query, $parameters = array())
	{
		if($this->connected === true)
		{
			try{
				$query = $this->connection->prepare($query);
				$query->execute($parameters);
				return $query->rowCount();
			}
			catch(PDOException $e)
			{
				if($this->errors === true)
				{
					$this->error($e->getMessage());
				}
			}
		}

		return false;
	}

	public function insert($query, $parameters = array())
	{
		if($this->connected === true)
		{
			try
			{
				$query = $this->connection->prepare($query);
				$query->execute($parameters);
				return $this->connection->lastInsertId();
			}
			catch(PDOException $e)
			{
				if($this->errors === true)
				{
					$this->error($e->getMessage());
				}
			}
		}
		
		return false;
	}

	public function update($query, $parameters = array())
	{
		return $this->query($query, $parameters);
	}

	public function delete($query, $parameters = array())
	{
		return $this->query($query, $parameters);
	}

	public function query($query, $parameters = array())
	{
		$result = false;

		if($this->connected === true)
		{
			try
			{
				$query = $this->connection->prepare($query);
				$result = $query->execute($parameters); 
			}
			catch(PDOException $e)
			{
				if($this->errors === true)
				{
					$this->error($e->getMessage());
				}
			}
		}
		
		return $result;
	}

	public function tableExists($table){
		if($this->connected === true)
		{
			try{
				$query = $this->count("SHOW TABLES LIKE '$table'");
				return ($query > 0) ? true : false;
			}
			catch(PDOException $e)
			{
				if($this->errors === true)
				{
					return $this->error($e->getMessage());
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}
}

/*

$db = new db("localhost", "root", "password", "database");

$id = 1;

/*
    Calling a query which will return only ONE row. Usage: (query, array with data)
    Returns an array.
*
$db->fetch("SELECT * FROM `table` WHERE `id` = ?", array($id));

/*
    Calling a query which will return multiple rows. Usage: (query, array with data)
    Returns an array.
*
$db->fetchAll("SELECT * FROM `table` ORDER BY `id` ASC");

/*
    Calling a query which will return the total count of rows. Usage: (query, array with data)
    Returns an integer.
*
$db->count("SELECT `id` FROM `table`");

/*
    Calling a query which will insert a row in to a table. This can also create a table. Usage: (query, array with data)
*
$db->insert("INSERT INTO `table` (`id`) VALUES (?)", array($id));

/*
    Calling a query which will update a row in the table. Usage: (query, array with data)
*
$db->update("UPDATE `table` SET `id` = ? WHERE `id` = ?", array(69, $id));

/*
    Calling a query which will delete a row in the table. Usage: (query, array with data)
*
$db->delete("DELETE FROM `table` WHERE `id` = ?", array($id));

/*
    Calling a query which will determine if a table exists in the database. Usage: (table name)
    Returns true or false.
*
echo ($db->tableExists("table") === true) ? "Table exists." : "Table does NOT exist.";
*/