<?php
// includes/classes/SessionManager.php

namespace ProjetPhp\Classes;

class SessionManager {
    public static function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function resetQuizzSession() {
        $_SESSION['quizz_started'] = true;
        $_SESSION['current_question'] = 0;
        $_SESSION['answers'] = [];
        $_SESSION['score'] = 0;
    }

    public static function incrementCurrentQuestion() {
        $_SESSION['current_question']++;
    }

    public static function setAnswer($answer) {
        $_SESSION['answers'][$_SESSION['current_question']] = $answer;
    }

    public static function setScore($points) {
        $_SESSION['score'] = $points;
    }
    
    public static function getScore() {
        return $_SESSION['score']; 
    }

    public static function getAnswers() {
        return $_SESSION['answers'];
    }

    public static function getCurrentQuestionIndex() {
        return $_SESSION['current_question'];
    }

    public static function isQuizzComplete($totalQuestions) {
        return $_SESSION['current_question'] >= $totalQuestions;
    }

    public static function setQuizzComplete($totalQuestions) {
        $_SESSION['current_question'] = $totalQuestions;
    }
}
