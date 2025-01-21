<!-- includes/templates/result.php -->

<div class="result">
    <h2>Le Quizz est terminé !</h2>
    <p>Votre score : <?php echo $_SESSION['score'];?>/<?php echo $quizz->getTotalPoints();?></p>
    <form method="post">
        <button type="submit" name="restart">Relancer le Quizz</button>
    </form>
</div>
