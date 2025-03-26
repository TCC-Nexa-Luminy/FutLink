<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutLink</title>
    <link rel="stylesheet" href="../../public/css/root.css">
    <link rel="shortcut icon" href="../../public/images/futlinkLogoBg.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- ÍCONES DO FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- SWIPER SLIDE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   <!--JQUERY-->

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<script>
    function sweet_message(msg){
        tempo = msg.length / 6 * 1000
        Swal.fire({
            position: "top-end",
            title: "Título",
            html: `${msg}`,
            showConfirmButton: false,
            timer: tempo,
            backdrop: false,
            timerProgressBar: true,
            showCloseButton: true,
            theme: "auto",
            customClass: {
                popup: 'swat-message_popup',
                timerProgressBar: 'swat-message_timer'
            },
        })
    }
</script>