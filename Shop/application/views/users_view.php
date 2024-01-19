<style>
    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .pagination a {
        display: inline-block;
        padding: 5px 10px;
        margin: 0 2px;
        text-decoration: none;
        color: #000;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .pagination a.prev,
    .pagination a.next {
        font-weight: bold;
    }

    .pagination a.current {
        background-color: #ccc;
    }

    .pagination select {
        margin: 0 10px;
        padding: 5px;
    }

    .center-table {
        margin: 0 auto;
        font-size: 1.2em;
        border-collapse: collapse;
    }

    .center-table th,
    .center-table td {
        padding: 10px;
        border: 1px solid #ccc;
    }

    .back-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #337ab7;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
    }

    .back-button:hover {
        background-color: #23527c;
    }

    .back-button:focus {
        outline: none;
    }

    .cargo-buttons {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }

    .cargo-buttons a {
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 10px;
        padding: 10px 20px;
        background-color: #337ab7;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
    }

    .cargo-buttons a:last-child {
        margin-right: 0;
    }

    .cargo-buttons a:hover {
        background-color: #23527c;
    }

    .cargo-buttons a:focus {
        outline: none;
    }

    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }

    .action-buttons a {
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 10px;
        padding: 10px 20px;
        background-color: #337ab7;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
    }

    .action-buttons a:last-child {
        margin-right: 0;
    }

    .action-buttons a:hover {
        background-color: #23527c;
    }

    .action-buttons a:focus {
        outline: none;
    }
</style>

<main>
    <div class="container">
        <h1 class="centered-heading">Lista de Utilizadores</h1>

        <table class="center-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Cargo</th>
                    <th>Ações</th>
                    <th>Dar Cargo</th>
                </tr>
            </thead>
            <tbody>
                {users}
                <tr>
                    <td>{id}</td>
                    <td>{first_name} {last_name}</td>
                    <td>{email}</td>
                    <td>{role}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="<?= site_url('admin/ban_user/{id}') ?>" onclick="return confirm('Tem a certeza de que pretende banir este utilizador?')">Banir</a>
                            <a href="<?= site_url('admin/unban_user/{id}') ?>" onclick="return confirm('Tem a certeza de que pretende remover a suspensão deste utilizador?')">Remover Suspensão</a>
                        </div>
                    </td>
                    <td>
                        <?php if ($role == 'admin'): ?>
                        <div class="cargo-buttons">
                            <a href="<?= site_url('admin/assign_role_seller/{id}') ?>">Atribuir Cargo de Vendedor</a>
                            <a href="<?= site_url('admin/remove_role_seller/{id}') ?>" onclick="return confirm('Tem a certeza de que pretende remover o cargo de vendedor?')">Remover Cargo de Vendedor</a>
                        </div>
                        <?php endif; ?>
                    </td>
                </tr>
                {/users}
            </tbody>
        </table>

        <div class="pagination">
            <?php if ($currentPage > 1): ?>
                <a href="<?= site_url('admin?page=' . ($currentPage - 1)) ?>" class="prev">&lt;</a>
            <?php else: ?>
                <span class="prev disabled">&lt;</span>
            <?php endif; ?>

            <select id="users-per-page" onchange="changeUsersPerPage(this.value)">
                <option value="5" <?= $usersPerPage == 5 ? 'selected' : '' ?>>5</option>
                <option value="10" <?= $usersPerPage == 10 ? 'selected' : '' ?>>10</option>
                <option value="50" <?= $usersPerPage == 50 ? 'selected' : '' ?>>50</option>
                <option value="100" <?= $usersPerPage == 100 ? 'selected' : '' ?>>100</option>
            </select>

            <?php if ($currentPage < $totalPages): ?>
                <a href="<?= site_url('admin?page=' . ($currentPage + 1)) ?>" class="next">&gt;</a>
            <?php else: ?>
                <span class="next disabled">&gt;</span>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function changeUsersPerPage(value) {
            window.location.href = "<?= site_url('admin?page=1&users_per_page=') ?>" + value;
        }
    </script>
</main>
