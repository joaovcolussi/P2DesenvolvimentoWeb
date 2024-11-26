
<?php
require_once 'functions.php';
if ($_POST) {
    $categoria = $_POST['categoria'];
    salvarCategoria($categoria);
    header('Location: index.php');
}
?>
