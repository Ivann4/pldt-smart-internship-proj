<?php
class empDashboard {
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function render() {
        include 'head.php';
        echo '<body>';
        echo '<div class="dashboard">';
        include 'sidebar.php';
        include 'main.php';
        include 'right-sidebar.php';
        echo '</div>';
        include 'footer.php';
    }
}

$user = array(
    'name' => 'ivannavi_',
);

$dashboard = new empDashboard($user);
$dashboard->render();
?>