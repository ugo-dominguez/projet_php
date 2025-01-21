<?php
// includes/classes/Input.php

namespace ProjetPhp\Classes;

abstract class Input {
    protected $label;
    protected $choices;

    public function __construct($label, $choices = []) {
        $this->label = $label;
        $this->choices = $choices;
    }

    abstract public function render();
}
