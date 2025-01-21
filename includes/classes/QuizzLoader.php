<?php
// includes/classes/QuizzLoader.php

namespace ProjetPhp\Classes;
    
use ProjetPhp\Classes\Question;
use Exception;

class QuizzLoader {
    public static function loadQuizzFromFile($filePath) {
        if (!file_exists($filePath)) {
            throw new Exception("Le fichier n'a pas été trouvé: " . $filePath);
        }

        $jsonContent = file_get_contents($filePath);
        $quizzData = json_decode($jsonContent, true);

        if (!isset($quizzData['quizz']) || !isset($quizzData['questions'])) {
            throw new Exception("Mauvais format de fichier.");
        }

        $questions = [];
        foreach ($quizzData['questions'] as $questionData) {
            $questions[] = new Question(
                $questionData['label'],
                $questionData['type'],
                $questionData['choices'] ?? [],
                $questionData['correct'],
                $questionData['points'] ?? 1
            );
        }

        return [
            'title' => $quizzData['quizz'],
            'questions' => $questions
        ];
    }
}
