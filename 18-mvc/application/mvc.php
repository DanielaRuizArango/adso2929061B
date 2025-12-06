<?php
    require 'database.php';
    require 'model.php';
    require 'load.php';
    require 'controller.php';

    $controller = new Controller();
    $controller->handleRequest();
