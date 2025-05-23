<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agenda TCC's Praia Grande</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .mensagem-sucesso {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 1.1em;
        }
        .mensagem-erro {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 1.1em;
        }
    </style>
</head>
<body>

    <header>
        <h1>Agenda TCC's Praia Grande</h1>
    </header>

    <div class="container">
        <?php
        session_start();
        if (isset($_SESSION['mensagem_sucesso'])): ?>
            <div class="mensagem-sucesso">
                <?= $_SESSION['mensagem_sucesso'] ?>
            </div>
            <?php unset($_SESSION['mensagem_sucesso']);
        endif;

        if (isset($_SESSION['mensagem_erro'])): ?>
            <div class="mensagem-erro">
                <?= $_SESSION['mensagem_erro'] ?>
            </div>
            <?php unset($_SESSION['mensagem_erro']);
        endif;
        ?>

        <form action="backend/salvarTcc.php" method="POST">
            <div class="form-group">
                <label for="tipo">Tipo de TCC:</label>
                <select name="tipo" id="tipo" required>
                    <option value="Artigo">Artigo</option>
                    <option value="Monografia">Monografia</option>
                    <option value="Relatório Técnico">Relatório Técnico</option>
                </select>
            </div>

            <div class="form-group">
                <label for="titulo">Título do TCC:</label>
                <input type="text" name="titulo" id="titulo" required>
            </div>

            <div class="form-group">
                <label>Alunos Integrantes (até 3):</label>
                <input type="text" name="aluno1" placeholder="Aluno 1" required>
                <input type="text" name="aluno2" placeholder="Aluno 2 (opcional)">
                <input type="text" name="aluno3" placeholder="Aluno 3 (opcional)">
            </div>

            <div class="form-group">
                <label for="orientador">Professor Orientador:</label>
                <input type="text" name="orientador" id="orientador" required>
            </div>

            <div class="form-group">
                <label for="coorientador">Professor Co-orientador: <span class="optional">(opcional)</span></label>
                <input type="text" name="coorientador" id="coorientador">
            </div>

            <div class="form-group">
                <label for="apresentacao">Data e Hora da Apresentação:</label>
                <input type="datetime-local" name="apresentacao" id="apresentacao" required>
            </div>

            <button type="submit">Cadastrar TCC</button>
        </form>
    </div>
    <a href="agenda.php" class="btn-agenda-completa">Agenda Completa</a>

</body>
</html>