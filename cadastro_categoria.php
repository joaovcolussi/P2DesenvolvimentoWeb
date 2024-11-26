<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<title>Cadastrar Categoria</title>
</head>
<body>
<div class="container">
<a href="index.php" style="float: right; text-decoration: none; margin-right: 10px; background-color: #007BFF; color: white; padding: 5px 10px; border-radius: 5px;">Home</a><h1>Cadastrar Categoria</h1>
<form action="salvar_categoria.php" method="POST">
<label for="categoria">Nome da Categoria:</label>
<input type="text" name="categoria" id="categoria" required>
<button type="submit">Incluir Categoria</button>
</form>
</div>
</body>
</html>