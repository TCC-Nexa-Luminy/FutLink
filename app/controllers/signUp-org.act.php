<pre>

    <?php

    session_start();
    require("../../config/connect.php");

    print_r($_POST);
    print_r($_FILES);

    $email = filter_input(INPUT_POST, "org_email", FILTER_VALIDATE_EMAIL);
    $msg = "";
    $pagDestino = "";


    if (verificarEmail($email, $conn)) {
        $org_dados = array();
        $org_dados["nome"] = filter_input(INPUT_POST, "org_nome", FILTER_SANITIZE_SPECIAL_CHARS);
        $org_dados['data_fundacao'] = $_POST['org_data_fund'];
        $org_dados['tipo'] = filter_input(INPUT_POST, 'org_tipo', FILTER_SANITIZE_SPECIAL_CHARS);
        $org_dados['email'] = filter_input(INPUT_POST, "org_email", FILTER_VALIDATE_EMAIL);
        $org_dados['tel'] = filter_input(INPUT_POST, "org_tel", FILTER_SANITIZE_SPECIAL_CHARS);
        $org_dados['senha_hash'] = password_hash($_POST['org_pass'], PASSWORD_BCRYPT);
        $cep = filter_input(INPUT_POST, "org_cep", FILTER_SANITIZE_NUMBER_INT);
        $org_dados['cep'] = $cep ? $cep : "01010101";
        $org_dados['logo'] = destinoFoto($_FILES['org_photo']);

        echo "email válido para uso";
        print_r($org_dados);
        print_r($org_dados['logo']);
    } else {
        echo "email em uso!";
    }

    function verificarEmail($email, $connect)
    {
        $query = "SELECT * FROM `tbl_organizacao` WHERE `email_org` = ?";

        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resul = $stmt->get_result();

        return $resul->num_rows == 0 ? true : false;
    }

    function inserirDados($objOrg, $connect)
    {
        $query = "INSERT INTO `tbl_organizacao` (`nome_org`, `email_org`, `telefone_org`, `password_org`, `logo_org`, `data_fundacao`, `tipo`, `cep`) VALUES
    (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("sssssssi", $objOrg['nome'], $objOrg['email'], $objOrg['tel'], $objOrg['senha_hash'], $objOrg['lo']);
    }

    function destinoFoto($filePhoto)
    {
        if (isset($filePhoto) && $filePhoto['error'] == 0) {
            $info = pathinfo($filePhoto['name']);
            $extensao = strtolower($info['extension']);

            $destino = "../../public/images/logoOrganization/" . md5(time() . $filePhoto['name']) . "." . $extensao;
            return $destino;
        } else {
            return "...";
        }
    }
    ?>
</pre>