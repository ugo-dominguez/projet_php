<?php

namespace App\Providers;

class QuestionProvider {
    /**
     * Charge les quizzes depuis un fichier JSON.
     *
     * @param string $filePath Chemin vers le fichier JSON
     * @return array Tableau de quizzes
     * @throws \Exception Si le fichier ne peut pas être lu ou décodé
     */
    public static function getQuizzes(string $filePath): array {
        if (!file_exists($filePath)) {
            throw new \Exception("Fichier JSON non trouvé : $filePath");
        }

        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);

        if ($data === null) {
            throw new \Exception("Erreur lors du décodage JSON : " . json_last_error_msg());
        }

        // Valider les données JSON pour s'assurer qu'elles respectent la structure
        if (!self::validateQuizzes($data)) {
            throw new \Exception("Le fichier JSON contient des données invalides.");
        }

        return $data;
    }

    /**
     * Valide la structure des quizzes.
     *
     * @param array $quizzes Tableau de quizzes
     * @return bool Retourne vrai si la structure est valide
     */
    private static function validateQuizzes(array $quizzes): bool {
        foreach ($quizzes as $quiz) {
            if (!isset($quiz['title'], $quiz['questions']) || !is_array($quiz['questions'])) {
                return false;
            }

            foreach ($quiz['questions'] as $question) {
                if (!isset($question['label'], $question['points'], $question['type'], $question['correct'])) {
                    return false;
                }

                if (!in_array($question['type'], ['radioButton', 'text', 'checkBox'])) {
                    return false;
                }
            }
        }

        return true;
    }
}
