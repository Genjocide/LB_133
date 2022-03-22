<?php

$name = '';
$first_name = '';
$zip = 0;
$password = '';

$user = $db->select_user($_SESSION['user_id']);

$name = $user['name'];
$first_name = $user['firstname'];
$email = $user['email'];
if ($user['user_type']){
    $user_type = 'checked';
}
else{
    $user_type = '';
}
$pattern = '/^.{8,}$/';
if(preg_match($pattern, $password)){
   echo "Password strength is OK";
} else {
   echo "Password is not strong enough";
}


$selected = '';

if (isset($_POST['update_user'])){
    $id = $_SESSION['user_id'];
    if (isset($_POST['admin_rights'])){
        $user_type = true;
    }
    else{
        $user_type = false;
    }
    $db->update_user($id,$_POST['name'],$_POST['firstname'], $_POST['email'],$_POST['change_password'],$_POST['password'],$user_type);
    $_SESSION['update_user'] = false;
    $_SESSION['show_users'] = true;
    header("Refresh:0;");
}


echo '
<form method="post">
    <div class="container" id="form-container">
        <div class="row"><h2>Mitarbeiter</h2></div>
        <div class="row">
            <div class="col-md-3"><label for="name">Name:</label></div>
            <div class="col-md-9"><input type="text" name="name" id="name" value="'. $name .'"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><label for="firstname">Vorname:</label></div>
            <div class="col-md-9"><input type="text" name="firstname" id="firstname" value="'. $first_name .'"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><label for="email">E-mail:</label></div>
            <div class="col-md-9"><input type="email" name="email" id="email" value="'. $email .'"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><label for="password">Passwort ändern ?</label></div>
            <div class="col-md-9"><input type="checkbox" name="change_password"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><label for="password">Passwort:</label></div>
            <div class="col-md-9"><input type="password" name="password" id="password"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><label for="password">Passwort wiederholen:</label></div>
            <div class="col-md-9"><input type="password" name="repeat_password" id="repeat_password"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><label for="admin_rights">Adminrechte:</label></div>
            <div class="col-md-9"><input type="checkbox" name="admin_rights" id="admin_rights" '. $user_type .'></div>
        </div>
        <div class="row">
            <div class="col-md-12"><input type="submit" class="btn btn-dark" value="Mitarbeiter erfassen" name="update_user"></div>
        </div>
    </div>
</form>';