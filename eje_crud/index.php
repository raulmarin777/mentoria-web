<?php

require "util/db.php";

$db = connectDB();

// Preparar la SELECT
$sql ="SELECT id, full_name, user_name, email
       FROM users";
// stament
$stmt = $db->prepare($sql);


$stmt->execute();
$users = $stmt -> fetchAll(PDO::FETCH_ASSOC);


session_start();
$mensaje = "";

if (isset($_SESSION['msg-generico'])){
    $mensaje = $_SESSION["msg-generico"];
    $_SESSION["msg-generico"] = "";
}


?>

<!doctype html>
<html lang="en" class="h-100">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <title>Listado de Usuarios by Raul Marin</title>
    <style>
        .msg-form{
	        margin: 1em;
	        color:blue;
        }
        .excel{
            width: 20px; 
            height: 20px;
            margin-left: 30px;
            
        }
    </style>
  </head>
  <body class="d-flex flex-column h-100">
    
    <div class="container pt-4 pb-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <a class="navbar-brand" href="#">HTML CRUD Template</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarsExample09">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Inicio<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Crear</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://pisyek.com/contact">Ayuda</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-md-0">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </nav>
    </div>
        
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1>Listado de Usuarios</h1>
            
            <p class="msg-form"> <?= $mensaje ?> </p>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Accion <a href="excel.php"><img src="assets/img/Excel.ico" alt="excel" class="excel" /></a> </th>

                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $key => $user): ?>
                    <tr>
                    <th scope="row"><?=$key + 1 ?></th>
                    <td><?=$user['id'] ?? 'Sin Id' ?></td>
                    <td><?=$user['full_name'] ?? 'Sin Nombre' ?></td>
                    <td><?=$user['user_name'] ?? 'Sin Usuario' ?></td>
                    <td><?=$user['email'] ?? 'Sin Correo' ?></td>
                    <td>
                        <a href="view.php?id=<?= $user['id'] ?>"><button class="btn btn-primary btn-sm">Ver</button></a>
                        <a href="edit.php?id=<?= $user['id'] ?>"><button class="btn btn-outline-primary btn-sm">Editar</button></a>
                        <a href="delete.php?id=<?= $user['id'] ?>"><button class="btn btn-primary btn-sm">Eliminar</button></a>
                    </td>
                    <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
      
    <footer class="footer mt-auto py-3">
        <div class="container pb-5">
            <hr>
            <span class="text-muted">
                    Copyright &copy; 2019 | <a href="https://pisyek.com">Pisyek.com</a>
            </span>
        </div>
    </footer>

    
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
