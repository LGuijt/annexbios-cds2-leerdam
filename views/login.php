<?php
session_start();

$correctPasscode = 'appelsap';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredPasscode = $_POST['password'];

    if ($enteredPasscode === $correctPasscode) {
        $_SESSION['authenticated'] = true;

        header("Location: admin");
        exit();
    } else {
        $errorMessage = "Incorrect passcode. Please try again.";
    }
}
?>


<?php include 'core/header.php'; ?>

<div class="parentContainer" style="margin-top: 30vh;">

    <form id="loginForm" method="POST" action="login">
        <input type="password" id="password" name="password" placeholder="vul het wachtwoord in">
        <button type="submit">Log in</button>
    </form>
    <?php if (isset($errorMessage)): ?>
        <p style="color: red; text-align: center;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
</div>

<?php include 'core/footer.php'; ?>