<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Dashboard | PersonalPRO</title>
</head>

<body>
  <?php require_once "_parts/_menu.php" ?>
  <main class="container" style="margin-top: 80px;">
    <div class="mt-5">
        <h4>Cadastro de grupo muscular</h4>
    </div>
    <div class="card">
      <form action="" method="post" class="row p-4 g3 mt-3">
        <div class="col-12">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" name="nome" id="nome" class="form-control">
        </div>
        <div class="mt-3">
          <a href="gmuscular.php" class="btn btn-secondary" >Cancelar</a>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>