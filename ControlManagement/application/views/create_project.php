<!DOCTYPE html>
<html>
<head>
    <title>Criar um Projeto</title>
    <style>
        h1 {
            padding: 10px;
            text-align: center;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Criar um Projeto</h1>
    <form method="post" action="<?= site_url('create_project/create') ?>">
        <label for="name">Nome do Projeto:</label>
        <input type="text" name="name" required><br>
        <label for="execution_time">Tempo de Execução (Meses):</label>
        <input type="number" name="execution_time" required><br>
        <button type="submit">Criar Projeto</button>
    </form>
</body>
</html>
