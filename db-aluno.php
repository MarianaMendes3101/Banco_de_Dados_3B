<?php

spl_autoload_register(function ($class) {
    require_once "class/{$class}.class.php";
});

$aluno = new Aluno();

function campoOuNull($campo)
{
    $valor = filter_input(INPUT_POST, $campo, FILTER_SANITIZE_STRING);
    return $valor === "" ? null : $valor;
}

if (filter_has_var(INPUT_POST, "btnGravar")) {
    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
    $fkusuario = filter_input(INPUT_POST, "fkusuario", FILTER_SANITIZE_NUMBER_INT);

    try {
        if ((int)$id <= 0 && (int)$fkusuario <= 0) {
            $username = trim((string) filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING));
            $email = trim((string) filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
            $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);
            $confirmaSenha = filter_input(INPUT_POST, "confirma_senha", FILTER_SANITIZE_STRING);

            if (empty($username) || empty($email) || empty($senha)) {
                header("Location:ger-aluno.php?erro=campos_usuario");
                exit;
            }

            if ($senha !== $confirmaSenha) {
                header("Location:ger-aluno.php?erro=senha");
                exit;
            }

            $db = Database::getInstance()->getConnection();
            $sql = "INSERT INTO usuario (username, email, senha, tipo_usuario, ativo)
                    VALUES (:username, :email, :senha, 'ALUNO', 1)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
            $fkusuario = $db->lastInsertId();
        }

        if ((int)$fkusuario <= 0) {
            header("Location:ger-aluno.php?erro=usuario");
            exit;
        }

        $aluno->setId($id);
        $aluno->setFkusuario($fkusuario);
        $aluno->setNome(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING));
        $aluno->setSexo(campoOuNull("sexo"));
        $aluno->setNascimento(campoOuNull("nascimento"));
        $aluno->setCelular(campoOuNull("celular"));
        $aluno->setLogradouro(campoOuNull("logradouro"));
        $aluno->setBairro(campoOuNull("bairro"));
        $aluno->setCidade(campoOuNull("cidade"));
        $aluno->setEstado(campoOuNull("estado"));
        $aluno->setCep(campoOuNull("cep"));
        $aluno->setObjetivo(campoOuNull("objetivo"));

        $usuario->setId($id);
        $usuario->setUsername(filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING));
        $usuario->setEmail(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
        $senha->setEmail(filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING));
        $usuario->setSenha(password_hash($senha, PASSWORD_DEFAULT));
        $usuario->setTipoUsuario("Aluno");
        $usuario->setAtivo(1);
       
        if ($aluno->getId() > 0) {
            if ($aluno->update()) {
                header("Location:alunos.php");
            }
        } else {
            $usuario->iniciarTransacao();
            try {
                $usuario->add();
                $usuario->setFkusuario($usuario->getId());
                if($aluno->add()){
                    $usuario->confirmaTransacao();
                    header("Location:alunos.php?status=sucesso");
                    exit;
                }                
            } catch (\Throwable $e){
                $usuario->cancelarTransacao();
                header("Location:alunos.php?status=erro");
                    exit;
            }

            if ($aluno->add()) {
                header("Location:alunos.php");
            }
        }
    } catch (PDOException $e) {
        $erro = $e->getCode() == 23000 ? "email" : "salvar";
        header("Location:ger-aluno.php?erro={$erro}");
        exit;
    }
} elseif (filter_has_var(INPUT_POST, "btn-deletar")) {
    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

    try {
        $db = Database::getInstance()->getConnection();
        $db->beginTransaction();

        $stmt = $db->prepare("SELECT fkusuario FROM aluno WHERE idaluno = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $alunoExcluido = $stmt->fetch(PDO::FETCH_OBJ);

        if ($alunoExcluido && $aluno->delete("idaluno", $id)) {
            $stmt = $db->prepare("DELETE FROM usuario WHERE idusuario = :idusuario AND tipo_usuario = 'ALUNO'");
            $stmt->bindParam(":idusuario", $alunoExcluido->fkusuario, PDO::PARAM_INT);
            $stmt->execute();

            $db->commit();
            header("Location:alunos.php");
            exit;
        }

        $db->rollBack();
        header("Location:alunos.php");
        exit;
    } catch (PDOException $e) {
        if ($db->inTransaction()) {
            $db->rollBack();
        }

        header("Location:alunos.php");
        exit;
    }
}
