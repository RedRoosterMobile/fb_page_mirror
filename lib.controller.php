<?php
function current_page() {
    return isset($_GET['page']) ? $_GET['page'] : 'home';
}
?>