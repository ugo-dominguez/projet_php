<?php
// includes/classes/TextareaInput.php

namespace ProjetPhp\Classes;

class TextareaInput extends Input {
    public function render() {
        return '<textarea name="answer" required class="option" rows="4" cols="50"></textarea>';
    }
}
