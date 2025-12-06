<?php
class Load {
    public function view($nameView, $data = []) {

        if (is_array($data)) {
            extract($data);
        }

        include_once 'views/' . $nameView;
    }
}
