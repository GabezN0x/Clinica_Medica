<?php
require_once "conexao.php";

$nome = "Paciente teste1 PriMed";
$email = "paciente@primed.com";
$senha = password_hash("Teste001", PASSWORD_DEFAULT);
$tipo = "paciente";

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