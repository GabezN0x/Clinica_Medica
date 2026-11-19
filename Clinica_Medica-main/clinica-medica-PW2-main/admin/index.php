<?php
require_once "../php/conexao.php";

$sql = $conexao->query("SELECT COUNT(*) FROM paciente");
$totalPacientes = $sql->fetchColumn();

$sql = $conexao->query("SELECT COUNT(*) FROM medico");
$totalMedicos = $sql->fetchColumn();

$sql = $conexao->query("SELECT COUNT(*) FROM usuario WHERE tipo_usuario = 'recepcionista'");
$totalRecepcionistas = $sql->fetchColumn();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - PriMed</title>
    <link rel="stylesheet" href="../css/style.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        .admin-nome{
            background-color: white;
            padding: 12px 18px;
            border-radius: 8px;
            color: #269b88;
            font-weight: bold;
        }

        .menu-lateral {
            width: 240px;
            background-color: #269b88;
            color: white;
            padding: 30px 20px;
            box-sizing: border-box;
        }

        .menu-lateral h1 {
            font-size: 30px
            margin-bottom: 5px;
        }

        .menu-lateral p {
            margin-bottom: 40px;
            font-size: 12px;
            letter-spacing: 2px;
        }

        .menu-lateral a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 13px 10px;
            margin-bottom: 8px;
            border-radius: 6px;
            font_size: 15px;
        }

        .menu-lateral a:hover {
            background-color: #208574;
        }

        .sair {
            margin-top: 40px;
            border-top: 1px solid rgb(255,255,255, 0.3);
            padding-top: 20px
        }

        .conteudo {
            flex: 1;
            padding: 35px;
        }

        .topo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .topo h2 {
            color: #333;
            margin-bottom: 0px;
        }

        .topo p {
            color: #777;
            margin-top: 8px;
        }

        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 35px;
        }

        .card {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            flex: 1;
            min-width: 180px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .card h3 {
            color: #666;
            font-size: 16px;
            margin-top: 0;
        }

        .card h1 {
            color: #269b88;
            margin-bottom: 0;
        }

        .gerenciamento {
            margin-top: 30px;
        }

        .gerenciamento h2 {
            color: #333;
            margin-bottom: 18px;
        }

        .opcoes {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .opcao {
        background-color: white;
        padding: 23px;
        border-radius: 12px;
        text-decoration: none;
        box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        transition: 0.2s; 
        }
        
        .opcao:hover {
           transform: translateY(-3px);
           box-shadow: 0 5px 15px rgba(0,0,0,0.10);
        }

        .opcao h3 {
            color: #269b88;
            font-size: 16px;
            margin: 0 0 2px;
        }

        .opcao p {
            color: #666;
            font-size: 13px;
            margin: 0;
        }

        @media (max-width: 900px) {
            .opcoes {
                grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 600px) {
                .opcoes {
                    grid-template-columns: 1fr;
                }
            }


        @media (max-width: 700px) {
            .admin-container {
                flex-direction: column;
            }

            .menu-lateral {
                width: 100%;
            }

            .conteudo {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="admin-container">

    <div class="menu-lateral">
        <h1>PriMed</h1>
        <p>CLÍNICA MÉDICA</p>

        <a href="index.php">Início</a>
        <a href="pacientes.php">Pacientes</a>
        <a href="medicos.php">Médicos</a>
        <a href="recepcionistas.php">Recepcionistas</a>

        <div class="sair">
            <a href="../php/logout.php">Sair da conta</a>
        </div>
    </div>

    <div class="conteudo">

        <div class="topo">
            <div>
                <h2>Painel administrativo</h2>
                <p>Bem-vindo(a) ao sistema PriMed!</p>
            </div>
            <div class="admin-nome">Administrador</div>
        </div>

        <div class="cards">

            <div class="card">
                <h3>Pacientes cadastrados</h3>
                <h1><?php echo $totalPacientes; ?></h1>
            </div>

            <div class="card">
                <h3>Médicos cadastrados</h3>
                <h1><?php echo $totalMedicos; ?></h1>
            </div>

            <div class="card">
                <h3>Recepcionistas cadastrados</h3>
                <h1><?php echo $totalRecepcionistas; ?></h1>
            </div>

        </div>

        <div class="gerenciamento">

            <h2>Gerenciamento da clínica</h2>

            
            <div class="opcoes">

            <a href="pacientes.php" class="opcao">
                <h3>Pacientes</h3>
                <p>Visualizar e gerenciar os pacientes cadastrados.</p>
            </a>

            <a href="medicos.php" class="opcao">
                <h3>Médicos</h3>
                <p>Cadastrar e gerenciar os médicos da clínica.</p>
            </a>

            <a href="recepcionistas.php" class="opcao">
                <h3>Recepcionistas</h3>
                <p>Gerenciar os recepcionistas e seus acessos.</p>
            </a>
        
        </div>


        </div>

    </div>

</div>

</body>
</html>
