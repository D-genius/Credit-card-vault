CREATE DATABASE vault_2;

  users vault_2;
  
  CREATE TABLE subscribers (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    cardnumber VARBINARY(500) NOT NULL,
    cvv VARBINARY(500), NOT NULL,
    location VARCHAR(50),
    date TIMESTAMP
  );

  CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(30) NOT NULL,
    user_type VARCHAR(20) NOT NULL,
    password VARCHAR(80) NOT NULL,
  ); 