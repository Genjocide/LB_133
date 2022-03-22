<?php
require_once ('inc/DbManagement.php');
$db = new DbManagement();

$pattern = '/^.{8,}$/';
    if(preg_match($pattern, $password)){
        echo "Password strength is OK";
        } else {
        echo "Password is not strong enough";
        }
    if (isset($_POST['save'])){
        if($_POST['new-pw'] == $_POST['new-pw-repeat']){
            $db->update_password($_POST['new-pw']);
        }
    }

echo '
<div class="col-md-6">
<form method="post">
    <div class="container" id="form-container">
        <div class="row">
            <div class="col-md-2">
                <label for="new-pw">Neues Passwort: </label>
            </div>
            <div class="col-md-8">
                <input type="text" name="new-pw">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="new-pw-repeat">Neues Passwort wiederholen: </label>
            </div>
            <div class="col-md-10">
                <input type="text" name="new-pw-repeat">
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <input type="submit" name="save" class="btn btn-dark" value="Speichern">
            </div>
        </div>
    </div>
</form>
</div>
';