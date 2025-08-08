<?php

session_start();

$url = 'http://'.$_SERVER['HTTP_HOST'].'/';
$public = $url."public/";
$css = $public."css/";
$js = $public."js/";
$imgs = $public."imgs/";

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'petsdb';
