<?php
require_once "conexao.php";

$nome = "Administrador PriMed";
$email = "admin@primed.com";
$senha = password_hash("Admin123", PASSWORD_DEFAULT);
$tipo = "admin";

$consulta = $conexao->prepare("SELECT * FROM usuario WHERE email = ?");
$consulta->execute([$email]);

if ($consulta->rowCount() == 0) {

    $sql = $conexao->prepare("INSERT INTO usuario (nome, email, senha, tipo_usuario) VALUES (?, ?, ?, ?)");
    $sql->execute([$nome, $email, $senha, $tipo]);

    echo "Administrador cadastrado com sucesso!";

} else {
    echo "Esse administrador já está cadastrado.";
}
?>
