<?php

class Usuario extends CRUD
{
    protected $table = "usuario";
    private int $id;
    private int $username;
    private $email;
    private $senha;
    private $tipoUsuario;
    private $ativo;
    private $logradouro;
    private $bairro;
    private $cidade;
    private $estado;
    private $cep;
    private $objetivo;


    public function add()
    {
        $sql = "INSERT INTO $this->table (username, email, senha, tipo_usuario,:ativo)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":username", $this->username, PDO::PARAM_INT);
        $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
        $stmt->bindParam(":senha", $this->senha, PDO::PARAM_INT);
        $stmt->bindParam(":tipo_usuario", $this->tipoUsuario, PDO::PARAM_STR);
        $stmt->bindParam(":ativo", $this->ativo, PDO::PARAM_STR);
        $stmt->execute();
        $this->id =$this->db->lastInsertid();
        return $this->id;
    }

    public function update()
    {
        $sql = "UPDATE $this->table
                SET fkusuario = :fkusuario, nome = :nome, sexo = :sexo, nascimento = :nascimento, celular = :celular,
                    logradouro = :logradouro, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep, objetivo = :objetivo
                WHERE idaluno = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindParam(":fkusuario", $this->fkusuario, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $this->bindNullable($stmt, ":sexo", $this->sexo);
        $this->bindNullable($stmt, ":nascimento", $this->nascimento);
        $this->bindNullable($stmt, ":celular", $this->celular);
        $this->bindNullable($stmt, ":logradouro", $this->logradouro);
        $this->bindNullable($stmt, ":bairro", $this->bairro);
        $this->bindNullable($stmt, ":cidade", $this->cidade);
        $this->bindNullable($stmt, ":estado", $this->estado);
        $this->bindNullable($stmt, ":cep", $this->cep);
        $this->bindNullable($stmt, ":objetivo", $this->objetivo);
        return $stmt->execute();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int)$id;
    }

    public function getFkusuario()
    {
        return $this->fkusuario;
    }

    public function setFkusuario($fkusuario)
    {
        $this->fkusuario = (int)$fkusuario;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getNascimento()
    {
        return $this->nascimento;
    }

    public function setNascimento($nascimento)
    {
        $this->nascimento = $nascimento;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function getObjetivo()
    {
        return $this->objetivo;
    }

    public function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;
    }
}
