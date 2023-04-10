<?php
require_once __DIR__."/../Config.class.php";

    class BaseDao{
        private $conn;
        private $table_name;

        public function __construct($table_name){
        try {
          $this->table_name = $table_name;
          $servername = Config::DB_HOST();
          $username = Config::DB_USERNAME();
          $password = Config::DB_PASSWORD();
          $schema = Config::DB_SCHEMA();;
          $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
          // set the PDO error mode to exception
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
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
            $query = "UPDATE " . $this->table_name . " SET ";
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