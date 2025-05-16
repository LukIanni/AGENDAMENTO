<?php
// Pega o ID via GET
$id = $_GET['id'] ?? null;

// Carrega os TCCs
$tccs = [];

if (file_exists('data/tccs.json')) {
    $json = file_get_contents('data/tccs.json');
    $tccs = json_decode($json, true);
}

$tcc = null;

if ($id !== null && isset($tccs[$id])) {
    $tcc = $tccs[$id];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualizar TCC</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .detalhes-container {
            max-width: 800px;
            margin: 30px auto;
            background-color: #2c2c2c;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(139, 0, 0, 0.7);
        }

        .detalhes-container p {
            font-size: 1.1em;
            margin-bottom: 15px;
        }

        .voltar {
            display: inline-block;
            margin-top: 20px;
            background-color: #8B0000;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .voltar:hover {
            background-color: #a80000;
        }
    </style>
</head>
<body>

    <header>
        <h1><?= $tcc ? htmlspecialchars($tcc['titulo']) : 'TCC não encontrado' ?></h1>
    </header>

    <div class="detalhes-container">
        <?php if ($tcc): ?>
            <p><strong>Tipo de TCC:</strong> <?= $tcc['tipo'] ?></p>
            <p><strong>Aluno 1:</strong> <?= $tcc['aluno1'] ?></p>
            <?php if (!empty($tcc['aluno2'])): ?>
                <p><strong>Aluno 2:</strong> <?= $tcc['aluno2'] ?></p>
            <?php endif; ?>
            <?php if (!empty($tcc['aluno3'])): ?>
                <p><strong>Aluno 3:</strong> <?= $tcc['aluno3'] ?></p>
            <?php endif; ?>
            <p><strong>Professor Orientador:</strong> <?= $tcc['orientador'] ?></p>
            <?php if (!empty($tcc['coorientador'])): ?>
                <p><strong>Professor Co-orientador:</strong> <?= $tcc['coorientador'] ?></p>
            <?php endif; ?>
            <p><strong>Data e Hora da Apresentação:</strong> <?= date('d/m/Y H:i', strtotime($tcc['apresentacao'])) ?></p>

            <a href="agenda.php" class="voltar">← Voltar para Agenda</a>
        <?php else: ?>
            <p>TCC não encontrado.</p>
            <a href="agenda.php" class="voltar">← Voltar para Agenda</a>
        <?php endif; ?>
    </div>

</body>
</html>

