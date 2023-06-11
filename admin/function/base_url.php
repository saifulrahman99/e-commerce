<?php
function base_url($file = NULL)
{
    // online
    $path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/admin"."/";
    // offline
    // $path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/e-commerce" . "/admin"."/";

    $path .= $file;
    return $path;
}