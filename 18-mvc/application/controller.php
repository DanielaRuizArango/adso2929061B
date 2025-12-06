<?php

class Controller
{
    public $load;
    public $model;

    public function __construct()
    {
        $this->load = new Load;
        $this->model = new Model; // tu modelo Pokemon
    }

    // LISTAR
    public function index()
    {
        $pokemons = $this->model->listPokemons();
        $this->load->view('welcome.php', ['data' => $pokemons]);
    }

    // VER UNO
    public function view($id)
    {
        $pokemon = $this->model->viewPokemon($id);
        $this->load->view('view.php', ['pokemon' => $pokemon]);
    }

    // CREAR
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->createPokemon(
                $_POST['name'],
                $_POST['type'],
                $_POST['strength'],
                $_POST['stamina'],
                $_POST['speed'],
                $_POST['acurracy'],
                $_POST['trainer_id']
            );

            header("Location: /pokemons");
            exit;
        }

        $this->load->view('create.php');
    }

    // EDITAR
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->updatePokemon(
                $id, 
                $_POST['name'], 
                $_POST['type'],
                $_POST['strength'],
                $_POST['stamina'],
                $_POST['speed'],
                $_POST['acurracy'],
                $_POST['trainer_id']
            );

            header("Location: /pokemons");
            exit;
        }

        $pokemon = $this->model->viewPokemon($id);
        $this->load->view('edit.php', ['pokemon' => $pokemon]);
    }

    // ELIMINAR
    public function delete($id)
    {
        $this->model->deletePokemon($id);

        header("Location: /pokemons");
        exit;
    }
}
