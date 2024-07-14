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
    <title>My Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .profile-card h3 {
            margin: 10px 0 5px;
            font-size: 24px;
            color: #333;
        }

        .profile-card p {
            margin: 5px 0;
            font-size: 16px;
            color: #777;
        }

        .profile-card .contact-info {
            margin-top: 10px;
        }

        .profile-card .contact-info p {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="profile-card">
    <?php
        require_once($_SERVER['DOCUMENT_ROOT'] . '/auth/auth.php');
        $db = Database::getInstance();
        $result = $db->getAllUserInformation();
        $row = $result->fetch_assoc();
        echo '<h2>My Profile</h2>';
        echo '<h4>'.$row['fname'].' '.$row['lname'].'</h4>';
        echo '<p>Email: '.$row['email'].'</p>';
        echo '<p>Phone: '.$row['phone_number'].'</p>';
        echo '<p>Position: '.$row['position'].'</p>';
        echo '<p>Team: '.$row['team_name'].'</p>';
        echo '<p>Department: '.$row['Department'].'</p>';
        echo '<p>Reports to: '.$row['administrator_name'].'</p>';
    ?>
    </div>
</body>
</html>
