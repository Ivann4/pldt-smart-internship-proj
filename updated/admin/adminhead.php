<!DOCTYPE html>
<?php
    session_start();
    if (!isset($_SESSION['authenticated']) && $_SESSION['authenticated'] !== true) {
        header('Location: /auth/login.php');
        exit;
    }
    if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: /auth/login.php');
        exit;
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        body {
            display: flex;
        }

        .dashboard {
            display: flex;
            width: 100%;
            height: 100%;
        }

        .right-sidebar {
            background-color: #fff;
            padding: 20px;
            width: 25%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .main {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .header {
            margin-bottom: 20px;
        }

        .header .user {
            color: #007bff;
        }

        .tasks, .deadlines {
            margin-bottom: 20px;
        }

        .tasks-list, .deadlines-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .task, .deadline {
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            flex: 1;
            flex-basis: calc(50% - 10px);
        }

        .task .progress {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .task .progress-bar {
            height: 10px;
            background-color: #007bff;
            border-radius: 5px;
            flex: 1;
            margin-right: 10px;
        }

        .summary, .activities {
            margin-bottom: 20px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .stat {
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
        }

        .sidebar {
            width: 15%;
            height: 100vh;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .logo img {
            max-width: 100%;
            max-height: 100px;
            height: auto;
        }

        .department-name {
            width: 100%;
            text-align: center;
        }

        .department-name a {
            color: #007bff;
            font-size: 16px;
            margin: 20px 0;
            text-decoration: none;
        }

        .menu {
            width: 100%;
            flex-grow: 1;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
        }

        .menu-item img {
            margin-right: 10px;
            width: 20px;
            height: 20px;
        }

        .menu-item.active {
            color: #007bff;
            font-weight: bold;
        }

        .menu-item.active .dot {
            width: 6px;
            height: 6px;
            background-color: #007bff;
            border-radius: 50%;
            margin-left: auto;
        }

        .logout {
            width: 80%;
            padding: 20px;
            background-color: #f0f8ff;
            text-align: center;
            border-radius: 10px;
            margin-top: 20px; /* Updated margin to ensure it doesn't overflow */
        }

        .time {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .date {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .logout-btn {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }

        .logout-btn .arrow {
            font-size: 16px;
        }

        .container {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h2 {
            margin-bottom: 10px;
        }

        .task-pool {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .task-card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #DBE2EF;
        }

        .task-card h3 {
            margin: 0 0 10px;
        }

        .task-card p {
            margin: 0;
        }

        .deadlines-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .deadlines {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .deadline-card {
            padding: 10px;
            border-radius: 10px;
            background-color: #f5f5f5;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e0e0e0;
            border-radius: 50%;
            margin-right: 10px;
            font-weight: bold;
        }

        .content {
            flex: 1;
        }

        .content h3 {
            margin: 0 0 5px;
        }

        .content p {
            margin: 0;
            color: #757575;
        }

        .options {
            font-size: 24px;
            color: #bdbdbd;
        }

        .popup {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            width: 100%;
        }

        .popup-content {
            text-align: left;
        }

        .popup .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .popup .form-group {
            margin-bottom: 15px;
        }

        .popup .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .popup .form-group input,
        .popup .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .popup .btn-container {
            text-align: right;
        }

        .popup .btn-container button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .popup .btn-container button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .task-card {
                flex: 1 1 100%;
            }

            .deadline-card {
                grid-column: span 3;
            }
        }

        @media (max-width: 480px) {
            .task-pool {
                grid-template-columns: 1fr;
            }

            .deadlines {
                grid-template-columns: 1fr;
            }

            .stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var originalDashboardContent;

            function startTime() {
                var today = new Date();
                var h = today.getHours();
                var m = today.getMinutes();
                var s = today.getSeconds();
                m = checkTime(m);
                s = checkTime(s);
                document.getElementById("txt").innerHTML = h + ":" + m + ":" + s;
                document.getElementById("date").innerHTML = today.toDateString();
                setTimeout(startTime, 1000);
            }

            function checkTime(i) {
                if (i < 10) {i = "0" + i;}
                return i;
            }

            function loadContent(contentId) {
                let url = '';
                switch(contentId) {
                    case "createEmp":
                        url = 'adminCreateEmployee.php?getTasks=1';
                        break;
                    case "updateEmp":
                        url = 'adminUpdateEmployee.php?getTasks=1';
                        break;
                    case "deleteEmp":
                        url = 'adminDeleteEmployee.php?getTasks=1';
                        break;
                    case "empPool":
                        url = 'adminEmpPool.php?getTasks=1';
                        break;
                    case "createTask":
                        url = 'adminCreateTask.php?getTasks=1';
                        break;
                    case "taskPool":
                        url = 'adminTaskPool.php?getTasks=1';
                        break;
                    case "deleteTask":
                        url = 'adminDeleteTask.php?getTasks=1';
                        break;
                    case "userTaskStatus":
                        url = 'adminUserTaskStatus.php?getTasks=1';
                        break;
                    default:
                        document.getElementById("dynamic-content").innerHTML = originalDashboardContent;
                        setActiveMenuItem(contentId);
                        return;
                }
                
                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(data => {
                        document.getElementById("dynamic-content").innerHTML = data;
                        setActiveMenuItem(contentId);
                    })
                    .catch(error => {
                        console.error('There has been a problem with your fetch operation:', error);
                    });
            }

            function setActiveMenuItem(contentId) {
                var menuItems = document.querySelectorAll(".menu-item");
                menuItems.forEach(function(item) {
                    if (item.id === contentId) {
                        item.classList.add("active");
                    } else {
                        item.classList.remove("active");
                    }
                });
            }

            window.onload = function() {
                startTime();
                originalDashboardContent = document.getElementById("dynamic-content").innerHTML;
                window.loadContent = loadContent; // Ensure loadContent is globally accessible
            };
        });
    </script>
</head>
