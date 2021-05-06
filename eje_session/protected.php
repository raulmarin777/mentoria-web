<?php

session_start();

if (!isset($_SESSION['valido'])){
    echo "No puede Ver Informacion la Secreta";
}
else{
    echo "Informacion Secreta...!!!!!!!!!";
}
