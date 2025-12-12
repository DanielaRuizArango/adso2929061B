<?php

class Controller
{
    public $load;
    public $model;

    public function __construct()
    {
        $this->load = new Load;
        $this->model = new Model; 
    }

    public function handleRequest()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $requestUri = strtok($requestUri, '?');

        if ($requestUri !== '/' && substr($requestUri, -1) === '/') {
            $requestUri = rtrim($requestUri, '/');
        }


        switch (true) {

            case $requestUri === '/' || $requestUri === '/pokemons':
                $this->index();
                break;

            case $requestUri === '/pokemons/create':
                $this->create();
                break;

            case preg_match('/^\/pokemons\/view\/(\d+)$/', $requestUri, $matches) && $requestMethod === 'GET':
                $id = $matches[1];
                $this->view($id);
                break;

            case preg_match('/^\/pokemons\/edit\/(\d+)$/', $requestUri, $matches):
                $id = $matches[1];
                $this->edit($id);
                break;

            case preg_match('/^\/pokemons\/delete\/(\d+)$/', $requestUri, $matches) && $requestMethod === 'POST':
                $id = $matches[1];
                $this->delete($id);
                break;

            default:
                http_response_code(404);
                echo "404 - Página no encontrada";
                break;
        }
    }

    public function index()
    {
        $pokemons = $this->model->listPokemons();
        $this->load->view('welcome.php', ['data' => $pokemons]);
    }

    public function view($id)
    {
        $pokemon = $this->model->viewPokemon($id);
        $this->load->view('view.php', ['pokemon' => $pokemon]);
    }


    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->createPokemon($_POST['name'],$_POST['type'],$_POST['strength'],$_POST['stamina'],$_POST['speed'],$_POST['accuracy'],$_POST['trainer_id']);
            header("Location: /pokemons");
            exit;
        }

        $trainers = $this->model->ListTrainers();
        $this->load->view('create.php', ['trainers' => $trainers]);
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->updatePokemon($id, $_POST['name'], $_POST['type'],$_POST['strength'],$_POST['stamina'],$_POST['speed'],$_POST['accuracy'],$_POST['trainer_id']
            );

            header("Location: /pokemons");
            exit;
        }

        $pokemon = $this->model->viewPokemon($id);
        $trainers = $this->model->ListTrainers();
        $this->load->view('edit.php', ['pokemon' => $pokemon, 'trainers' => $trainers]);
    }

    public function delete($id)
    {
        $this->model->deletePokemon($id);

        header("Location: /pokemons");
        exit;
    }
}