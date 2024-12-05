<?php

include "../connection.php";
$sql = "SELECT * FROM usuarios ";
$result = $conn->query($sql);
// echo "<pre>";
// print_r([
//   'usuario' => $result->fetch_assoc()['id_usuario']
// ]);
// exit();

$grupos = [1=> "Administrador", 2 => "Barbeiro", 3 => "Clientes"];
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
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
    .lista {
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
    
    </style>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
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

<div class="lista">
    <fieldset>
  <legend><b>Lista de usuários<b></legend>           
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Grupo</th>
      </tr>
    </thead>
    <tbody>
      <?php
      
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>".$row['id_usuario']."</td><td>".$row['nome']."</td><td>".$grupos[$row['id_grupo']]."</td></tr>";
        }
      }
      ?>
    </tbody>
  </table>
  </fieldset>
</div>

</body>
</html>