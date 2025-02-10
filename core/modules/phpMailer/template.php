<?php
$template = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap">
    <style>
        * {
            color: #9e9e9e;
        }
        body {
            margin: 0;
            padding: 15px;
            background-color: #121317;
            font-family: "Montserrat", sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #1a1c23;
            padding: 20px;
            border-radius: 10px;
        }
        .center {
            text-align: center;
        }
        .logo {
            display: block;
            margin: 0 auto;
            height: 150px;
            width: 150px;
        }
        .accent-text {
            color: #7800fe;
        }
        h1 {
            text-align: center;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <a href="https://' . $_SERVER['HTTP_HOST'] . '">
        <img src="https://' . $_SERVER['HTTP_HOST'] . '/static/img/logo.svg" class="logo">
    </a>

    <h1>' . $header . '</h1>
    ' . $message . '
</div>
</body>
</html>
';