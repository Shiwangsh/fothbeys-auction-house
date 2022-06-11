<?php
include 'app/header.php';
?>


<div class="header">
    <h2>Register</h2>
</div>

<form method="post" action="functions/signup_function.php">
    <div class="input">
        <label>Firstname</label>
        <input type="text" name="firstname">
    </div>
    <div class="input">
        <label>Lastname</label>
        <input type="text" name="lastname">
    </div>
    <div class="input">
        <label>Email</label>
        <input type="email" name="email">
    </div>
    <div class="input">
        <label>Password</label>
        <input type="password" name="password">
    </div>
    <div class="input">
        <label>Contact number </label>
        <input type="text" name="contact">
    </div>
    <div class="input">
        <label>Address</label>
        <input type="text" name="address">
    </div>
    <div class="input">
        <label>User Type</label>
        <select class="input-category" name="category">
            <option value="buyer">Buyer</option>
            <option value="seller">Seller</option>
        </select>
    </div>
    <div class="input">
        <button type="submit" class="btn" name="submit">Register</button>
    </div>
    <p>
        Already a member? <a href="login.php">Sign in</a>
    </p>
</form>
<?php
include 'app/footer.php';
