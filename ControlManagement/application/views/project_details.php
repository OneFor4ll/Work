<style>
   
    h1 {
        font-size: 24px;
        margin-bottom: 10px;
        padding: 5px;
    }

    .project-info {
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 20px;
    }

    .project-info p {
        margin: 5px 0;
    }

   
    #deleteProjectBtn {
        background-color: #e74c3c;
        color: #fff;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
    }

    #deleteProjectConfirm {
        display: none;
        background-color: #f2dede;
        border: 1px solid #ebccd1;
        padding: 10px;
        margin-top: 10px;
    }

    #confirmDeleteBtn, #cancelDeleteBtn {
        background-color: #e74c3c;
        color: #fff;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
        margin: 5px;
    }

    #inviteButton {
        background-color: green;
        color: #fff;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
    }

    #inviteButton:hover {
        background-color: #218838;
    }

   
    h2 {
        font-size: 20px;
        margin-bottom: 10px;
        padding: 30px;
        text-align: center;
    }

    table {
        width: 100%;
        margin: 20px auto;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        overflow-x: auto; 
    }

    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: #fff;
        position: sticky;
        left: 0;
        z-index: 1;
    }

    tbody tr:hover {
        background-color: #f5f5f5;
    }

    .saveBtn {
        width: 100%;
        background-color: #28a745;
        color: #fff;
        padding: 8px 12px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .saveBtn:hover {
        background-color: #218838;
    }
</style>

<h1>Detalhes do Projeto</h1>
<p><strong>Nome do Projeto:</strong> <?= $project->name ?></p>
<p><strong>Número de Pessoas Alocadas:</strong>
    <?php
    if (count($allocated_people) > 0) {
        echo count($allocated_people);
    } else {
        echo "0";
    }
    ?>
</p>
<p><strong>Tempo de Execução (Meses):</strong> <?= $project->execution_time ?></p>
<?php if ($isProjectCreator || $userRole === 'admin'): ?>
    <button id="deleteProjectBtn">Eliminar Projeto</button>
    <?php if ($isProjectCreator || in_array($userRole, ['admin'])): ?>
        <button id="inviteButton" onclick="location.href='<?= site_url('invite/' . $project->project_id) ?>'">Convidar</button>
    <?php endif; ?>
    <div id="deleteProjectConfirm" style="display: none;">
        Tem a certeza que deseja eliminar este projeto?
        <button id="confirmDeleteBtn">Sim, Eliminar</button>
        <button id="cancelDeleteBtn">Cancelar</button>
    </div>
<?php endif; ?>

<h2>Pessoas Alocadas</h2>
<?php if ($no_allocated_people): ?>
    <p>Não há pessoas alocadas a este projeto.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Nome</th>
            <th>Função</th>
            <th>Percentagem</th>
            <th>Horas por Dia</th>
            <th>Horas por Mês</th>
            <th>Custo por Hora</th>
            <th>Custo Mensal</th>
            <?php if ($isProjectCreator || $userRole === 'admin'): ?>
                <th>Ações</th>
            <?php endif; ?>
        </tr>
        <?php foreach ($allocated_people as $person) : ?>
            <tr data-entity-id="<?= $person->entity_id ?>">
                <td contenteditable="false">
                    <?= $person->person_name ?>
                </td>
                <td contenteditable="<?= ($isProjectCreator || $userRole === 'admin') ? 'true' : 'false' ?>">
                    <?= $person->function ?>
                </td>
                <td contenteditable="<?= ($isProjectCreator || $userRole === 'admin') ? 'true' : 'false' ?>">
                    <?= $person->percentage ?>%
                </td>
                <td contenteditable="<?= ($isProjectCreator || $userRole === 'admin') ? 'true' : 'false' ?>">
                    <?= $person->hours_per_day ?>
                </td>
                <td contenteditable="<?= ($isProjectCreator || $userRole === 'admin') ? 'true' : 'false' ?>">
                    <?= $person->hours_per_month ?>
                </td>
                <td contenteditable="<?= ($isProjectCreator || $userRole === 'admin') ? 'true' : 'false' ?>">
                    <?= $person->hourly_cost ?>€
                </td>
                <td contenteditable="<?= ($isProjectCreator || $userRole === 'admin') ? 'true' : 'false' ?>">
                    <?= $person->monthly_cost ?>€
                </td>
                <?php if ($isProjectCreator || $userRole === 'admin'): ?>
                    <td>
                        <button class="saveBtn">Salvar</button>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var deleteBtn = document.getElementById('deleteProjectBtn');
    var confirmDeleteDiv = document.getElementById('deleteProjectConfirm');
    var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    var cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

    deleteBtn.addEventListener('click', function () {
        confirmDeleteDiv.style.display = 'block';
    });

    cancelDeleteBtn.addEventListener('click', function () {
        confirmDeleteDiv.style.display = 'none';
    });

    confirmDeleteBtn.addEventListener('click', function () {
        window.location.href = "<?= site_url('project_details/delete/' . $project->project_id) ?>";
    });

    var saveBtns = document.querySelectorAll('.saveBtn');

    saveBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            
            var editedRow = btn.closest('tr');
            var entityId = editedRow.getAttribute('data-entity-id');
            var editedData = {
                person_name: editedRow.cells[0].innerText,
                function: editedRow.cells[1].innerText,
                percentage: editedRow.cells[2].innerText,
                hours_per_day: editedRow.cells[3].innerText,
                hours_per_month: editedRow.cells[4].innerText, 
                hourly_cost: editedRow.cells[5].innerText,
                monthly_cost: editedRow.cells[6].innerText, 
            };

            editedData.hours_per_month = editedData.hours_per_day * 22; 
            editedData.monthly_cost = editedData.hours_per_month * editedData.hourly_cost;     
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('project_details/update_allocation'); ?>',
                data: {
                    entity_id: entityId,
                    project_id: <?= $project->project_id ?>,
                    function: editedData.function,
                    percentage: editedData.percentage,
                    hours_per_day: editedData.hours_per_day,
                    hours_per_month: editedData.hours_per_month,
                    hourly_cost: editedData.hourly_cost,
                    monthly_cost: editedData.monthly_cost,
                    
                },
                success: function (response) {
                    console.log('AJAX Response:', response);
                    //location.reload(); comment this if you want to stop to refresh
                    location.reload();
                },
                error: function (error) {
                    console.error('AJAX Error:', error);
                },
            });
        });
    });
});
</script>