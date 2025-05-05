<?php

if (isset($_SESSION['msg'])) {
    ?>
    <script>
        sweet_message("<?php echo $_SESSION['msg'];?>")
    </script>
<?php
}
?>