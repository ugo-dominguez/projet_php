<?php
// Assurez-vous que la variable $quiz est définie avant d'afficher la vue
if (!isset($quiz)) {
    echo "Aucun quiz disponible.";
    exit;
}
?>

<h1><?= htmlspecialchars($quiz['title']) ?></h1>

<!-- Formulaire pour soumettre les réponses -->
<form method="POST" action="index.php?action=submit">

    <?php foreach ($quiz['questions'] as $index => $question): ?>
        <div class="question">
            <p><strong><?= htmlspecialchars($question['label']) ?></strong> (<?= $question['points'] ?> points)</p>

            <?php if ($question['type'] === 'radioButton'): ?>
                <!-- Question de type radioButton -->
                <div class="options">
                    <?php foreach ($question['options'] as $option): ?>
                        <label>
                            <input type="radio" name="answers[<?= $index ?>]" value="<?= htmlspecialchars($option) ?>">
                            <?= htmlspecialchars($option) ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>

            <?php elseif ($question['type'] === 'checkBox'): ?>
                <!-- Question de type checkBox -->
                <div class="options">
                    <?php foreach ($question['options'] as $option): ?>
                        <label>
                            <input type="checkbox" name="answers[<?= $index ?>][]" value="<?= htmlspecialchars($option) ?>">
                            <?= htmlspecialchars($option) ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>

            <?php elseif ($question['type'] === 'text'): ?>
                <!-- Question de type text -->
                <div class="options">
                    <input type="text" name="answers[<?= $index ?>]" placeholder="Votre réponse">
                </div>
            <?php endif; ?>
        </div>
        <hr>
    <?php endforeach; ?>

    <!-- Bouton pour soumettre les réponses -->
    <button type="submit">Soumettre</button>

</form>
