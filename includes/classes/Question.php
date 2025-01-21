<?php
// includes/classes/Question.php

namespace ProjetPhp\Classes;

use Exception;

class Question {
    public $label;
    public $type;
    public $input;
    public $correct;
    public $points;

    public function __construct($label, $type, $choices = [], $correct = [], $points = 1) {
        $this->label = $label;
        $this->type = $type;
        $this->correct = $correct;
        $this->points = $points;

        switch ($this->type) {
            case 'radio':
                $this->input = new RadioInput($label, $choices);
                break;
            case 'checkbox':
                $this->input = new CheckboxInput($label, $choices);
                break;
            case 'text':
                $this->input = new TextInput($label);
                break;
            case 'textarea':
                $this->input = new TextareaInput($label);
                break;
            default:
                throw new Exception("Unsupported question type: $type");
        }
    }

    public function getPoints() {
        return $this->points;
    }

    public function render() {
        return $this->input->render();
    }
}
