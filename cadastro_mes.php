<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<title>Cadastrar Mês</title>
</head>
<body>
<div class="container">
<a href="index.php" style="float: right; text-decoration: none; margin-right: 10px; background-color: #007BFF; color: white; padding: 5px 10px; border-radius: 5px;">Home</a><h1>Cadastrar Mês</h1>
<form action="salvar_mes.php" method="POST">
<label for="mes">Mês:</label>
<select name="mes" id="mes">
<?php
for ($i = 1; $i <= 12; $i++) {
echo "<option value='$i'>$i</option>";
}
?>
</select>
<label for="ano">Ano:</label>
<input type="number" name="ano" id="ano" min="2000" max="2100" required>
<button type="submit">Incluir Mês</button>
</form>
</div>
</body>
</html>