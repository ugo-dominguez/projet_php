<!-- includes/templates/question.php -->

<div class="question-container">
    <h3>Question <?php echo $_SESSION['current_question'] + 1;?>:</h3>
    <p><?php echo $currentQuestion->label;?></p>
    
    <form method="post">
        <div class="options">
            <?php echo $currentQuestion->render();?>
        </div>
        <button type="submit" name="submit">Prochaine question</button>
    </form>
</div>
