<?php
include "../connection.php";
?>


<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <title>Tela de Agendamento</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
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
        font-size: 20px;
    }
    </style>
<body class="d-flex flex-column h-100">

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
    <div class="form">
        
        <form action="Preparando_Agendamento.php" method="post">
            <fieldset>
                <legend> <b>Criar Agendamento</b></legend>
            
            <div class="mb-3">
                <label for="data">Data do Agendamento:</label> <br>
                <input type="date" class="form-control" name="data" placeholder="Enter email" name="data">
            </div>
            <br>
            <div class="mb-3">
                <label class="form-check-label">
                    Cliente
                </label> <br>
                <select class="form-select" name="id_usuario">
                    <option>Selecione um Cliente</option>
                    
                    <?php
                    $sql = 'SELECT * FROM usuarios WHERE id_grupo = 3';
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='".$row['id_usuario']."'>".$row['nome']."</option>";
                        }
                    }
                    ?>
                </select>
                <br> <br>
                <label class="form-check-label" for="servico">Escolha o serviço:</label> <br>
                
                <select class="form-select" name="servico" id="servico">
                    <option value="1">Corte</option>
                    <option value="2">Barba</option>
                    <option value="3">Corte e Barba</option>
                </select>
                <br> <br>
                
            </div>
            <div class="mb-3">
            <button type="submit" class="btn btn-primary">Continuar</button> <br> <br>
            <a href="index.php" class="btn btn-primary">Voltar</a>
            </div>

        </fieldset>
        </form>
    </div>

</body>

</html>