<?php
if(User::CheckAuth())
{
    $domain = Utils::getDomain();
    $me = User::Me();
    $token = User::generateEmailActivationURL();
    $mail = new Mailer;
    $out =  $mail->send("Mail confirmation", "Welcome, {$me['username']}!", "
    <p class='center'>To continue working on the site, you need to confirm your email!</p>
    <p class='center'><a class='accent-text' href='https://{$domain}/account/activate/{$token}'>Email confirmation link</a></p>
    ", $me['email']);

    if($out)
        echo json_encode(["success" => true, "message" => "Confirmation E-Mail has been sent."]);
    else
        echo json_encode(["success" => false, "message" => "Confirmation E-Mail was not sent.\n{$out}"]);

}
else
    echo json_encode(["success" => false, "message" => 'unknown error']);