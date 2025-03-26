<?php
@session_start();

if (isset($_SESSION['msg'])) {
    ?>
    <script>
        sweet_message("<?php echo $_SESSION['msg'];?>")
        </script>
<?php
unset($_SESSION['msg']);
}
?>