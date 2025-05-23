<?php

session_start();

require 'tcc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tcc = new Tcc();
    $dataHoraApresentacao = $_POST['apresentacao'];

    if (!$tcc->verificarDisponibilidade($dataHoraApresentacao)) {
        $_SESSION['mensagem_erro'] = "Já existe um agendamento para a data e hora selecionadas.";
        header('Location: ../index.php');
        exit;
    }

    $dados = [
        'tipo' => $_POST['tipo'],
        'titulo' => $_POST['titulo'],
        'aluno1' => $_POST['aluno1'],
        'aluno2' => $_POST['aluno2'] ?? '',
        'aluno3' => $_POST['aluno3'] ?? '',
        'orientador' => $_POST['orientador'],
        'coorientador' => $_POST['coorientador'] ?? '',
        'apresentacao' => $dataHoraApresentacao,
    ];

    if ($tcc->salvar($dados)) {
        $_SESSION['mensagem_sucesso'] = "TCC agendado com sucesso!";
        header('Location: ../index.php');
        exit;
    } else {
        $_SESSION['mensagem_erro'] = "Erro ao salvar o TCC.";
        header('Location: ../index.php');
        exit;
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    echo 'Método não permitido.';
}

?>