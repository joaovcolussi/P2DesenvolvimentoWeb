
<?php
require_once '$conn.php';

function listarMeses() {
    global $conexao_bd;
    $comando_sql = $conexao_bd->query("SELECT * FROM meses");
    return $comando_sql->fetchAll(PDO::FETCH_ASSOC);
}

function salvarMes($mes, $ano) {
    global $conexao_bd;
    $comando_sql = $conexao_bd->prepare("INSERT INTO meses (mes, ano) VALUES (:mes, :ano)");
    $comando_sql->execute(['mes' => $mes, 'ano' => $ano]);
}

function salvarCategoria($categoria) {
    global $conexao_bd;
    $comando_sql = $conexao_bd->prepare("INSERT INTO categorias (nome) VALUES (:categoria)");
    $comando_sql->execute(['categoria' => $categoria]);
}
?>
