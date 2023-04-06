<?php
    class BaseDao{
        private $conn;
        private $host = 'localhost';
        private $database = 'lab4_db';
        private $username = 'root';
        private $password = 'root';

        private $table_name;

        public function __construct($table_name){
            try {
                $this->table_name = $table_name;
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        
        
        function get_all() {
            $stmt = $this->conn->prepare("SELECT * FROM ". $this->table_name);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        function get_by_id($id) {
            $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id = :id", ["id" => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        function delete($id) {
            $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = :id", ["id" => $id]);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
        }  

        function add($entity) {
            $query = "INSERT INTO " . $this->table_name . " (";

            foreach($entity as $column => $value){
                $query.=$column . ', ';
            }
            $query = substr($query, 0, -2);
            $query.= ") VALUES (";
            foreach($entity as $column => $value){
                $query.=":" . $column . ', ';
            }
            $query = substr($query, 0, -2);
            $query.=")";
             

            $stmt = $this->conn->prepare($query);
            $stmt->execute($entity);
            $entity['id'] = $this->conn->lastInsertId();
            return $entity ;
        } 

        function update($id, $entity, $id_column = "id") {
            $query = "UPDATE " . $this->table_name . "SET ";
            foreach($entity as $column => $value){
                 $query.= $column . "=:" . $column . ", ";
            }
            $query = substr($query, 0, -2);
            $query.= " WHERE $id_column = :id";
            $stmt = $this->conn->prepare($query);
            $entity['id'] = $id;
            $stmt->execute($entity);
            return $entity;
        }
    }
?>