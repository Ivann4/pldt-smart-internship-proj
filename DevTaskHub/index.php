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
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .text-center {
            text-align: center;
        }

        .text-secondary {
            color: #6c757d;
        }

        .text-primary {
            color: #007bff;
        }

        .text-primary:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">DevTask Hub</h1>
        <p class="subtitle">Task Management System</p>
        <hr class="divider"/>
        <form id="loginForm">
            <div class="form-group">
                <input type="email" placeholder="Email" class="form-control" >
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" class="form-control" required>
            </div>
            <button type="submit" class="btn">Log in</button>
        </form>
        <p class="text-center text-secondary mt-4">
            Don't have an account? <a href="register.php" class="text-primary">Register now!</a><br>
            Or <a href="loginAdmin.php" class="text-primary">Login As Admin</a>
        </p>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            window.location.href = 'empDashboard.php';
        });
    </script>
</body>
</html>
