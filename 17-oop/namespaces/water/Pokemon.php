<?php

namespace water;

class Pokemon {
    private $name;
    private $color;

    public function __construct($n, $c)
    {
        $this->name = $n;
        $this->color = $n;
    }

    public function getInfoPokemon(){
        return "<li>".$this->name." | ".$this->color."</li>";
    }
}