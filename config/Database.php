<?php
    class Database {
        // DB Parameters
        private $host = 'localhost';
        private $port = '5432';
        private $db_name = "";
        private $username = "";
        private $password = "";
        private $conn;

        // DB Connection Function
        public function connect() {
            $this->conn = null;

            // Get the DB name and credentials from the environment
            $this->db_name = getenv('HTTP_DBNAME');
            $this->username = getenv('HTTP_DBUSER');
            $this->password = getenv('HTTP_DBPASSWORD');
            
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";
            try {
                // Create the DB Connection
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Connection Error: {$e->getMessage()}";
            }

            // Return the DB Connection
            return $this->conn;
        }
    }