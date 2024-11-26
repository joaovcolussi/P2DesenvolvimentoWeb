
<?php
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_despesa = intval($_GET['id']);
    $comando_sql = $conexao_bd->prepare("SELECT * FROM despesas WHERE id = ?");
    $comando_sql->execute([$id_despesa]);
    $despesa = $comando_sql->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_despesa = intval($_POST['id']);
    $id_despesa_categoria = $_POST['categoria_id'];
    $tipo_movimento = $_POST['tipo'];
    $valor_movimento = $_POST['valor'];
    
    $comando_sql = $conexao_bd->prepare("UPDATE despesas SET categoria_id = ?, tipo = ?, valor = ? WHERE id = ?");
    $comando_sql->execute([$id_despesa_categoria, $tipo_movimento, $valor_movimento, $id_despesa]);
    
    header('Location: visualizar_gastos.php?mes_id=' . $despesa['mes_id']);
    exit;
}
?>

<form method="POST" action="editar_gasto.php">
    <input type="hidden" name="id" value="<?= $despesa['id']; ?>">
    Categoria: <input type="text" name="categoria_id" value="<?= $despesa['categoria_id']; ?>"><br>
    Tipo: <input type="text" name="tipo" value="<?= $despesa['tipo']; ?>"><br>
    Valor: <input type="text" name="valor" value="<?= $despesa['valor']; ?>"><br>
    <button type="submit">Salvar</button>
</form>
