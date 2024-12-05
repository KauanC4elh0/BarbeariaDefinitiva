<?php
include "../connection.php";

function gerarAgendamentos($inicio, $final, $dia_da_semana, $id_usuario, $conn) {
    // Calcular a quantidade de minutos entre o horário inicial e final
    $mins = abs(($inicio - $final) / 60);
    $qnt_de_agendamento = $mins / 30;
    $acumulado = $inicio;

    // Controle de loop para garantir que o agendamento não entre em loop infinito
    for ($i = 0; $i < $qnt_de_agendamento; $i++) {
        // Formatar o horário para o padrão 'H:i'
        $horario = date('H:i', $acumulado);
        echo "\n Criado agendamento no horário para: $horario";

        // Verifica se o agendamento foi inserido corretamente
        if (incluirAgenda($dia_da_semana, $id_usuario, $horario, $conn)) {
            echo " Novo agendamento criado com sucesso!";
        } else {
            echo " Erro ao criar agendamento!";
        }

        // Incrementa 30 minutos (1800 segundos) para o próximo agendamento
        $acumulado += 1800;  // 1800 segundos = 30 minutos
    }
}

function incluirAgenda($dia_da_semana, $id_usuario, $horario, $conn) {
    // Preparar o SQL para inserir na tabela
    $sql_agenda = "INSERT INTO agendas (dia_da_semana, id_usuario, horario) 
                   VALUES ('$dia_da_semana', $id_usuario, '$horario')";

    // Executar o SQL e verificar se foi bem-sucedido
    if ($conn->query($sql_agenda) === TRUE) {
        return true;  // Retorna verdadeiro se o agendamento foi inserido com sucesso
    } else {
        // Caso ocorra erro, imprime a mensagem e retorna falso
        echo "Erro: " . $sql_agenda . "<br>" . $conn->error;
        return false;  // Retorna falso se ocorreu erro na inserção
    }
}

echo "<h1>Geração de agendamentos do primeiro horário!</h1>";

// Verifica se os dados do POST estão presentes antes de processar
if (isset($_POST['horario_inicio']) && isset($_POST['horario_saida_intervalo']) && isset($_POST['dia_da_semana']) && isset($_POST['id_usuario'])) {
    gerarAgendamentos(strtotime($_POST['horario_inicio']), strtotime($_POST['horario_saida_intervalo']), $_POST['dia_da_semana'], $_POST['id_usuario'], $conn);
} else {
    echo "Dados do primeiro horário não foram fornecidos corretamente.";
}

echo "<h1>Geração de agendamentos do segundo horário!</h1>";

// Verifica se os dados do segundo horário estão presentes antes de processar
if (isset($_POST['horario_volta_intervela']) && isset($_POST['horario_fim']) && isset($_POST['dia_da_semana']) && isset($_POST['id_usuario'])) {
    gerarAgendamentos(strtotime($_POST['horario_volta_intervela']), strtotime($_POST['horario_fim']), $_POST['dia_da_semana'], $_POST['id_usuario'], $conn);
} else {
    echo "Dados do segundo horário não foram fornecidos corretamente.";
}
?>
