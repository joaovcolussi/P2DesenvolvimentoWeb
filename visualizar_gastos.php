<?php
require_once 'functions.php';

$id_despesa_mes_corrente = isset($_GET['mes_id']) ? intval($_GET['mes_id']) : null;
$despesas = [];
$total_receitas = 0;
$total_despesas = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id_despesa = intval($_POST['delete_id']);
    $comando_sql = $conexao_bd->prepare("DELETE FROM despesas WHERE id = ?");
    $comando_sql->execute([$id_despesa]);
    header('Location: visualizar_gastos.php?mes_id=' . $id_despesa_mes_corrente);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'], $_POST['edit_valor'], $_POST['mes_id'])) {
    $id_despesa = intval($_POST['edit_id']);
    $valor_editado = floatval($_POST['edit_valor']);
    $mes_id = intval($_POST['mes_id']);

    $comando_sql = $conexao_bd->prepare("UPDATE despesas SET valor = ? WHERE id = ?");
    $comando_sql->execute([$valor_editado, $id_despesa]);

    header('Location: visualizar_gastos.php?mes_id=' . $mes_id);
    exit;
}

if ($id_despesa_mes_corrente) {
    $comando_sql = $conexao_bd->prepare("
        SELECT d.*, c.nome AS categoria 
        FROM despesas d 
        JOIN categorias c ON d.categoria_id = c.id 
        WHERE mes_id = ?
    ");
    $comando_sql->execute([$id_despesa_mes_corrente]);
    $despesas = $comando_sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($despesas as $despesa) {
        if ($despesa['tipo'] === 'entrada') {
            $total_receitas += $despesa['valor'];
        } elseif ($despesa['tipo'] === 'saida') {
            $total_despesas += $despesa['valor'];
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoria_id'], $_POST['tipo'], $_POST['valor'])) {
    $id_despesa_categoria = intval($_POST['categoria_id']);
    $tipo_movimento = $_POST['tipo'];
    $valor_movimento = floatval($_POST['valor']);

    $comando_sql = $conexao_bd->prepare("
        INSERT INTO despesas (mes_id, categoria_id, tipo, valor) 
        VALUES (?, ?, ?, ?)
    ");
    $comando_sql->execute([$id_despesa_mes_corrente, $id_despesa_categoria, $tipo_movimento, $valor_movimento]);
    header('Location: visualizar_gastos.php?mes_id=' . $id_despesa_mes_corrente);
    exit;
}

function getSaldoClass($saldo) {
    if ($saldo > 0) return 'saldo-positivo';
    if ($saldo < 0) return 'saldo-negativo';
    return 'saldo-neutro';
}
?>
<link rel="stylesheet" href="style.css">
<div>
    <a href="index.php" style="float: right; text-decoration: none; margin-right: 10px; background-color: #007BFF; color: white; padding: 5px 10px; border-radius: 5px;">Home</a>
    <h2>Gastos do Mês: <?php echo htmlspecialchars($id_despesa_mes_corrente); ?></h2>
    <p>Total de Entradas: R$ <?php echo number_format($total_receitas, 2, ',', '.'); ?></p>
    <p>Total de Saídas: R$ <?php echo number_format($total_despesas, 2, ',', '.'); ?></p>
    <p>Saldo: <span class="<?php echo getSaldoClass($total_receitas - $total_despesas); ?>">
        R$ <?php echo number_format($total_receitas - $total_despesas, 2, ',', '.'); ?></span></p>
    <?php if (count($despesas) > 0): ?>
        <table>
            <tr>
                <th>Categoria</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($despesas as $despesa): ?>
                <tr>
                    <td><?php echo htmlspecialchars($despesa['categoria']); ?></td>
                    <td><?php echo htmlspecialchars($despesa['tipo']); ?></td>
                    <td>R$ <?php echo number_format($despesa['valor'], 2, ',', '.'); ?></td>
                    <td>
                        <form method="POST" style="display:inline-block;">
                            <input type="hidden" name="edit_id" value="<?php echo $despesa['id']; ?>">
                            <input type="hidden" name="mes_id" value="<?php echo $id_despesa_mes_corrente; ?>">
                            <input type="number" name="edit_valor" value="<?php echo $despesa['valor']; ?>" step="0.01" required>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                        <form method="POST" style="display:inline-block;">
                            <input type="hidden" name="delete_id" value="<?php echo $despesa['id']; ?>">
                            <input type="hidden" name="mes_id" value="<?php echo $id_despesa_mes_corrente; ?>">
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Nenhuma despesa registrada. Adicione uma nova despesa abaixo:</p>
    <?php endif; ?>
    <form method="POST">
        <label for="categoria_id">Categoria:</label>
        <select name="categoria_id" id="categoria_id" required>
            <?php
            $categorias = $conexao_bd->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($categorias as $categoria) {
                echo "<option value='{$categoria['id']}'>" . htmlspecialchars($categoria['nome']) . "</option>";
            }
            ?>
        </select>
        <label for="tipo">Tipo:</label>
        <select name="tipo" id="tipo" required>
            <option value="entrada">Entrada</option>
            <option value="saida">Saída</option>
        </select>
        <label for="valor">Valor:</label>
        <input type="number" name="valor" id="valor" step="0.01" required>
        <button type="submit">Adicionar Despesa</button>
    </form>
</div>
