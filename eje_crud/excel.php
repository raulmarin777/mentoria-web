<?php

require "vendor/autoload.php";
require "util/db.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$db = connectDB();
// Preparar la SELECT
$sql ="SELECT id, full_name, user_name, email
       FROM users";
// stament
$stmt = $db->prepare($sql);


$stmt->execute();
$users = $stmt -> fetchAll(PDO::FETCH_ASSOC);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValueByColumnAndRow(1, 1, '#');
$sheet->setCellValueByColumnAndRow(2, 1, 'Id');
$sheet->setCellValueByColumnAndRow(3, 1, 'Nombre');
$sheet->setCellValueByColumnAndRow(4, 1, 'Nombre Usuario');
$sheet->setCellValueByColumnAndRow(5, 1, 'Correo');

/*$sheet->setCellValue('A1', '#');
$sheet->setCellValue('B1', 'Id');
$sheet->setCellValue('C1', 'Nombre');
$sheet->setCellValue('D1', 'Nombre Usuario');
$sheet->setCellValue('E1', 'Correo');*/

foreach ($users as $key => $user) {   
    $fil= $key + 2;
    /*$sheet->setCellValue('A'.$fil, $key + 1);
    $sheet->setCellValue('B'.$fil, $user['id']);
    $sheet->setCellValue('C'.$fil, $user['full_name']);
    $sheet->setCellValue('D'.$fil, $user['user_name']);
    $sheet->setCellValue('E'.$fil, $user['email']);*/

    $sheet->setCellValueByColumnAndRow(1, $fil, $key + 1);
    $sheet->setCellValueByColumnAndRow(2, $fil, $user['id']);
    $sheet->setCellValueByColumnAndRow(3, $fil, $user['full_name']);
    $sheet->setCellValueByColumnAndRow(4, $fil, $user['user_name']);
    $sheet->setCellValueByColumnAndRow(5, $fil, $user['email']);
}
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="usuarios.xlsx"');
$writer->save('php://output');
