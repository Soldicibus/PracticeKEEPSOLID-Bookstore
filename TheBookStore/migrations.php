<?php

class Migration {
  
  private $mysqli;

  public function __construct($host, $user, $password, $database) {
    // Create a database connection object
    $this->mysqli = new mysqli($host, $user, $password);
    
    // Check if connection is successful
    if ($this->mysqli->connect_errno) {
      die("Failed to connect to MySQL: " . $this->mysqli->connect_error);
    }

    // Create the database if it doesn't exist
    $this->mysqli->query("CREATE DATABASE IF NOT EXISTS $database");
    
    // Select the database
    $this->mysqli->select_db($database);
  }

  public function create_tables() {
    // Create the Book table
    $this->mysqli->query("
      CREATE TABLE IF NOT EXISTS Book (
        book_id INT(11) PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        publication_date DATE NOT NULL,
        genre_id INT(11) NOT NULL,
        author_id INT(11) NOT NULL,
        FOREIGN KEY (genre_id) REFERENCES Genre(genre_id),
        FOREIGN KEY (author_id) REFERENCES Author(author_id)
      )
    ");

    // Create the Genre table
    $this->mysqli->query("
      CREATE TABLE IF NOT EXISTS Genre (
        genre_id INT(11) PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL
      )
    ");

    // Create the Author table
    $this->mysqli->query("
      CREATE TABLE IF NOT EXISTS Author (
        author_id INT(11) PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        biography TEXT NOT NULL
      )
    ");

    // Create the User table
    $this->mysqli->query("
      CREATE TABLE IF NOT EXISTS User (
        user_id INT(11) PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL
      )
    ");

    // Create the UserRole table
    $this->mysqli->query("
      CREATE TABLE IF NOT EXISTS UserRole (
        user_role_id INT(11) PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL
      )
    ");
  }

  public function drop_tables() {
    // Drop the Book table
    $this->mysqli->query("DROP TABLE IF EXISTS Book");

    // Drop the Genre table
    $this->mysqli->query("DROP TABLE IF EXISTS Genre");

    // Drop the Author table
    $this->mysqli->query("DROP TABLE IF EXISTS Author");

    // Drop the User table
    $this->mysqli->query("DROP TABLE IF EXISTS User");

    // Drop the UserRole table
    $this->mysqli->query("DROP TABLE IF EXISTS UserRole");
  }

  public function __destruct() {
    // Close database connection
    $this->mysqli->close();
  }

}

$a = new Migration('localhost', 'root', '', 'project');
$a->create_tables();
?>
