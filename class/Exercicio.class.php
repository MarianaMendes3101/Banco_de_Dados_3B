<?php

class Exercicio extends CRUD{
    protected $table = "exercicio";
    private $id;
    private $nome;
    private $descricao;
    private $grupoMuscular;

    public function add(){
        $sql = "INSERT INTO $this->table (nome, descricao, grupo_muscular) VALUES(:nome, :descricao, :grupo_muscular)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
        $stmt->bindParam(":grupo_muscular",$this->grupoMuscular, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update(){

    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }        
    
    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }


    public function getGrupoMuscular(){
        return $this->grupoMuscular;
    }

    public function setGrupoMuscular($grupoMuscular){
        $this->grupoMuscular = $grupoMuscular;
    }

}