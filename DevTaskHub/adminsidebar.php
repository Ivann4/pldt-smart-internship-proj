<?php include 'adminhead.php'; ?>
<div class="sidebar">
    <div class="logo">
        <img src="./media/PLDT-Smart-logo.png" alt="PLDT Logo" />
    </div>
    <div class="department-name">
        <p>*Dept Name Here*</p>
        <br>
        <div id="txt" class="time"></div>
        <div id="date" class="date"></div>
        <br>
    </div>
    <nav class="menu">
        <a href="#" class="menu-item active" id="dashboard" onclick="loadContent('dashboard'); return false;">
            <img src="./media/home-icon.svg" alt="Dashboard Icon" />
            Dashboard
        </a>
        <a href="#" class="menu-item" id="empPool" onclick="loadContent('empPool'); return false;">
            <img src="./media/create-emp.svg" alt="create Icon" />
            Employee Pool
        </a>
        <a href="#" class="menu-item" id="taskPool" onclick="loadContent('taskPool'); return false;">
            <img src="./media/task-status.svg" alt="task status Icon" />
            Task Pool
        </a>
        <a href="#" class="menu-item" id="userTaskStatus" onclick="loadContent('userTaskStatus'); return false;">
            <img src="./media/task-status.svg" alt="task status Icon" />
            Tasks Status
        </a>
    </nav>
    <div class="logout">
        <a href="index.php" class="logout-btn">Log Out <span class="arrow">»</span></a>
    </div>
</div>
