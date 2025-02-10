<?php
if($_POST['new_password'] && $_POST['old_password'] && $_POST['repeat_password']) {
    if($_POST['new_password'] == $_POST['repeat_password']) {
        $usr = User::Me();
        if(Utils::Crypt($_POST['old_password']) == $usr->password){
            $usr->password = Utils::Crypt($_POST['new_password']);
            R::store($usr);
            die(json_encode(["success" => true, "message" => 'Password changed successfully.']));
        }
        else
            die(json_encode(["success" => false, "message" => 'Current password is entered incorrectly.']));
    }
    die(json_encode(["success" => false, "message" => 'Password mismatch.']));
}
else
    die(json_encode(["success" => false, "message" => 'Data validation error.']));
