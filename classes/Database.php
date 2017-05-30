<?php

class Database
{
	protected $host = 'localhost';

	protected $db = 'website';

	protected $username = 'root';

	protected $password = '';

	protected $pdo;

	protected $table;

	protected $stmt;

	public $debug = false;

	public function __construct()
	{
		try
		{
			$this->pdo = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->username, $this->password);
		
			if($this->debug)
			{
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		}
		catch(PDOException $e)
		{
			die($this->debug ? $e->getMessage() : '');
		}
	}

	public function query($sql)
	{
		return $this->pdo->query($sql);
	}

	public function table($table)
	{
		$this->table = $table;

		return $this;
	}

	public function insert($data)
	{
		$keys = array_keys($data);

		$fields = '`' . implode('`, `', $keys) . '`';
		$placeholders = ':' . implode(', :', $keys);

		$sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";

		$this->stmt = $this->pdo->prepare($sql);

		return $this->stmt->execute($data);
	}

	public function where($field, $operator, $value)
	{
		$this->stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE {$field} {$operator} :value");
		
		$this->stmt->execute(['value' => $value]);

		return $this;
	}

	public function exists($data)
	{
		$field = array_keys($data)[0];

		return $this->where($field, '=', $data[$field])->count() ? true : false;
	}

	public function count()
	{
		return $this->stmt->rowCount();
	}

	public function get()
	{
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function first()
	{
		return $this->get()[0];
	}

}