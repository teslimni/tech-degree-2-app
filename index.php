<?php include 'inc/quiz.php'; ?>
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
        <?php
        //Toast correct and incorrect answers for 2 seconds
        if ($questionNum > 1) {
            displayToast($trackedAnswer, $correctAnswer);
        }
        ?>
        <?php if ($questionNum <= $totalQ) : ?>
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
            <div class="quiz-result">
                <!-- Show total score -->
                <?php if ($_SESSION['totalScores'] > $totalQ) : ?>
                    <!-- If the total score is greater than the total number of questions, minus 1. -->
                    <p>Your total score is <?php echo $_SESSION['totalScores'] - 1 . '/' . $totalQ; ?></p>
                    <!-- If all questions have been asked, give option to retake the quiz -->
                    <p>Would you like to retake quiz? <a href="index.php?status=yes">Yes</a></p>
                    <!-- Prevent the total score from incrementing on browser refresh -->
                    <?php $_SESSION['totalScores'] = null; ?>
                <?php else : ?>
                    <p>Your total score is <?php echo $_SESSION['totalScores'] . '/' . $totalQ; ?> </p>
                    <!-- If all questions have been asked, give option to retake the quiz -->
                    <p>Would you like to retake quiz? <a href="index.php?status=yes">Yes</a></p>
                    <!-- Prevent the total score from incrementing on browser refresh -->
                    <?php $_SESSION['totalScores'] = null; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="inc/js/main.js"></script>
</body>

</html>