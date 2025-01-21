<?php
// includes/classes/RadioInput.php

namespace ProjetPhp\Classes;

class RadioInput extends Input {
    public function render() {
        $html = '';
        foreach ($this->choices as $choice) {
            $html .= '<label class="option">';
            $html .= '<input type="radio" name="answer" value="' . htmlspecialchars($choice) . '" required>';
            $html .= htmlspecialchars($choice);
            $html .= '</label>';
        }
        return $html;
    }
    
}

