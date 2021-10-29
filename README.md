# creditcardvault

A Credit Card Vault application that collects Credit Card information from a customer and stores them securely in a database
Safely collect private data from your customers using cryptography

CreditCardVault is a simple Php application demo aiming to provide better security for data collected through landing pages. This demo encrypts cardnumber and cvv of the subscribers, making it very hard for an attacker to leak private data, even if he/she gains access to the database. An Admin user is allowed to perform all CRUD operations on the Subscribers data.

# Requirements

    An Apache web server
    Php 7.1 or more
    Mysql or MariaDB

# Installation

Download or pull from git.

    First you need to initialize the database
    Go to config.php and alter the $host = "myhostname" , $username= "myusername" , $password= "mypassword"
    Navigate to install.php in the frontend and it will setup a vault_2 database with 2 new tables table users and table subscribers.
    You may remove /data folder and install.php as they are no longer necessary nnow.
    Now navigate to register.php register a user and make the user admin at the backend.
    You now have full access to the application.
    Any person  can now register as a user and add his/her credit card information
    The admin can also create users with different user_types.
