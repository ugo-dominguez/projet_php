<?php

// Autoloader pour charger automatiquement les classes
require_once 'src/Utils/Autoloader.php';
use App\Controllers\QuizController;

Autoloader::register();

// Contrôleur de quiz
$controller = new QuizController();

// Récupérer l'action passée en GET et la traiter
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'start':
            $controller->startQuiz();
            break;
        case 'submit':
            $controller->submitAnswers();
            break;
        case 'results':
            $controller->showResults();
            break;
        default:
            echo "Action inconnue";
            break;
    }
} else {
    // Par défaut, afficher le quiz
    $controller->startQuiz();
}
