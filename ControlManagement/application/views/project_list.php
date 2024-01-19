<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    h1 {
        padding: 10px;
        text-align: center;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        border: 1px solid #ddd;
        margin: 10px 0;
        padding: 10px;
    }

    strong {
        font-weight: bold;
    }

    .project-details {
        font-size: 18px;
    }

    .allocated-people {
        font-size: 16px;
    }
    .view-project-button,
    .join-button {
        background-color: #3498db;
        color: #fff;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
    }

    .pagination {
        text-align: center;
        margin-top: 20px;
    }

    .pagination a {
        display: inline-block;
        padding: 5px 10px;
        margin: 5px;
        background-color: #3498db;
        color: #fff;
        text-decoration: none;
    }

    .pagination a:hover {
        background-color: #555;
    }

    a {
        text-decoration: none;
        color: #3498db;
    }

    a:hover {
        text-decoration: underline;
    }
    .button-container {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .join-button:hover,
.view-project-button:hover {
    background-color: #2980b9; 
}
</style>

<body>

<?php if ($role == 'user'): ?>
    <h1>Projetos Convidados</h1>
<?php else: ?>
    <h1>Lista de Projetos</h1>
<?php endif; ?>

<?php if ($role == 'gestor' || $role == 'admin'): ?>
    <a href="<?= site_url('create_project') ?>" class="create-project-link">Criar Projeto</a>
<?php endif; ?>
<?php if (empty($projects)): ?>
    <p>Não há projetos disponíveis no momento.</p>
<?php else: ?>
    <ul>
        <?php foreach ($projects as $project): ?>
            <li>
                <strong>Nome:</strong> <?= $project->name ?><br>
                <strong>Número de Pessoas Alocadas:</strong>
                <?php
                    if (count($project->allocated_people) > 0) {
                        echo count($project->allocated_people);
                    } else {
                        echo "0";
                    }
                ?><br>
                <strong>Tempo de Execução (Meses):</strong> <?= $project->execution_time ?><br>
                <div class="button-container">
                <form method="post" action="<?= site_url('project_details/show/' . $project->project_id) ?>">
                    <button type="submit" class="view-project-button">Ver Projeto</button>
                </form> 
                <form method="post" action="<?= site_url('join_project/' . $project->project_id) ?>">
                    <button type="submit" class="join-button">Participar no Projeto</button>
                </form>
            </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php if ($role == 'gestor' || $role == 'admin'): ?>
        <a href="<?= site_url('project_reports') ?>" class="create-project-link">
            <button>Relatórios de Projeto</button>
        </a>

        <a href="<?= site_url('person_reports') ?>" class="create-project-link">
            <button>Relatórios de Pessoas</button>
        </a>
    <?php endif; ?>

    <div class="pagination">
        <?php echo $links; ?>
    </div>
<?php endif; ?>
</body>
</html>
