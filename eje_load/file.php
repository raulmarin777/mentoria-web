<?php

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["imagen"]["name"]);

if (move_uploaded_file($_FILES["imagen"]["tmp_name"],$target_file)){
    echo "Archivo subido correctamente...";
}
else{
    echo "Error al subir el Archivo";
}
?>