<?php

require "util/db.php";

$db = connectDB();

$message = "";
$valido = 0;
if (isset($_POST["nuevo"])){
    $name = $_POST["full_name"];
	$email = $_POST["email"];
	$username = $_POST["user_name"];
	$pass = $_POST["password"];
	
    $sql ="INSERT INTO users
    (full_name, email, user_name, password)
    VALUES
    (:full_name, :email, :user_name, :password)";

    // stament
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':full_name', $name);
    $stmt->bindParam(':user_name', $username);  
    $stmt->bindParam(':email', $email);
    $password = password_hash($pass, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $password);
                               
    $stmt->execute();
	$valido = 1;
	$message = "Registro creado en forma correcta";
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

    <title>List of User</title>

    <style>
        .msg-form{
	    margin: 1em;
	    color:blue;
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
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
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
            <h1>Crear Nuevo Usuario</h1>
            <?php if ($valido == 1): ?>
                <p class="msg-form"> <?= $message ?> </p>
            <?php else: ?>
                    <p class="msg-form"> <?= $message ?> </p>
            <?php endif; ?>
            <form action="create.php" method="POST">

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Ingrese Nombre">
                    <small class="form-text text-muted">Nombre Aqui.</small>
                </div>
                <div class="form-group">
                    <label for="name">Nombre Usuario</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Ingrese Nombre Usuario">
                    <small class="form-text text-muted">Nombre Usuario Aqui.</small>
                </div>
                <div class="form-group">
                    <label for="name">Correo</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Ingrese Correo">
                    <small class="form-text text-muted">Correo Aqui.</small>
                </div>
                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese Password">
                    <small class="form-text text-muted">Password Aqui.</small>
                </div>

                <button type="submit" name="nuevo" class="btn btn-primary">Submit</button>
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