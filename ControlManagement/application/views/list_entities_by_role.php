<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of All Entities</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td a {
            color: #3498db;
            text-decoration: none;
            margin-right: 10px;
        }

        p {
            margin-top: 20px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
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
    </style>
</head>
<body>
    <h1>List of All Entities</h1>

    <?php if ($this->session->flashdata('success')) : ?>
        <p class="success"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>
        <p class="error"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <?php if (!empty($entities)) : ?>
    <table>
        <thead>
            <tr>
                <th>Entity ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entities as $entity) : ?>
                <?php if ($entity->role !== 'admin') : ?>
                    <tr>
                        <td><?php echo $entity->entity_id; ?></td>
                        <td><?php echo $entity->name; ?></td>
                        <td><?php echo $entity->role; ?></td>
                        <td>
                            <a href="<?php echo base_url('increaseRole/' . $entity->entity_id); ?>">Increase Role</a>
                            <a href="<?php echo base_url('removeRole/' . $entity->entity_id); ?>">Remove Role</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else : ?>
        <p>No entities found.</p>
    <?php endif; ?>
    <div class="pagination">
    <?php echo $pagination; ?>
    </div>
</body>
</html>
