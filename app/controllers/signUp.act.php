<pre>

    <?php
    @session_start();

    require("../../config/connect.php");

    var_dump($_POST);
    $email = $_POST['user_email'];

    if(verificarEmail($email, $conn)){
        $nome = $_POST['user_nome'];
    }


    ?>
    </pre>