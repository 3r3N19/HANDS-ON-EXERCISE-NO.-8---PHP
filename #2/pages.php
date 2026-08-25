<?php include 'header.php'; ?>

<div class="container">

<?php

$page = $_GET['page'] ?? 'register';

if ($page == 'register') {
?>

    <h2>Register</h2>

    <form method="post">
        <label>Full Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" minlength="6" required>

        <button type="submit">Register</button>
    </form>

<?php
} elseif ($page == 'login') {
?>

    <h2>Login</h2>

    <form method="post">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

<?php
} elseif ($page == 'forgot') {
?>

    <h2>Forgot Password</h2>

    <form method="post">
        <label>Email</label>
        <input type="email" name="email" required>

        <button type="submit">Reset Password</button>
    </form>

<?php
}

?>

</div>

</body>
</html>