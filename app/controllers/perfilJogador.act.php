<?php
@session_start();

require_once("../../config/connect.php");

$id = $_SESSION['id'];

$query = "SELECT * FROM `tbl_usuarios` as u
JOIN `tbl_jogador` as j
ON u.id_user = j.id_user
where u.id_user = $id";

$resul = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($resul);

echo json_decode(print_r($user));