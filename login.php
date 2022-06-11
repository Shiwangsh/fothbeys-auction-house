<?php
include 'app/header.php';
?>

<div class="header">
    <h2>Login</h2>
</div>
<div class="error-show">
</div>
<form method="post" action="functions/login_function.php">
    <div class="input">
        <label>Email</label>
        <input type="text" name="email">
    </div>
    <div class="input">
        <label>Password</label>
        <input type="password" name="password">
    </div>
    <div class="input">
        <button type="submit" class="btn" name="submit">Login</button>
    </div>
    <p>
        Not yet a member? <a href="signup.php">Sign up</a>
    </p>
</form>
<?php
include 'app/footer.php';
