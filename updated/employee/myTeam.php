<!DOCTYPE html>
<?php
    session_start();
    if (!isset($_SESSION['authenticated']) && $_SESSION['authenticated'] !== true) {
        header('Location: /auth/login.php');
        exit;
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Team</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Three columns */
            gap: 20px;
            padding: 20px;
            max-width: 1200px; /* Limit max width for responsiveness */
        }

        .card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
        }

        .card img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .card h3 {
            margin: 10px 0 5px;
            font-size: 18px;
            color: #333;
        }

        .card p {
            margin: 0;
            font-size: 14px;
            color: #777;
        }

        .icons {
            margin-top: 10px;
        }

        .icons img {
            width: 24px;
            height: 24px;
            margin: 0 5px;
        }
    </style>
</head>
<body>

<div class="grid-container">
    <?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/auth/auth.php');
    $users = Database::getInstance()->getDepartmentUsers();
    if($users->num_rows > 0) {
        while($row = $users->fetch_assoc()) {
            echo '<div class="card">';
            echo '<img src="https://placehold.co/100x100" alt="'.$row['name'].'" />';
            echo '<h3>'.$row['fname'].' '.$row['lname'].'</h3>';
            echo '<p>'.$row['role'].'</p>';
            echo '<div class="icons">';
            echo '<img src="https://placehold.co/24x24?text=🔗" alt="LinkedIn" />';
            echo '<img src="https://placehold.co/24x24?text=🔗" alt="Teams" />';
            echo '</div>';
            echo '</div>';
        }
    }else{
        echo '<p>No users found</p>';
    }
    ?>
</div>

</body>
</html>
