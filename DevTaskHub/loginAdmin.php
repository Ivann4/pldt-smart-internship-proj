<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevTask Hub</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
            color: #212529;
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
            text-align: center;
            color: #6c757d;
            margin-bottom: 24px;
        }

        .divider {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #e0e0e0;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #0E9344;
            color: white;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn:hover {
            background-color: #106834;
        }

        .text-center {
            text-align: center;
        }

        .text-secondary {
            color: #6c757d;
        }

        .text-primary {
            color: #0E9344;
        }

        .text-primary:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">DevTask Hub</h1>
        <p class="subtitle">Task Management System <b>(Admin Access)</b></p>
        <hr class="divider"/>
        <form action="adminDashboard.php" method="POST">
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>
            <button type="submit" class="btn">Log in</button>
        </form>
        <p class="text-center text-secondary mt-4">
            Don't have an account? <a href="registerAdmin.php" class="text-primary">Register now!</a><br>
            Or <a href="index.php" class="text-primary">Login As Employee</a>
        </p>
    </div>
</body>
</html>
