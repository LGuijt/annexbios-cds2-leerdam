<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // If not authenticated, redirect to the login page
    header("Location: login");
    exit();
}
?>

<?php include 'core/header.php'; ?>



<?php include 'core/footer.php'; ?>
