<?php
include "../connection.php";

$dias_da_semana = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];

$data_agendamento = $_POST['data'];  // Data do agendamento enviada pelo formulário

// Verificar o dia da semana baseado na data
$dayofweek = date('w', strtotime($data_agendamento));
/* 
 SELECT (selecione)
 (Tabela.coluna) abc.nome, agenda.dia_da_semana, agenda.horario_inicio, agenda.id_agenda, abc.id_usuario

  FROM agenda

  INNER JOIN abc ON abc.id_usuario = agenda.id_usuario
 (juntando coluna id_usuario das duas tabelas na tabela abc)

 WHERE agenda.dia_da_semana = $dayofweek
 ($dayofweek é o dia da semana que a pessoa colocar no cadastro da agenda exemplo: domingo = 0)

 AND agenda.id_agenda NOT IN (SELECT agenda.id_agenda  FROM agendamentos 
 (O NOT IN exclui os id_agenda já agendados para a data específica.)

  SELECT agenda.id_agenda 
  FROM agendamentos 
  (juntando a coluna id_agenda das duas tabelas na tabela agendamentos) INNER JOIN agenda ON agendamentos.id_agenda = agenda.id_agenda

 ('data' vem da pagina de cadastrar agendamentos) WHERE agendamentos.data = '$data_agendamento'
 )
 (aqui ordena por ordem crescente os horarios agendados) ORDER BY agenda.horario_inicio*/

$sql = "
SELECT 
abc.nome, agenda.dia_da_semana, agenda.horario_inicio, agenda.id_agenda, abc.id_usuario 
FROM agenda
INNER JOIN abc ON abc.id_usuario = agenda.id_usuario
WHERE agenda.dia_da_semana = $dayofweek
AND agenda.id_agenda NOT IN (
    SELECT agenda.id_agenda 
    FROM agendamentos 
    INNER JOIN agenda ON agendamentos.id_agenda = agenda.id_agenda
    WHERE agendamentos.data = '$data_agendamento'
)
ORDER BY agenda.horario_inicio

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
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
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    // Cada linha terá um formulário próprio para enviar os dados
                    echo "
                    <tr>
                            <td>".$row['nome']."</td>
                            <td>".$dias_da_semana[$row['dia_da_semana']]."</td>
                            <td>".$row['horario_inicio']."</td>
                            <td>
                                <input type='hidden' name='id_usuario' value='".$row['id_usuario']."'>
                                <input type='hidden' name='id_agenda' value='".$row['id_agenda']."'>
                                <input type='hidden' name='data' value='$data_agendamento'>
                                <a  href='insert_agendamento.php?id_agenda=".$row['id_agenda']."&data=".$data_agendamento."&id_usuario=".$row['id_usuario']."'  ><button type='submit' class='btn btn-primary'>Agendar</button></a>
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