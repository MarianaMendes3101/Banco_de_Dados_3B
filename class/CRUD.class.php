<?php

abstract class CRUD{
    protected $table;
    protected $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    abstract public function add();
    abstract public function update();

    public function all(){
        $sql = "SELECT * FROM $this->table"; 
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


}