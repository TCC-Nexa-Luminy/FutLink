
    <?php
    @session_start();

    require("../../config/connect.php");
    $email = $_POST['user_email'];

    $msg = "";
    $pagDestino = "";

    if (verificarEmail($email, $conn)) {
        $nome = $_POST['user_nome'];
        $data_nasc = $_POST["user_data_nasc"];
        $genero = $_POST["genero"];
        $telefone = $_POST["user_tel"];
        $senha = $_POST["user_pass"];
        $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

        $fotoDestino = destinoFoto("user_photo");

        list($msg, $pagDestino) = inserirDados($conn, $nome, $email, $senha_hash, $data_nasc, $genero, $fotoDestino, $telefone);
    } else{
        $msg = "O email informado já esta em uso!";
        $pagDestino = "signUp.php";
    }

    function verificarEmail($email, $connect)
    {
        $stmt = $connect->prepare("SELECT * FROM `tbl_usuarios`WHERE `email` = ?");     //prepara uma consulta, mas sem executar ainda
        $stmt->bind_param("s", $email);     //"s" de String
        $stmt->execute();   //executa a consulta
        $resultado = $stmt->get_result();   //adquire os resultados

        if ($resultado->num_rows == 0) {
            return true;        //EMAIL VÁLIDO PARA CADASTRO
        } else {
            return false;       //EMAIL JÁ EXISTENTE
        }
    }

    function destinoFoto($photo)
    {
        if (isset($_FILES[$photo]) && $_FILES[$photo]['error'] == 0) {
            $photo = $_FILES[$photo];
            $info = pathinfo($photo['name']);
            $extensao = strtolower($info['extension']);

            $destino = "../../public/images/profilePhotos/" . md5(time() . $photo['name']) . "." . $extensao;
            move_uploaded_file($photo["tmp_name"], $destino);
            return $destino;
        } else {
            return "../../public/images/profilePhotos/defaultPhoto";
        }
    }

    function inserirDados($connect, $nome, $email, $senha, $data_nasc, $genero, $foto, $telefone)
    {
        $query = "INSERT INTO `tbl_usuarios`
        (`nome`, `email`, `senha`, `data_nasc`, `genero`, `foto_perfil`, `telefone`) VALUES
        ('$nome', '$email', '$senha', '$data_nasc', '$genero', '$foto', '$telefone');";

        if (mysqli_query($connect, $query)) {
            return ["Conta criada com sucesso", "signUp.php"];
        } else {
            return ["Erro ao cadastrar usuário" . mysqli_error($connect), "signUp.php"];
        }
    }

    

    $_SESSION['msg'] = $msg;
    header("location: $pagDestino");
    ?>
