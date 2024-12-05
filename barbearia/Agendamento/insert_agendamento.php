<?php

include "../connection.php";

echo "<pre>";


$parts = parse_url($_SERVER['REQUEST_URI']);
parse_str($parts['query'], $query);

// echo "<pre>";
// print_r($query);
// exit();
$id_agenda = $query['id_agenda'];
$data = $query['data'];
$id_usuario = $query['id_usuario'];
$servico = $query['id_servico'];
$sql_agendamento = "
    INSERT INTO agendamentos 
    (id_usuario, id_agenda, data, id_servico)
    VALUES
    ($id_usuario, $id_agenda, '$data', $servico)
";


if($conn->query($sql_agendamento))
echo "dados incluídos";
else
echo "Erro ao incluir";

//   // Receber os dados do formulário do arquivo  Cadastrar_Agendamento.php e do DadosAgendamentos.php
//     $id_usuario = $_POST['id_usuario'];
//     $id_agenda = $_POST['id_agenda'];
//     $data = $_POST['data'];

//     // verificando se o agendamento já existe

// /*O SELECT 1 só verifica se existe algum registro que 
//     atenda à condição, sem precisar trazer dados.
//      Se achar algum, indica que o agendamento já existe. */

//     $check_sql = "SELECT 1 FROM agendamentos WHERE id_usuario = '$id_usuario' AND id_agenda = '$id_agenda' AND data = '$data' LIMIT 1";
    
//     $check_result = $conn->query($check_sql);
    
//     if ($check_result->num_rows > 0) {
//         echo "Este agendamento já foi realizado.";
//     } else {
//         // Inserir no banco de dados
//         $sql = "INSERT INTO agendamentos (id_usuario, id_agenda, data) 
//                 VALUES ('$id_usuario', '$id_agenda', '$data')";

//         if ($conn->query($sql) === TRUE) {
//             echo "Novo agendamento inserido com sucesso!";
//         } else {
//             echo "Erro ao inserir agendamento: " . $conn->error;
//         }
//     }

// // Fechar a conexão
// $conn->close();
?>
