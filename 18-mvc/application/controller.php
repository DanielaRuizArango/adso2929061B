<?php
class Controller {
    public $load;
    public $model;

    public function __construct()
    {
        $this->load = new Load;
        $this->model = new Model;

        $this->load->view('welcome.php');
    }

}