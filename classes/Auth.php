<?php

class Auth
{
	protected $db;

	protected $hash;

	protected $session = 'user';

	protected $table = 'users';

	public function __construct(Database $database, Hash $hash)
	{
		$this->db = $database;

		$this->hash = $hash;
	}

	public function build()
	{
		return $this->db->query("
			CREATE TABLE IF NOT EXISTS users
			(id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			email VARCHAR(200) NOT NULL UNIQUE,
			username VARCHAR(20) NOT NULL UNIQUE,
			password VARCHAR(255) NOT NULL)
		");
	}

	public function create($data)
	{
		if(isset($data['password']))
		{
			$data['password'] = $this->hash->make($data['password']);
		}

		return $this->db->table($this->table)->insert($data);
	}

	public function signin($data)
	{
		$user = $this->db->table($this->table)->where('username', '=', $data['username']);

		if($user->count())
		{
			$user = $user->first();

			if($this->hash->verify($data['password'], $user->password))
			{
				$this->setAuthSession($user->id);

				return true;
			}
		}

		return false;
	}

	public function check()
	{
		return isset($_SESSION[$this->session]);
	}

	public function signout()
	{
		unset($_SESSION[$this->session]);
	}

	protected function setAuthSession($id)
	{
		$_SESSION[$this->session] = $id;
	}
}