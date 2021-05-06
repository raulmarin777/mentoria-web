<?php

$id= $_GET["id"];

require "util/db.php";

$db = connectDB();


if (!isset($_POST["eliminar"])){

    // Preparar la SELECT
    $sql ="SELECT id, full_name, user_name, email, password
        FROM users WHERE id ='$id'";
    // stament
    $stmt = $db->prepare($sql);

    $stmt->execute();

    $row = $stmt -> fetch();

}
else{

    $sql ="DELETE FROM users
           WHERE id = '$id'";

    // stament
    $stmt = $db->prepare($sql);
                               
    $stmt->execute();

    session_start();
    $_SESSION["msg-generico"] = "Registro $id Eliminado en forma correcta";
    header("location:index.php");
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

    <title>Delete of User</title>
  
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
                    <li class="nav-item">
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
            <h1>Eliminar Usuario</h1>         
            <form  method="POST" action="delete.php?id=<?= $id ?>">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value=<?=$row['full_name'] ?? 'Sin Nombre' ?> placeholder="Enter name" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Nombre Usuario</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" value=<?=$row['user_name'] ?? 'Sin Usuario' ?> placeholder="Enter name" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Correo</label>
                    <input type="text" class="form-control" id="email" name="email" value=<?=$row['email'] ?? 'Sin Correo' ?> placeholder="Enter name" readonly>
                </div>
                <button type="submit" class="btn btn-primary" name="eliminar">Eliminar</button>
            </form>
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