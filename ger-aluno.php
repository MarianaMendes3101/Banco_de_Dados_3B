<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Alunos | PersonalPRO</title>
</head>

<body>
  <?php
  require_once "_parts/_menu.php";

  spl_autoload_register(function ($class) {
    require_once "class/{$class}.class.php";
  });

  $aluno = null;
  $visualizar = filter_input(INPUT_GET, "acao", FILTER_SANITIZE_STRING) == "ver";
  $desabilitado = $visualizar ? "disabled" : "";
  $erro = filter_input(INPUT_GET, "erro", FILTER_SANITIZE_STRING);
  $mensagensErro = [
    "campos_usuario" => "Preencha o novo usuario, e-mail e senha.",
    "senha" => "A senha e a confirma senha precisam ser iguais.",
    "usuario" => "Nao foi possivel criar o usuario do aluno.",
    "email" => "Este e-mail ja esta cadastrado. Use outro e-mail.",
    "salvar" => "Nao foi possivel salvar o aluno. Confira os dados e tente novamente."
  ];
  $sexos = [
    "M" => "Masculino",
    "F" => "Feminino",
    "OUTRO" => "Outro"
  ];
  $estados = array(
    'AC' => 'Acre',
    'AL' => 'Alagoas',
    'AP' => 'Amapá',
    'AM' => 'Amazonas',
    'BA' => 'Bahia',
    'CE' => 'Ceará',
    'DF' => 'Distrito Federal',
    'ES' => 'Espírito Santo',
    'GO' => 'Goiás',
    'MA' => 'Maranhão',
    'MS' => 'Mato Grosso do Sul',
    'MT' => 'Mato Grosso',
    'MG' => 'Minas Gerais',
    'PA' => 'Para',
    'PB' => 'Paraíba',
    'PR' => 'Paraná',
    'PE' => 'Pernambuco',
    'PI' => 'Piauí',
    'RJ' => 'Rio de Janeiro',
    'RN' => 'Rio Grande do Norte',
    'RS' => 'Rio Grande do Sul',
    'RO' => 'Rondônia',
    'RR' => 'Roraima',
    'SC' => 'Santa Catarina',
    'SP' => 'São Paulo',
    'SE' => 'Sergipe',
    'TO' => 'Tocantins',
  );

  if (filter_has_var(INPUT_GET, "id")) {
    $edtAluno = new Aluno();
    $id = intval(filter_input(INPUT_GET, "id"));
    $aluno = $edtAluno->search("idaluno", $id);
  }
  ?>

  <main class="container" style="margin-top: 80px;">
    <div class="mt-5">
      <h4><?= $visualizar ? "Dados do aluno" : "Cadastro de aluno" ?></h4>
    </div>

    <?php if ($erro && isset($mensagensErro[$erro])) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $mensagensErro[$erro] ?>
      </div>
    <?php endif; ?>

    <div class="card">
      <form action="db-aluno.php" method="post" class="row p-4 g-3 mt-3">
        <input type="hidden" name="id" value="<?= $aluno->idaluno ?? null ?>">
        <input type="hidden" name="fkusuario" value="<?= $aluno->fkusuario ?? null ?>">

        <div class="col-12">
          <div class="form-floating">
            <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" value="<?= $aluno->nome ?? null ?>" required <?= $desabilitado ?>>
            <label for="nome">Nome</label>
          </div>
        </div>

        <?php if (!$aluno) : ?>
          <div class="col-md-4">
            <div class="form-floating">
              <input type="text" name="username" id="username" class="form-control" placeholder="Novo usuario" required <?= $desabilitado ?>>
              <label for="username">Novo usuario</label>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-floating">
              <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required <?= $desabilitado ?>>
              <label for="email">E-mail</label>
            </div>
          </div>

          <div class="col-md-2">
            <label for="senha" class="form-control">Senha</label>
            <div class="input-group">
              <input type="password" name="senha" id="senha" class="form-control" > 
             <button type="button" class="btn btn-secondary" id="toggleSenha">
              
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-floating">
              <input type="password" name="confirma_senha" id="confirma_senha" class="form-control" placeholder="Confirma senha" required <?= $desabilitado ?>>
              <label for="confirma_senha">Confirma senha</label>
            </div>
          </div>
        <?php endif; ?>

        <div class="col-md-4">
          <div class="form-floating">
            <?php $sexoSel = $aluno->sexo ?? null; ?>
            <select name="sexo" id="sexo" class="form-select" aria-label="Sexo" <?= $desabilitado ?>>
              <option value="">Selecione...</option>
              <?php foreach ($sexos as $valor => $rotulo) : ?>
                <option value="<?= $valor ?>" <?php if ($valor == $sexoSel) echo "selected" ?>>
                  <?= $rotulo ?>
                </option>
              <?php endforeach; ?>
            </select>
            <label for="sexo">Sexo</label>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-floating">
            <input type="date" name="nascimento" id="nascimento" class="form-control" placeholder="Nascimento" value="<?= $aluno->nascimento ?? null ?>" <?= $desabilitado ?>>
            <label for="nascimento">Nascimento</label>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-floating">
            <input type="text" name="celular" id="celular" class="form-control" placeholder="Celular" value="<?= $aluno->celular ?? null; ?>" data-mascara="(00)00000-0000)">
            <label for="celular">Celular</label>
          </div>
        </div>

        <div class="col-md-8">
          <div class="form-floating">
            <input type="text" name="logradouro" id="logradouro" class="form-control" placeholder="Logradouro" value="<?= $aluno->logradouro ?? null ?>" <?= $desabilitado ?>>
            <label for="logradouro">Logradouro</label>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-floating">
            <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Bairro" value="<?= $aluno->bairro ?? null ?>" <?= $desabilitado ?>>
            <label for="bairro">Bairro</label>
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-floating">
            <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade" value="<?= $aluno->cidade ?? null ?>" <?= $desabilitado ?>>
            <label for="cidade">Cidade</label>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-floating">
            <?php $estadoSel = $aluno->estado ?? null; ?>
            <select name="estado" id="estado" class="form-select" aria-label="Estado" <?= $desabilitado ?>>
              <option value="">Selecione...</option>
              <?php foreach ($estados as $sigla => $nomeEstado) : ?>
                <option value="<?= $sigla ?>" <?php if ($sigla == $estadoSel) echo "selected" ?>>
                  <?= $nomeEstado ?>
                </option>
              <?php endforeach; ?>
            </select>
            <label for="estado">Estado</label>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-floating">
            <input type="text" name="cep" id="cep" class="form-control" placeholder="CEP" value="<?= $aluno->cep ?? null; ?>" data-mascara="00000-000">
            <label for="cep">CEP</label>
          </div>
        </div>

        <div class="col-12">
          <div class="form-floating">
            <textarea name="objetivo" id="objetivo" class="form-control" placeholder="Objetivo" style="height: 58px; resize: none; overflow: hidden;" <?= $desabilitado ?>><?= $aluno->objetivo ?? null ?></textarea>
            <label for="objetivo">Objetivo</label>
          </div>
        </div>

        <div class="mt-3">
          <a href="alunos.php" class="btn btn-secondary">Cancelar</a>
          <?php if (!$visualizar) : ?>
            <button type="submit" class="btn btn-primary" name="btnGravar" id="btnGravar">Salvar</button>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const objetivo = document.getElementById("objetivo");

    function ajustarObjetivo() {
      objetivo.style.height = "auto";
      objetivo.style.height = objetivo.scrollHeight + "px";
    }

    objetivo.addEventListener("input", ajustarObjetivo);
    ajustarObjetivo();

    const senha = document.getElementById("senha");
    const confirmaSenha = document.getElementById("confirma_senha");

    function validarSenha() {
      if (!senha || !confirmaSenha) {
        return;
      }

      confirmaSenha.setCustomValidity(senha.value === confirmaSenha.value ? "" : "As senhas devem ser iguais.");
    }

    if (senha && confirmaSenha) {
      senha.addEventListener("input", validarSenha);
      confirmaSenha.addEventListener("input", validarSenha);
    }
  </script>
  <script src="js/utils.js"></script>
</body>

</html>
