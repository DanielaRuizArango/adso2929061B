<?php
class load {
    public function view($nameView, $data = null) {
        include_once 'views/' . $nameView;
    }
}