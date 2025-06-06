<?php
@session_start();

unset($_SESSION['id'], $_SESSION['tipoLogin']);

$_SESSION['msg'] = "Você saiu de sua conta.";

header("location: ../../public/");