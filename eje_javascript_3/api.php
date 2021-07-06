<?php

    
    $dbname = "registro";
    $dbuser = "registro-user";
    $dbpassword = "user1";
    $dsn = "mysql:host=localhost;dbname=$dbname";
        
    $pdo = new \PDO($dsn, $dbuser, $dbpassword);

    $sql ="SELECT * FROM users2";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    echo json_encode($rows);