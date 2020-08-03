<?php
namespace lib;

use Exception;

class User
{
    private $db;
    private $data =[];
    public $sessionName;


    public function __construct($user = null)
    {
        $this->db = Db::getInstance();
        $this->sessionName = Config::get('session/session_name');
        if ($user === null) {
            $this->getUser($this->getUserIdFromSession(), true);
        }
    }

    protected function getUserIdFromSession()
    {
        return (Session::exists($this->sessionName) && Session::get($this->sessionName)) ? Session::get($this->sessionName) : null;
    }

    public function create($fields = [])
    {
        if (!$this->db->query("INSERT INTO users(login, password, name, email) VALUES (:login, :password, :name, :email)", $fields)) {
            throw new Exception('There was a problem creating account');
        }
    }

    public function update($fields = [])
    {
        if (!$this->db->query("UPDATE users SET  password = :password, name = :name WHERE id = :id", $fields)) {
            throw new Exception('There was a problem creating account');
        }
    }

    protected function getUser($needle, $byId = false)
    {
        if ($byId) {
            $data = $this->db->fetchSingle('SELECT * FROM users WHERE id = :id', ['id'=>$needle]);
        } else {
            $data = $this->db->fetchSingle('SELECT * FROM users WHERE login = :login', ['login'=>$needle]);
        }
        
        if ($this->db->rowCount() === 0) {
            return false;
        }
        $this->data = $data;

        return $data;
    }

    public function isFound($needle = null, $byId = false)
    {
        return ($this->getUser($needle, $byId)) ? true : false;
    }

    public function login($userName = null, $password = null)
    {
        if (!$this->isFound($userName)) {
            return false;
        }

        if (Hash::isVerified($password, $this->data['password'])) {
            Session::set($this->sessionName, $this->data['id']);
            return true;
        }

        return false;
    }

    public function getUserData()
    {
        return $this->data;
    }

    public function logOut()
    {
        Session::delete($this->sessionName);
    }

    public function isLoggedIn()
    {
        return (Session::exists($this->sessionName)) ? true : false;
    }
}
