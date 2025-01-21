<?php
require_once __DIR__ . '/../vendor/autoload.php';

use ProjetPhp\Classes\QuizzLoader;
use ProjetPhp\Classes\SessionManager;
use ProjetPhp\Classes\Quizz;

SessionManager::startSession();

$quizzFile = __DIR__ . '/../quizz.json'; 
$quizzData = QuizzLoader::loadQuizzFromFile($quizzFile);

if (!isset($_SESSION['quizz_started'])) {
    SessionManager::resetQuizzSession();
}

$_SESSION['quizz'] = $quizzData['questions'];
$questions = $_SESSION['quizz'];
$quizz = new Quizz($questions);
$quizz->setCurrentQuestionIndex(SessionManager::getCurrentQuestionIndex());
$quizz->setScore(SessionManager::getScore());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $userAnswer = $_POST['answer'] ?? [];
        $quizz->checkAnswer($userAnswer);

        SessionManager::setAnswer($userAnswer);

        if (!$quizz->isQuizzComplete()) {
            SessionManager::incrementCurrentQuestion();
        } else {
            SessionManager::setQuizzComplete($quizz->getTotalQuestions());
            header('Location: result.php');
            exit;
        }
    } elseif (isset($_POST['restart'])) {
        SessionManager::resetQuizzSession();
        header('Location: index.php');
        exit;
    }
}

if ($quizz->isQuizzComplete()) {
    include __DIR__ . '/../includes/templates/header.php';
    include __DIR__ . '/../includes/templates/result.php';
    exit;
}

$currentQuestionIndex = SessionManager::getCurrentQuestionIndex();
$questions = $_SESSION['quizz'] ?? [];

if (isset($questions[$currentQuestionIndex])) {
    $currentQuestion = $questions[$currentQuestionIndex];
} else {
    header('Location: index.php');
    exit;
}

include __DIR__ . '/../includes/templates/header.php';
include __DIR__ . '/../includes/templates/question.php';
?>
