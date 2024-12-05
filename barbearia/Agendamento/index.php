<?php
include "../connection.php";

// Verifica se o botão "Excluir" foi pressionado e se o ID do agendamento foi enviado
if (isset($_POST['delete_id'])) {
    $id_agendamento = $_POST['delete_id'];
    // Excluir o agendamento do banco de dados
    $delete_sql = "DELETE FROM agendamentos WHERE id_agendamento = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id_agendamento);
    if ($stmt->execute()) {
        echo "<script>alert('Agendamento excluído com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao excluir agendamento!');</script>";
    }
}

// Exibir a lista de agendamentos
$sql = 'SELECT a.id_agendamento, c.nome as cliente, b.nome as barbeiro, data, horario 
        FROM agendamentos a
        INNER JOIN usuarios c ON c.id_usuario = a.id_usuario
        INNER JOIN agendas g ON g.id_agenda = a.id_agenda
        INNER JOIN usuarios b ON b.id_usuario = g.id_usuario';
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Lista de Agendamentos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
    .lista {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        background-color: rgba(0, 0, 0, 0,8);
        padding: 25px;
        border-radius: 15px;
        width: 35%;
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

    
    </style>
</head>

<body class="d-flex flex-column h-100">
<main role="main" class="flex-shrink-0">
     
<header>
<nav class="cima">
        <div class="logo">
        <img src="../Imagens/black hair.png" alt="Logo" class="logo-img">
        </div>
        <div class="nav-list">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
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
                    <a class="nav-link active" href="agendar.php">Agendar</a>
                </li>  
            </ul>
        </div>
        <div class="logo2">
        <img src="../Imagens/black hair.png" alt="Logo" class="logo-img">

        </div>
    </nav>
</header>
    <div class="lista">
    <fieldset>
    <legend> <b>Lista de Agendamentos</b></legend>
      <table class="table">
        <thead>
          <tr>
            <th>Nome do Cliente</th>
            <th>Nome do Barbeiro</th>
            <th>Data e hora</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                      <tr>
                        <td>".$row['cliente']."</td>
                        <td>".$row['barbeiro']."</td>
                        <td>".date('d/m/Y' ,strtotime($row['data']))." - " .$row['horario']."</td>
                        <td>
                          <form action='' method='POST'>
                            <input type='hidden' name='delete_id' value='".$row['id_agendamento']."'>
                            <button type='submit' class='btn btn-danger'>Excluir</button>
                          </form>
                        </td>
                      </tr>
                    ";
                }
            }
          ?>
        </tbody>
      </table>
          </fieldset>
    </div>
</main>

</body>

</html>
