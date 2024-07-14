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
        <a href="#" class="menu-item" id="tasks" onclick="loadContent('tasks'); return false;">
            <img src="/assets/tasks-icon.svg" alt="My Tasks Icon" />
            My Tasks 
        </a>
        <a href="#" class="menu-item" id="team" onclick="loadContent('team'); return false;">
            <img src="/assets/team-icon.svg" alt="My Team Icon" />
            My Team
        </a>
        <a href="#" class="menu-item" id="settings" onclick="loadContent('settings'); return false;">
            <img src="/assets/settings-icon.svg" alt="Settings Icon" />
            Profile
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
