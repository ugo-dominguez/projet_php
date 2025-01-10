<?php

namespace App\Controllers;

use App\Providers\QuestionProvider;

class QuizController {

    // Démarre le quiz
    public function startQuiz() {
        try {
            // Charger les quizzes via le provider
            $quizzes = QuestionProvider::getQuizzes('data/quizzes.json');
            
            // Choisir le premier quiz pour cet exemple
            $quiz = $quizzes[0]; 

            // Passer les données du quiz à la vue
            include 'views/quiz.php';
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Soumettre les réponses et calculer le score
    public function submitAnswers() {
        session_start(); // Démarrer la session pour stocker le score
        if (!isset($_POST['answers'])) {
            // Si aucune réponse n'est soumise, rediriger vers le quiz
            header('Location: index.php?action=start');
            exit;
        }

        $userAnswers = $_POST['answers']; // Récupérer les réponses soumises par l'utilisateur
        $quizzes = QuestionProvider::getQuizzes('data/quizzes.json');
        $quiz = $quizzes[0]; // Utiliser le premier quiz

        $score = 0;

        // Parcourir toutes les questions et vérifier les réponses
        foreach ($quiz['questions'] as $index => $question) {
            $correctAnswers = $question['correct'];

            // Vérifier la réponse selon le type de question
            if ($question['type'] === 'radioButton' || $question['type'] === 'text') {
                if (isset($userAnswers[$index]) && $userAnswers[$index] === $correctAnswers[0]) {
                    $score += $question['points'];
                }
            } elseif ($question['type'] === 'checkBox') {
                // Pour les questions de type checkbox, vérifier si toutes les réponses correctes sont sélectionnées
                if (isset($userAnswers[$index]) && !array_diff($correctAnswers, $userAnswers[$index])) {
                    $score += $question['points'];
                }
            }
        }

        // Stocker le score dans la session
        $_SESSION['score'] = $score;

        // Rediriger vers la page des résultats
        header('Location: index.php?action=results');
        exit;
    }

    // Afficher les résultats
    public function showResults() {
        session_start();
        if (!isset($_SESSION['score'])) {
            echo "Aucun score disponible. Veuillez d'abord passer le quiz.";
            return;
        }

        // Afficher le score
        $score = $_SESSION['score'];
        echo "<h1>Votre score est : $score</h1>";

        // Optionnel : Enregistrer le score dans la base de données SQLite
        if (isset($_SESSION['username'])) {
            $this->saveScoreToDatabase($_SESSION['username'], $score);
        }

        // Fournir un lien pour recommencer le quiz
        echo '<a href="index.php?action=start">Recommencer</a>';
    }

    // Enregistrer le score dans la base de données SQLite
    private function saveScoreToDatabase($username, $score) {
        try {
            $pdo = new \PDO('sqlite:database/scores.sqlite');
            $stmt = $pdo->prepare("INSERT INTO scores (name, score) VALUES (:name, :score)");
            $stmt->bindParam(':name', $username);
            $stmt->bindParam(':score', $score);
            $stmt->execute();
        } catch (\PDOException $e) {
            echo "Erreur de base de données : " . $e->getMessage();
        }
    }
}
