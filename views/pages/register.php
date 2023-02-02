<?php

use App\Services\Page;

?>

<!doctype html>
<html lang="en">
<?php
Page::part("head");
?>
<body>
<?php
Page::part("navbar")
?>
<div class="container">
    <form class="mt-5" action="/auth/register" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <h3 class="mt-4">Sign Up</h3>
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email"
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username"
        </div>
        <div class="mb-3">
            <label for="avatar" class="form-label">Full Name</label>
            <input type="file" name="avatar" class="form-control" id="avatar"
        </div>
        <div class="mb-3">
            <label for="full_name" class="form-label">User Pic.</label>
            <input type="text" name="full_name" class="form-control" id="full_name"
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <div class="mb-3">
            <label for="password_confirm" class="form-label">Password Conformation</label>
            <input type="password" name="password_confirm" class="form-control" id="password_confirm">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>