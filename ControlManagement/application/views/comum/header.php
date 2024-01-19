<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Your Project Title</title>
    <style>
        header {
            background-color: gray;
            color: #fff;
            padding: 10px 10px;
            text-align: right;
            
        }
        body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0px;
    }
        nav ul {
            list-style: none;
            padding: 0;
        }
        li {
        border: 1px solid #ddd; 
        margin: 10px 0;
        padding: 10px;
    }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }
    </style>
    <header>
        <nav>
            <ul>
                <li><a href="<?php echo site_url('projects'); ?>">Home</a></li>
                
                <?php if ($this->session->userdata('role') === 'admin'): ?>
                <li><a href="<?php echo site_url('role'); ?>">Role</a></li>
            <?php endif; ?>
                
                <li><a href="<?php echo site_url('logout'); ?>">Logout</a></li>
            </ul>
        </nav>
    </header>
