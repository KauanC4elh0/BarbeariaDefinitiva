<?php
include "../connection.php";
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
    .mb-3{
        border: none;
        padding: 8px;
        border-radius: 10px;
        outline: none;
        font-size: 20px;
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

    <div class="form">
        <form action="criar_agenda.php" method="post">
            <fieldset>
            <legend><b>Cadastro da agenda do Barbeiro</b></legend>
            <div class="mb-3">
                <label class="form-check-label">
                    Barbeiro:
                </label> <br>
                <select class="form-select" name="id_usuario">
                    <option>Selecione um barbeiro:</option>
                    <?php
                    $sql = 'SELECT * FROM usuarios WHERE id_grupo = 2';
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='".$row['id_usuario']."'>".$row['nome']."</option>";
                        }
                    }
                    ?>

                </select>
            </div>

            <div class="mb-3">
                <label class="form-check-label">
                    Dia da semana:
                </label>
                <select class="form-select" name="dia_da_semana">
                    <option>Selecione o dia da semana</option>
                    <option value="0">Domingo</option>
                    <option value="1">Segunda-feira</option>
                    <option value="2">Terça-feira</option>
                    <option value="3">Quarta-feira</option>
                    <option value="4">Quinta-feira</option>
                    <option value="5">Sexta-feira</option>
                    <option value="6">Sábado</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="horario_inicio">Horário início:</label> <br>
                <input type="time" class="form-control" name="horario_inicio" placeholder="Enter email"
                    name="horario_inicio">
            </div>

            <div class="mb-3">
                <label for="horario_saida_intervelo">Horário saída intervalo:</label> <br>
                <input type="time" class="form-control" name="horario_saida_intervelo" placeholder="Enter email"
                    name="horario_saida_intervelo">
            </div>

            <div class="mb-3">
                <label for="horario_volta_intervela">Horário volta intervalo:</label>
                <input type="time" class="form-control" name="horario_volta_intervela" placeholder="Enter email"
                    name="horario_volta_intervela">
            </div>

            <div class="mb-3">
                <label for="horario_fim">Horário fim:</label> <br>
                <input type="time" class="form-control" name="horario_fim" placeholder="Enter email" name="horario_fim">
            </div>


            <button type="submit" class="btn btn-primary">Cadastrar</button>
                </fieldset>
        </form>
    </div>

</body>

</html>