<header class="header">
    <h2>Hello <span class="user"><?php echo isset($user) ? htmlspecialchars($user->user['name']) : 'Guest'; ?></span>, Welcome back!</h2>
</header>
