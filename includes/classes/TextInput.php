<?php
// includes/classes/TextInput.php

namespace ProjetPhp\Classes;

class TextInput extends Input {
    public function render() {
        return '<input type="text" name="answer" required class="option">';
    }
    
}
