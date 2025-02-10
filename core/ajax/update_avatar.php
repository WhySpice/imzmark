<?php
$maxFileSize = 1024 * 1024;
$uploadDir = 'static/uploads/';

if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['avatar']['tmp_name'];
    $avatarName = Utils::GenerateString(32) . ".jpg";
    $avatarPath = $uploadDir . $avatarName;
    $avatarFileType = strtolower(pathinfo($avatarPath, PATHINFO_EXTENSION));

    if ($avatarFileType != 'png' && $avatarFileType != 'jpg' && $avatarFileType != 'jpeg') {
        echo json_encode(["success" => false, "message" => "You can only upload PNG and JPG files."]);
        exit;
    }

    if ($_FILES['avatar']['size'] > $maxFileSize) {
        echo json_encode(["success" => false, "message" => "The maximum file size must be 1 MB."]);
        exit;
    }

    if ($avatarFileType == 'png') {
        if (@imagecreatefrompng($tmpName) === false) {
            echo json_encode(["success" => false, "message" => "Invalid PNG file (possibly an animated PNG)."]);
            exit;
        }
    }
    if (move_uploaded_file($tmpName, $avatarPath)) {
        echo json_encode(["success" => true, "img" => "/{$avatarPath}", 'message' => "Avatar has been successfully updated."]);
        $me = User::Me();
        $me->avatar = '/' . $avatarPath;
        R::store($me);
        Logger::AddFromPanel('account');
    }
    else
        echo json_encode(["success" => false, "message" => 'Error saving file.']);
}
else
    echo json_encode(["success" => false, "message" => 'Error saving file.']);

