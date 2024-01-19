<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
    }

    h1 {
        text-align:center;
        color: #007bff;
    }

    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: #fff;
    }

    tbody tr:hover {
        background-color: #f5f5f5;
    }

    a {
        text-decoration: none;
        color: #007bff;
    }

    a:hover {
        text-decoration: underline;
    }

   
    .invite-link {
        background-color: #28a745;
        color: #fff;
        padding: 8px 12px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
    }

    .invite-link:hover {
        background-color: #218838;
    }
    .pagination-links {
        text-align: center;
        margin-top: 20px;
    }

    .pagination-links a {
        display: inline-block;
        padding: 5px 10px;
        margin: 0 5px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }

    .pagination-links a:hover {
        background-color: #0056b3;
    }

    .message-container {
        margin: 20px auto;
        padding: 15px;
        width: 80%;
        text-align: center;
    }

    .success-message {
        background-color: #28a745;
        color: #fff;
        border-radius: 5px;
    }

    .error-message {
        background-color: #dc3545;
        color: #fff;
        border-radius: 5px;
    }
</style>
<body>
    <a href="<?= site_url('project_details/show/' . $projectId); ?>">Voltar aos Detalhes do Projeto</a>
    <?php if ($this->session->flashdata('success_message')) : ?>
    <div class="message-container">
        <p class="success-message"><?= $this->session->flashdata('success_message'); ?></p>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error_message')) : ?>
    <div class="message-container">
        <p class="error-message"><?= $this->session->flashdata('error_message'); ?></p>
    </div>
<?php endif; ?>

    <h1>Lista de Utilizadores</h1>
    <table>
        <thead>
            <tr>
                <th>ID do Utilizador</th>
                <th>Nome</th>
                <th>Projetos</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->entity_id; ?></td>
                    <td><?= $user->name; ?></td>
                    <td><?= $this->InviteModel->getProjectsInfo($user->entity_id); ?></td>
                    <td><a href="<?= site_url('invite/sendInvitation/' . $user->entity_id . '/' . $projectId); ?>">Convidar</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination-links">
    <?php echo $links; ?>
</div>
</body>
