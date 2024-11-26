
<?php
require_once 'functions.php';
if ($_POST) {
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];
    salvarMes($mes, $ano);
    header('Location: index.php');
}
?>
