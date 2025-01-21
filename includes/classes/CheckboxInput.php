<?php
// includes/classes/CheckboxInput.php

namespace ProjetPhp\Classes;

class CheckboxInput extends Input {
    public function render() {
        $html = '';
        foreach ($this->choices as $choice) {
            $html .= '<label class="option">';
            $html .= '<input type="checkbox" name="answer[]" value="' . htmlspecialchars($choice) . '">';
            $html .= htmlspecialchars($choice);
            $html .= '</label>';
        }
        return $html;
    }
    
}
