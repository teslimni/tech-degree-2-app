<?php include 'inc/test.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Math Quiz: Addition</title>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <div>
            <?php
            //Toast correct and incorrect answers
                if ($questionNum > 1 ) { 
                    displayToast($trackedAnswer, $correctAnswer); 
                }
            ?>
        </div>
        <?php if($questionNum <= $totalQ) : ?>
        <div id="quiz-box">
            <p class="breadcrumbs"><?php currentQuestion($questionNum, $totalQ); ?></p>
            <p class="quiz"><?php echo $quizElements['question']; ?></p>
            <form action="index.php?q=<?php echo $questionNum + 1; ?>" method="post">
                <input type="hidden" name="correct" value="<?php echo $answer; ?>" />
                <input type="submit" class="btn" name="answer" value="<?php echo $quizElements['answers'][0]; ?>" />
                <input type="submit" class="btn" name="answer" value="<?php echo $quizElements['answers'][1]; ?>" />
                <input type="submit" class="btn" name="answer" value="<?php echo $quizElements['answers'][2]; ?>" />
            </form>
        </div>
        <?php else : ?>
            <div>
                <p>Your total score is <?php echo $_SESSION['totalScores']; ?></p>
               <p>Retake quiz? <a href="index.php?status=yes">Yes</a></p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>