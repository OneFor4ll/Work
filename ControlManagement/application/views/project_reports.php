<style>
   
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #ccc;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }

   
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

   
    h1 {
        margin-top: 40px;
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
</style>

<h1>Relatórios de Projeto</h1>
<table>
    <tr>
        <th>ID do Projeto</th>
        <th>Nome do Projeto</th>
        <th>Número de Pessoas</th>
    </tr>
    <?php foreach ($project_reports as $report) : ?>
        <tr>
            <td><?= $report->project_id ?></td>
            <td><?= $report->project_name ?></td>
            <td><?= $report->num_people ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="pagination-links">
<?php echo $pagination_links; ?>
</div>

