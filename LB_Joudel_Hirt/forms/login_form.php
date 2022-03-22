<?php

$name = '';
$error = '';

if (isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    if (isset($_SESSION['name'])){
        $name = $_SESSION['name'];
    }
}

if (isset($_POST['login']))
{
    $db->user_authent($_POST['name'], $_POST['password']);
    header("Refresh:0;");
}
else{

echo '
<div class="row">
    <div class="col-md-12">
        <form method="post">
            <div class="container" id="form-container">
                <div class="row"><h2>Login</h2></div>
                <div class="row">
                    <div class="col-md-3"><label for="name">Name/Email:</label></div>
                    <div class="col-md-9"><input type="text" name="name" id="name" value="' . $name . '"></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><label for="firstname">Passwort:</label></div>
                    <div class="col-md-9"><input type="password" name="password" id="password">
                    <p class="error">' . $error . '</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12"><input type="submit" class="btn btn-dark" value="Login" name="login"></div>
                </div>
            </div>
        </form>
    </div>
</div>';
}
