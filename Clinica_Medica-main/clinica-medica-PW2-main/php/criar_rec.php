<?php
require_once "conexao.php";

$nome = "Recepcionista PriMed";
$email = "recepcao@primed.com";
$senha = password_hash("Primed123", PASSWORD_DEFAULT);
$tipo = "recepcionista";

$consulta = $conexao->prepare("SELECT * FROM usuario WHERE email = ?");
$consulta->execute([$email]);

if ($consulta->rowCount() == 0) {
    $sql = $conexao->prepare("INSERT INTO usuario (nome, email, senha, tipo_usuario) VALUES (?, ?, ?, ?)");
    $sql->execute([$nome, $email, $senha, $tipo]);

    echo "Recepcionista cadastrada com sucesso!";
} else {
    echo "Essa recepcionista já está cadastrada.";
}
?>
