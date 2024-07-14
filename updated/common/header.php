<header class="header">
    <h2>Hello 
<span class="user">

<?php 
    echo $db->getFullName($_SESSION['empId']);
?>
</span>, Welcome back!</h2>
</header>
