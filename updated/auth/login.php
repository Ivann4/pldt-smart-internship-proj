<!DOCTYPE html>
<?php    
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevTask Hub</title>
<style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background-color: #f0f4f8; /* Light background */
        color: #212529; /* Dark text */
    }

    .container {
        background-color: #ffffff;
        padding: 32px; 
        border-radius: 12px; 
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
        width: 100%;
        max-width: 400px; 
    }

    .title {
        font-size: 2rem;
        font-weight: bold; 
        text-align: center; 
        margin-bottom: 16px; 
        color: #212529; 
    }

    .subtitle {
        text-align: center; /* Centered text */
        color: #6c757d; /* Secondary text */
        margin-bottom: 24px; /* Bottom margin */
    }

    .form-group {
        margin-bottom: 16px; /* Bottom margin */
    }

    .form-control {
        width: 100%; /* Full width */
        padding: 12px; /* Padding */
        border: 1px solid #ced4da; /* Border */
        border-radius: 8px; /* Rounded corners */
        box-sizing: border-box; /* Box sizing */
    }

    .btn {
        width: 100%; /* Full width */
        padding: 12px; /* Padding */
        border: none; /* No border */
        border-radius: 8px; /* Rounded corners */
        background-color: #007bff; /* Primary color */
        color: white; /* White text */
        cursor: pointer; /* Pointer cursor */
    }

    .btn:hover {
        background-color: #0056b3; /* Darker primary color on hover */
    }

    .text-center {
        text-align: center; /* Centered text */
    }

    .text-secondary {
        color: #6c757d; /* Secondary text color */
    }

    .text-primary {
        color: #007bff; /* Primary text color */
    }

    .text-primary:hover {
        text-decoration: underline; /* Underline on hover */
    }
</style>
</head>
<body>
    <div class="container">
        <h1 class="title">DevTask Hub</h1>
        <p class="subtitle">Task Management System</p>
        <hr class="divider"/>
        <br>
        <form action="/auth/auth.php?authType=login" method="POST">
            <div class="form-group">
                <input type="email" placeholder="Email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn">Log in</button>
        </form>
        <p class="text-center text-secondary mt-4">
            Don't have an account? <a href="/auth/register.php" class="text-primary">Register as User!</a><br>
            Or <a href="/auth/registerAdmin.php" class="text-primary">Register as Admin!</a>
        </p>
    </div>
</body>
</html>
