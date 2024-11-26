
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<title>Controle de Finanças</title>
</head>
<body>
<div class="container">
<a href="index.php" style="float: right; text-decoration: none; margin-right: 10px; background-color: #007BFF; color: white; padding: 5px 10px; border-radius: 5px;">Home</a>
<h1>Controle de Finanças</h1>
<nav>
<a href="cadastro_mes.php">Cadastrar Mês</a>
<a href="cadastro_categoria.php">Cadastrar Categoria</a>
</nav>
<table>
<tr>
<th>Mês</th>
<th>Ação</th>
</tr>
<?php
require_once 'functions.php';
$meses = listarMeses();
foreach ($meses as $mes) {
    echo "<tr><td>{$mes['mes']}/{$mes['ano']}</td><td><a href='visualizar_gastos.php?mes_id={$mes['id']}'>Visualizar Gastos</a></td></tr>";
}
?>
</table>
</div>
</body>
</html>
