<?php
    require 'database.php';
    require 'model.php';
    require 'load.php';
    require 'controller.php';

    // Obtener la URL solicitada
    $url = $_SERVER['REQUEST_URI'];
    
    // Remover query string si existe
    $url = strtok($url, '?');
    
    // Remover el slash inicial y final
    $url = trim($url, '/');
    
    // Dividir la URL en segmentos
    $segments = explode('/', $url);
    
    // Crear instancia del controlador
    $controller = new Controller;
    
    // Verificar si hay una ruta específica
    if (!empty($segments[0]) && $segments[0] === 'pokemons') {
        // Si solo es /pokemons, mostrar el índice
        if (count($segments) === 1 || empty($segments[1])) {
            $controller->index();
        } 
        // Si es /pokemons/create
        elseif ($segments[1] === 'create') {
            $controller->create();
        }
        // Si es /pokemons/view/{id}
        elseif ($segments[1] === 'view' && isset($segments[2])) {
            $controller->view($segments[2]);
        }
        // Si es /pokemons/edit/{id}
        elseif ($segments[1] === 'edit' && isset($segments[2])) {
            $controller->edit($segments[2]);
        }
        // Si es /pokemons/delete/{id}
        elseif ($segments[1] === 'delete' && isset($segments[2])) {
            $controller->delete($segments[2]);
        }
        else {
            $controller->index();
        }
    } else {
        // Por defecto, mostrar el índice
        $controller->index();
    }
    
