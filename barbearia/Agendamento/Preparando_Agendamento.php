<?php
include "../connection.php";
// echo "<pre>";
// print_r($_POST['servico']);
// exit();

$dias_da_semana = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];

$data_agendamento = $_POST['data'];  // Data do agendamento enviada pelo formulário
$servico = $_POST['servico'];
$id_usuario = $_POST['id_usuario'];

// Verificar o dia da semana baseado na data
$dayofweek = date('w', strtotime($data_agendamento));
/* 
 SELECT (selecione)
 (Tabela.coluna) usuarios.nome, agendasdia_da_semana, agendashorario, agendasid_agenda, usuarios.id_usuario

  FROM agenda

  INNER JOIN usuarios ON usuarios.id_usuario = agendasid_usuario
 (juntando coluna id_usuario das duas tabelas na tabela usuarios)

 WHERE agendasdia_da_semana = $dayofweek
 ($dayofweek é o dia da semana que a pessoa colocar no cadastro da agenda exemplo: domingo = 0)

 AND agendasid_agenda NOT IN (SELECT agendasid_agenda  FROM agendamentos 
 (O NOT IN exclui os id_agenda já agendados para a data específica.)

  SELECT agendasid_agenda 
  FROM agendamentos 
  (juntando a coluna id_agenda das duas tabelas na tabela agendamentos) INNER JOIN agenda ON agendamentos.id_agenda = agendasid_agenda

 ('data' vem da pagina de cadastrar agendamentos) WHERE agendamentos.data = '$data_agendamento'
 )
 (aqui ordena por ordem crescente os horarios agendados) ORDER BY agendashorario*/

$sql = "
SELECT 
usuarios.nome, agendas.dia_da_semana, agendas.horario, agendas.id_agenda, usuarios.id_usuario 
FROM agendas
INNER JOIN usuarios ON usuarios.id_usuario = agendas.id_usuario
WHERE agendas.dia_da_semana = $dayofweek
AND agendas.id_agenda NOT IN (
    SELECT agendas.id_agenda 
    FROM agendamentos 
    INNER JOIN agendas ON agendamentos.id_agenda = agendas.id_agenda
    WHERE agendamentos.data = '$data_agendamento'
)
ORDER BY agendas.horario

";

// Executa a consulta no banco de dados
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Agendamentos Disponíveis</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background-image: linear-gradient(to right, #d39f0f, #464646);
        }
        .cima {
          display: flex;
          justify-content: space-between;
          padding: 1.5rem 6rem; 
        }
        header {
            background-color: #24252a;
            box-shadow: #0f0f0f;
        }
        .nav-list {
            display: flex;
            align-items: center;
        }   
        .nav-list ul {
            display: flex;
            justify-content: center;
            list-style: none;
        }
        .nav-item {
            margin: 20px;
        }
        .nav-link{
            text-decoration: none;
            font-size: 1.15rem;
            color: #f0ad30;
            font-weight: 300;
            font-family: Arial, Helvetica, sans-serif;
        }
        .logo {
            display: flex;
            align-items: center;
            color: #fff;
        }
        .logo2 {
            display: flex;
            align-items: center;
            color: #fff;
        }
        .logo-img {
            height: 120px;
            max-height: 100%;
            width: auto;
            margin-right: 20px;
        }
        .form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0,8);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
            color: white;
            font-family: Arial, Helvetica, sans-serif;
        }
        fieldset {
            border: 3px solid goldenrod;
        }
        legend {
            border: 1px solid goldenrod;
            padding: 8px;
            text-align: center;
            background-color: rgb(219, 172, 52);
            border-radius:  8px;
        }
        .mb-3{
        border: none;
        padding: 8px;
        border-radius: 10px;
        outline: none;
        font-size: 15px;
    }
        </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style> 
    
    </style>
<body>

    <header>
        <nav class="cima">
                <div class="logo">
                    <img src="../Imagens/black hair.png" alt="Logo" class="logo-img">
                </div>
                <div class="nav-list">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../Agendamento/index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Usuario/index.html">Cadastrar Usuário</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Usuario/lista_de_usuarios.php">Lista Usuários</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Agenda/index.php">Criar Agenda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../Agendamento/agendar.php">Agendar</a>
                        </li>  
                    </ul>
                </div>
                <div class="logo2">
                    <img src="../Imagens/black hair.png" alt="Logo" class="logo-img">
                </div>
            </nav>
        </header>


    <div class="container">
        <h2>Lista de Agendamentos Disponíveis para o dia: <?php echo $data_agendamento; ?></h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Barbeiro</th>
                    <th>Dia da Semana</th>
                    <th>Horário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                                <td>".$row['nome']."</td>
                                <td>".$dias_da_semana[$row['dia_da_semana']]."</td>
                                <td>".$row['horario']."</td>
                                <td>
                                    <input type='hidden' name='id_usuario' value='".$row['id_usuario']."'>
                                    <input type='hidden' name='id_agenda' value='".$row['id_agenda']."'>
                                    <input type='hidden' name='data' value='$data_agendamento'>
                                    <a href='insert_agendamento.php?id_agenda=".$row['id_agenda']."&data=".$data_agendamento."&id_usuario=".$id_usuario."&id_servico=".$servico."'>
                                        <button type='button' class='btn'>Agendar</button>
                                    </a>
                                </td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='4'>Não há agendamentos disponíveis para essa data.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
