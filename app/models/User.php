<?php
class User
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  // regsiter the user
  public function register($data)
  {
    $this->db->query('INSERT INTO users (first_name, last_name, email, phone_number, birth_year, password) VALUES (:first_name, :last_name, :email, :phone_number, :birth_year, :password)');

    // bind values
    $this->db->bind(':first_name', $data['first_name']);
    $this->db->bind(':last_name', $data['last_name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':phone_number', $data['phone_number']);
    $this->db->bind(':birth_year', $data['birth_year']);
    $this->db->bind(':password', $data['password']);

    // execute
    return ($this->db->execute()) ? true : false;
  }

  // login user
  public function login($email, $password)
  {
    $this->db->query('SELECT * FROM users WHERE email = :email');

    // bind value
    $this->db->bind(':email', $email);

    // execute
    if ($row = $this->db->single()) {
      $hashed_password = $row->password;
    } else {
      $hashed_password = '';
    }

    return (password_verify($password, $hashed_password)) ? $row : false;
  }

  // find user by email
  public function findUserByEmail($email)
  {
    $this->db->query('SELECT * FROM users WHERE email = :email');

    // bind value
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    // check row
    return ($this->db->rowCount() > 0) ? true : false;
  }

  public function getUsersAtoK()
  {
    $this->db->query("select * from users where last_name REGEXP '^[a-k]' order by last_name");
    return $this->db->resultSet();
  }
}
