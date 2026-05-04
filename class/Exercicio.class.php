<?php

class Exercicio extends CRUD{
    protected $table = "Exercicio";
    private $id;
    private $nome;
    private $descricao;
    private $grupoMuscular;

    public function add(){

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