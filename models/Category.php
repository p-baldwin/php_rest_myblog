<?php
// Categories Class
    class Category {
        // DB Connection Properties
        private $conn;
        private $table = 'categories';

        // Category Properties
        public $id;
        public $name;
        public $created_at;

        // Post Class Constructor. Expects a DB Connection in $db.
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Categories
        public function read() {
            // Create Select Query
            $query = "SELECT
                            id,
                            name,
                            created_at
                        FROM
                            {$this->table}
                        ORDER BY
                            created_at DESC";

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute Query
            $stmt->execute();

            // Return results of executing Query
            return $stmt;
        }

    }