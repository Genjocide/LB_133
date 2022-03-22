<?php

require_once ('inc/DbManagement.php');
$db = new DbManagement();

$errors = [0 => '', 1 => '', 2 => '', 3 => '', 4 => ''];
$sticky_values = [0 => '', 1 => '', 2 => '', 3 => '', 4 => ''];
$password = '';

if (isset($_POST['add_user'])) {
    if (empty($_POST['name'])){
        $errors[0] = '<p class="error">Feld erforderlich</p>';
    }
    else{
        $sticky_values[0] = $_POST['name'];
    }
    if (empty($_POST['firstname'])){
        $errors[1] = '<p class="error">Feld erforderlich</p>';
    }
    else{
        $sticky_values[1] = $_POST['firstname'];
    }
    if (empty($_POST['email'])){
        $errors[2] = '<p class="error">Feld erforderlich</p>';
    }
    else{
        $sticky_values[2] = $_POST['email'];
    }
    if (empty($_POST['password'])){
        $errors[3] = '<p class="error">Feld erforderlich</p>';
    }
    else{
        $sticky_values[3] = $_POST['password'];
    }
    if (($_POST['password']) != $_POST['password-repeat']){
        $errors[4] = '<p class="error">Passwort stimmt nicht überein</p>';
        $sticky_values[3] = '';
    }
    if(isset($_POST['admin_rights'])){
        $sticky_values[4] = 'checked';
    }
    if ($errors[0] == '' and $errors[1] == '' and $errors[2] == '' and $errors[3] == '' and $errors[4] == ''){
        $db->insert_into_user($_POST['name'], $_POST['firstname'], $_POST['email'], $_POST['password']);
        $sticky_values = [0 => '', 1 => '', 2 => '', 3 => '', 4 => ''];
    }
    $pattern = '/^.{8,}$/';
    if(preg_match($pattern, $password)){
       echo "Password strength is OK";
    } else {
       echo "Password is not strong enough";
    }
}

echo '
<form method="post">
    <div class="container" id="form-container">
        <div class="row"><h2>Mitarbeiter</h2></div>
        <div class="row">
            <div class="col-md-4"><label for="name">Name:</label></div>
            <div class="col-md-8"><input type="text" name="name" id="name" value="'. $sticky_values[0] .'">'. $errors[0] .'</div>
        </div>
        <div class="row">
            <div class="col-md-4"><label for="firstname">Vorname:</label></div>
            <div class="col-md-8"><input type="text" name="firstname" id="firstname" value="'. $sticky_values[1] .'">'. $errors[1] .'</div>
        </div>
        <div class="row">
            <div class="col-md-4"><label for="email">E-mail:</label></div>
            <div class="col-md-8"><input type="email" name="email" id="email" value="'. $sticky_values[2] .'">'. $errors[2] .'</div>
        </div>
        <div class="row">
            <div class="col-md-4"><label for="password">Passwort:</label></div>
            <div class="col-md-8"><input type="password" name="password" id="password" value="'. $sticky_values[3] .'">'. $errors[3] .'</div>
        </div>
        <div class="row">
            <div class="col-md-4"><label for="password-repeat">Passwort Wiederholen:</label></div>
        <div class="col-md-8"><input type="password" name="password-repeat" id="password-repeat" value="'. $sticky_values[3] .'">'. $errors[4] .'</div>
        </div>
        <div class="row">
            <div class="col-md-4"><label for="admin_rights">Adminrechte:</label></div>
            <div class="col-md-8"><input type="checkbox" name="admin_rights" id="admin_rights" '. $sticky_values[4] .'></div>
        </div>
        <div class="row">
            <div class="col-md-12"><input type="submit" class="btn btn-dark" value="Mitarbeiter erfassen" name="add_user"></div>
        </div>
    </div>
</form>';
