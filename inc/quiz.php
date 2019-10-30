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
include 'questions.php';

/**
 *  Sets the total question variable $totalQ to 10 max
 */
$totalQ = 10;

// Keep track of which questions have been asked
$questionNum = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_NUMBER_INT);
if (empty($questionNum)) {
    $questionNum = 1;
}

// Restart the counting once the number of questions answered is more than the total number of question
if ($questionNum > $totalQ) {
    header('location: index.php');
    exit;
}

/**
 * Shows the current question the user is answering
 *
 * @param integer $questionNum
 * @param integer $totalQ
 * @return void
 */
// Show which question they are on
function currentQuestion(int $questionNum, int $totalQ)
{
    echo "Question $questionNum of $totalQ";
}

// Grab a random key from the second level array
$randomKey = array_rand($questions);

// Use the random key to select a random array element
$el = $questions[$randomKey];

// Show random question
/**
 * Builds the random quiz question
 *
 * @param int $el
 * @return string
 */
function askQuestion($el) {
    $quizQuestion = "What is " . ($el['leftAdder']) . " + "  . ($el['rightAdder']);
    return $quizQuestion;
}

// Define correct answer to the quiz question
$answer = $el['leftAdder'] + $el['rightAdder'];

// Shuffle answers
/**
 * Sets the correct answer and creates two wrong answers
 * This function creates the three answers including the correct one. Then it reshuffles the answers before returning the values as an array. 
 *
 * @param int $answer
 * @return array
 */
function answerQuestion($answer) {
    // Setup all the answers
    if(isset($answer)) {
        $answers[] = $answer;
        $answers[] = $answer + rand(5, 10);
        $answers[] = $answer - rand(2, 10);
    }

    // Shuffle answer buttons
    shuffle($answers);

    return $answers;
}

// Assign the value of answerQuestion function to a variable for ease of use.
$submittedAns = answerQuestion($answer);

print_r($submittedAns);

/**
 * Check if form is submitted
 * Keep track of answers
 */

if (isset($_POST['answer'])) {
    // Set session variables
    $trackedAnswer = $_SESSION['answer'][$questionNum -1] = filter_input(INPUT_POST, 'answer', FILTER_SANITIZE_NUMBER_INT);
    $correctAnswer = $_SESSION['correct'][$questionNum -1] = filter_input(INPUT_POST, 'correct', FILTER_SANITIZE_NUMBER_INT);
    echo "<pre>";
    var_dump($trackedAnswer);
    var_dump($correctAnswer);
    echo "</pre>";
}

function displayToast($submittedAnswer, $realAnswer) {
        if ($submittedAnswer === $realAnswer) {
            echo "Correct";
        } else {
            echo "Incorrect, please try again";
        }
}




// If all questions have been asked, give option to show score
// else give option to move to next question


// Show score
