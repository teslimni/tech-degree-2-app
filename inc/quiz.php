
<?php
/*
 * PHP Techdegree Project 2: Build a Quiz App in PHP
 *
 * These comments are to help you get started.
 * You may split the file and move the comments around as needed.
 *
 * You will find examples of formating in the index.php script.
 * Make sure you update the index file to use this PHP script, and persist the users answers.
 *
 * For the questions, you may use:
 *  1. PHP array of questions
 *  2. json formated questions
 *  3. auto generate questions
 *
 */

/**
 * Start the session to keep track of questions and answers
 */
session_start();

// Include questions
include 'generate_questions.php';

/**
 *  Sets the total question variable $totalQ to 10 max
 */
$totalQ = 10;

// Keep track of which questions have been asked
$questionNum = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_NUMBER_INT);
if (empty($questionNum)) {
    $questionNum = 1;
    session_destroy();
}

/**
 * If all questions have been asked and the link to retake the quiz is clicked,
 * reload the quiz and restart the counting.
 */
if (isset($_GET['status'])) {
    $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING);
    if ($status === 'yes') {
        session_destroy();
        header('location: index.php');
    }
}

// Check that the form has been submitted
if (isset($_POST['answer'])) {
    // Set session variables if form has been submitted
    $trackedAnswer = $_SESSION['answer'][$questionNum - 1] = filter_input(INPUT_POST, 'answer', FILTER_SANITIZE_NUMBER_INT);
    $correctAnswer = $_SESSION['correct'][$questionNum - 1] = filter_input(INPUT_POST, 'correct', FILTER_SANITIZE_NUMBER_INT);
}

// Check if the Session totalScores variable is set, if not initialize it to 0
if (!isset($_SESSION['totalScores'])) {
    $_SESSION['totalScores'] = 0;
}

/**
 * Show which question they are on
 *
 * @param integer $questionNum
 * @param integer $totalQ
 * @return void
 */

function currentQuestion(int $questionNum, int $totalQ)
{
    echo "Question $questionNum of $totalQ";
}

/**
 * Displays the correct or incorrect toast when a user answers a question
 *
 * @param integer $submittedAnswer
 * @param integer $realAnswer
 * @return void
 */
function displayToast(int $submittedAnswer, int $realAnswer)
{
    if ($submittedAnswer === $realAnswer) {
        // Toast Correct 
        $toast = '';
        $toast .= '<div class="toaster success">';
        $toast .= 'Good job! That\'s correct!';
        $toast .= '</div>';
        
        $_SESSION['totalScores']++;
        echo $toast;
    } else {
        $toast = '';
        $toast .= '<div class="toaster danger">';
        $toast .= 'Sorry! that is incorrect! ';
        $toast .= $realAnswer;
        $toast .= ' is the correct answer';
        $toast .= '</div>';

        echo $toast;
    }
}
