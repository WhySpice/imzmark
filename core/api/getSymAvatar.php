<?php
if($name)
{
    $filename = "static/img/cache/" . md5($name) . ".svg";

    if(file_exists($filename))
    {
        $svg = file_get_contents($filename);
    }
    else
    {
        $url = "https://ui-avatars.com/api/?name=" . urldecode($name) . "&format=svg";
        $svg = file_get_contents($url);

        if($svg)
        {
            file_put_contents($filename, $svg);
        }
    }

    if($svg)
    {
        header("Content-Type: image/svg+xml");
        echo $svg;
    }
    else
    {
        echo "/static/img/no-avatar.png";
    }
}


