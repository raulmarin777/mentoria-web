<?php

    
    $dbname = "registro";
    $dbuser = "registro-user";
    $dbpassword = "user1";
    $dsn = "mysql:host=localhost;dbname=$dbname";
        
    $pdo = new \PDO($dsn, $dbuser, $dbpassword);

    $sql ="SELECT * FROM users";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);

    echo json_encode;