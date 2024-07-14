
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
<?php include 'adminhead.php'; ?>
<div class="sidebar">
    <div class="logo">
        <img src="/assets/PLDT-Smart-logo.png" alt="PLDT Logo" />
    </div>
    <div class="department-name">
        <?php echo "<p>".$_SESSION['department']."</p>" ?>
        <br>
        <div id="txt" class="time"></div>
        <div id="date" class="date"></div>
        <br>
    </div>
    <nav class="menu">
        <a href="#" class="menu-item active" id="dashboard" onclick="loadContent('dashboard'); return false;">
            <img src="/assets/home-icon.svg" alt="Dashboard Icon" />
            Dashboard
        </a>
        <a href="#" class="menu-item" id="empPool" onclick="loadContent('empPool'); return false;">
            <img src="/assets/create-emp.svg" alt="create Icon" />
            Employee Pool
        </a>
        <a href="#" class="menu-item" id="taskPool" onclick="loadContent('taskPool'); return false;">
            <img src="/assets/task-status.svg" alt="task status Icon" />
            Task Pool
        </a>
        <a href="#" class="menu-item" id="userTaskStatus" onclick="loadContent('userTaskStatus'); return false;">
            <img src="/assets/task-status.svg" alt="task status Icon" />
            Tasks Status
        </a>
    </nav>
    <div class="logout">
        <a href="#" class="logout-btn">Log Out <span class="arrow">»</span></a>
    </div>
</div>

<script>
// on-click event for logout button
document.querySelector('.logout-btn').addEventListener('click', () => {
    fetch('/auth/auth.php?authType=logout');
    window.location.href = '/auth/login.php';
});
</script>

