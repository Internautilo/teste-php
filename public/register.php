<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>basic login screen</title>
</head>
<body>
    <div class="container">
        <form action="<?= __DIR__."teste.php"?>" method="post">
            <p class="bold">Nome</p>
            <input type="text" name="name" id="name">
            <p class="bold">Email</p>
            <input type="text" name="email" id="email">
            <br>
            <p class="bold">Senha</p>
            <input type="text" name="password" id="password">
            <br>
            <br>
            <input type="submit" value="Cadastrar">
        </form>
        <br>
        <a href="index.php">Fazer login</a>

    </div>
</body>
</html>