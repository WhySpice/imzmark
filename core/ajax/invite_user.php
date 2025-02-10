<?php
if($_POST['email'] && $_POST['privilege'])
{
    if(User::isAdmin())
    {
        if(!R::findOne('users', 'email = ?', [$_POST['email']]))
        {
            $ui = R::dispense('userinvites');
            $ui->invite_code = Utils::GenerateString(12);
            $ui->expires = 0;
            $ui->inviter_id = User::Me()->id;
            $ui->group = $_POST['privilege'];
            R::store($ui);

            $extra = [
                "email" => $_POST['email'],
                "role" => $_POST['privilege']
            ];
            Logger::AddFromPanel('invite', $extra);

            $mail = new Mailer;
            $admin = User::Me();
            $domain = Utils::getDomain();
            $out =  $mail->send("Invitation to join", "Hi, friend!", "
                <p class='center'>The administrator {$admin['username']} has sent you an invitation to join our project. To continue registration, please go to the following link:</p>
                <p class='center'><a class='accent-text' href='https://{$domain}/account/register/{$ui->invite_code}'>Register Link</a></p>
            ", $_POST['email']);

            echo json_encode(["success" => true, "message" => "User has been successfully invited!"]);
        }
        else
            echo json_encode(["success" => false, "message" => "User with this email already exists."]);
    }
    else
        echo json_encode(["success" => false, "message" => "You have no rights."]);
}
else
    echo json_encode(["success" => false, "message" => "You have not filled in the fields."]);