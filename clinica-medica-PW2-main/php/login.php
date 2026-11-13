<?php
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = $conexao->prepare("SELECT * FROM usuario WHERE email = ?");
    $sql->execute([$email]);

    $usuario = $sql->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario["senha"])) {

        if ($usuario["tipo_usuario"] == "recepcionista") {
            header("Location: ../recepcionista/index.php");
            exit;
            }
    
            if ($usuario["tipo_usuario"] == "admin") {
                header("Location: ../admin/index.php");
                exit;
                } else {
            echo "Você não tem permissão para acessar esta área.";
        }

    } else {
        echo "E-mail ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PriMed</title>

    <link rel="stylesheet" href="../css/style.css">
</head>

<!-- lembra colocar isso no css depois!! -->
<style>
.login-container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f1f7f6;
    padding: 20px;
}

.login-box {
    background-color: white;
    width: 100%;
    max-width: 400px;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    text-align: center;
}

.login-box h1 {
    color: #269b88;
    font-size: 36px;
    margin-bottom: 5px;
}

.login-subtitulo {
    color: #777;
    font-size: 11px;
    letter-spacing: 2px;
    margin-bottom: 35px;
}

.login-box h2 {
    color: #333;
    margin-bottom: 10px;
}

.login-descricao {
    color: #777;
    font-size: 14px;
    margin-bottom: 25px;
}

.login-box form {
    text-align: left;
}

.login-box label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: bold;
}

.login-box input {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 7px;
    box-sizing: border-box;
    font-size: 14px;
}

.login-box button {
    width: 100%;
    padding: 13px;
    background-color: #269b88;
    color: white;
    border: none;
    border-radius: 7px;
    font-size: 16px;
    cursor: pointer;
}

.login-box button:hover {
    background-color: #1d806f;
}

.voltar {
    display: inline-block;
    margin-top: 25px;
    color: #269b88;
    text-decoration: none;
    font-size: 14px;
}
</style>

<body>

    <div class="login-container">

        <div class="login-box">

            <h1>PriMed</h1>
            <p class="login-subtitulo">CLÍNICA MÉDICA PRIMAVERA</p>

            <h2>Bem-vindo(a)!</h2>

            <p class="login-descricao">
                Entre com seus dados para acessar o sistema.
            </p>

            <form action="login.php" method="POST">

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email"
                    placeholder="Digite seu e-mail" required>

                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha"
                    placeholder="Digite sua senha" required>

                <button type="submit">Entrar</button>

            </form>

            <a href="../index.php" class="voltar">
                Voltar para o início
            </a>

        </div>

    </div>

</body>

</html>
