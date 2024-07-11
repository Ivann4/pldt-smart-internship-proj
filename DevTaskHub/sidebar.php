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
        <a href="#" class="menu-item" id="tasks" onclick="loadContent('tasks'); return false;">
            <img src="./media/tasks-icon.svg" alt="My Tasks Icon" />
            My Tasks 
        </a>
        <a href="#" class="menu-item" id="team" onclick="loadContent('team'); return false;">
            <img src="./media/team-icon.svg" alt="My Team Icon" />
            My Team
        </a>
        <a href="#" class="menu-item" id="settings" onclick="loadContent('settings'); return false;">
            <img src="./media/settings-icon.svg" alt="Settings Icon" />
            Profile
        </a>
    </nav>
    <div class="logout">
        <a href="index.php" class="logout-btn">Log Out <span class="arrow">»</span></a>
    </div>
</div>
