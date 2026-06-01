<?php

class Aluno extends CRUD
{
    protected $table = "aluno";
    private int $id = 0;
    private int $fkusuario = 0;
    private $nome;
    private $sexo;
    private $nascimento;
    private $celular;
    private $logradouro;
    private $bairro;
    private $cidade;
    private $estado;
    private $cep;
    private $objetivo;

    private function bindNullable($stmt, string $parametro, $valor)
    {
        if ($valor === null || $valor === "") {
            $stmt->bindValue($parametro, null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue($parametro, $valor, PDO::PARAM_STR);
        }
    }

    public function all()
    {
        $sql = "SELECT aluno.*, usuario.email
                FROM $this->table
                INNER JOIN usuario ON usuario.idusuario = aluno.fkusuario
                ORDER BY aluno.nome";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function add()
    {
        $sql = "INSERT INTO $this->table (fkusuario, nome, sexo, nascimento, celular, logradouro, bairro, cidade, estado, cep, objetivo)
                VALUES (:fkusuario, :nome, :sexo, :nascimento, :celular, :logradouro, :bairro, :cidade, :estado, :cep, :objetivo)";
        $stmt = $this->db->prepare($sql);
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
