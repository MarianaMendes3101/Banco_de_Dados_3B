<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title> Grupo Musculares | Personal</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">PersonalPro</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  active" aria-current="page"  href="#">Grupo Muscular</a>

        <li class="nav-item">
          <a class="nav-link  active" aria-current="page"  href="#">Exercício</a>
        </li>      
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<main class="container"></main>
  <div class="mt-5 d-flex justify-content-between p-5">
    <h3>Grupos Muscular</h3>
    <a href="ger-muscuar.php" class= "btn btn-primary"> Novo Grupo Muscular</a>

  </div>

  <table class="table p-3">
    <thead>
      <tr>        
        <th>Nome</th>]
        <th class="text-center">Ações</th>
      </tr>
    </thead>
    <tbody>
      <tr>
    <td>Ombro</td>
    <td class="text-center">
          <a href="#" class="btn btn-outline-info btn-sm"><i class="bi bi-eye"></i></a>
          <a href="#" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
          <a href="#" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></a>
        </td>
      </tr>
    </tbody>
  </table>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>