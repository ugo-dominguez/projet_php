<?php
// includes/classes/Quiz.php

namespace ProjetPhp\Classes;

class Quizz {
    private $questions;
    private $currentQuestionIndex;
    private $score;
    private $answers;

    public function __construct($questions) {
        $this->questions = $questions;
        $this->currentQuestionIndex = 0;
        $this->score = 0;
        $this->answers = [];
    }

    public function getCurrentQuestion() {
        return $this->questions[$this->currentQuestionIndex];
    }

    public function getNextQuestion() {
        $this->currentQuestionIndex++;
    }

    public function checkAnswer($userAnswer) {
        $currentQuestion = $this->questions[$this->currentQuestionIndex];
        $correctAnswer = $currentQuestion->correct;
    
        if (is_array($correctAnswer)) {
            $correctCount = count(array_intersect($correctAnswer, (array)$userAnswer));
            $wrongCount = count((array)$userAnswer) - $correctCount;
    
            if ($correctCount > 0 && $wrongCount === 0) {
                $this->score += $currentQuestion->points;
            }
        } else {
            if ((string)$userAnswer === (string)$correctAnswer) {
                $this->score += $currentQuestion->points;
            }
        }
        SessionManager::setScore($this->score);
    }
    
    public function getScore() {
        return $this->score;
    }

    public function getTotalQuestions() {
        return count($this->questions);
    }

    public function getTotalPoints() {
        $res = 0;
        foreach ($this->questions as $q) {
            $res += $q->getPoints(); 
        }
        return $res;
    }
    
    public function setCurrentQuestionIndex($current) {
        $this->currentQuestionIndex = $current;
    }

    public function setScore($points) {
        $this->score = $points;
    }

    public function isQuizzComplete() {
        return $this->currentQuestionIndex >= $this->getTotalQuestions();
    }
}
