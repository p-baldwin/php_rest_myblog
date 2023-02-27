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

            // Get Single Category
            public function read_single() {
                // Create Select Query
                $query = "SELECT 
                                id,
                                name,
                                created_at
                            FROM 
                                {$this->table}
                            WHERE 
                                id = ?";
    
                // Prepare Statement
                $stmt = $this->conn->prepare($query);
    
                // Bind Parameter to Query
                $stmt->bindParam(1, $this->id);
    
                // Execute Query
                $stmt->execute();
    
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
                // Set Properties
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->created_at = $row['created_at'];
    
                // Return results of executing Query
                return $stmt;
            }

        // Create New Category
        public function create() {
            // Create Insert Query
            $query = "INSERT INTO 
                            {$this->table}
                            (id,
                            name)
                        VALUES 
                            (:id,
                            :name)";

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Sanitize Data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));

            // Bind Parameters
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);

            // Execute Query
            if($stmt->execute()) {
                // Return true on success
                return true;
            } else {
                // Return false and print error on failure
                printf("Error: %s. \n", $stmt->error);
                return false;
            }
        }

        // Update Existing Category
        public function update() {
            // Create Update Query
            $query = "UPDATE 
                            {$this->table}
                        SET
                            name = :name
                        WHERE 
                            id = :id";

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Sanitize Data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));

            // Bind Parameters
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);

            // Execute Query
            if($stmt->execute()) {
                // Return true on success
                return true;
            } else {
                // Return false and print error on failure
                printf("Error: %s. \n", $stmt->error);
                return false;
            }
        }

        // Delete Category
        public function delete() {
            // Create Update Query
            $query = "DELETE FROM 
                            {$this->table}
                        WHERE 
                            id = :id";

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Sanitize Data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind Parameter
            $stmt->bindParam(':id', $this->id);

            // Execute Query
            if($stmt->execute()) {
                // Return true on success
                return true;
            } else {
                // Return false and print error on failure
                printf("Error: %s. \n", $stmt->error);
                return false;
            }
        }
    }