<?php
/**
* Start the session to keep track of questions and answers
*/
session_start();

// Include questions
include 'questions.php';

/**
* Sets the total question variable $totalQ to 10 max
*/
$totalQ = 10;

// Keep track of which questions have been asked
$questionNum = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_NUMBER_INT);
if(empty($questionNum)) {
$questionNum = 1;
}

// Restart the counting once the number of questions answered is more than the total number of question
if($questionNum > $totalQ) {
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
function currentQuestion(int $questionNum, int $totalQ) {
echo "Question $questionNum of $totalQ";
}

/**
* Builds up the random question one at a time using each array item key to generate the random question
*
* @param array $questions
* @return mixed $quizQuestions
*/
function showQuiz(array $questionItems, int $questionNum) {
// Grab a random key from the second level array
$randomKey = array_rand($questionItems);

// Use the random key to select a random array element
$el = $questionItems[$randomKey];

var_dump($el['leftAdder']);

$answers = [];

// Show random question
$quizQuestion = "What is " . ($el['leftAdder']) . " + " . ($el['rightAdder']);

// Setup all the answers
$answer= $el['leftAdder'] + $el['rightAdder'];
$answers[] = $answer;
$answers[] = $answer + rand(5, 10);
$answers[] = $answer - rand(2, 10);

// Shuffle answer buttons
shuffle($answers);

$quizQuestion .= '<form action="index.php?q=';
    $quizQuestion .= $questionNum + 1 . '" method="post">';
    $quizQuestion .= '<input type="hidden" name="id" value="0" />';
    $quizQuestion .= '<input type="submit" class="btn" name="answer" value="'. $answers[0] . '" />';
    $quizQuestion .= '<input type="submit" class="btn" name="answer" value="' . $answers[1] . '" />';
    $quizQuestion .= '<input type="submit" class="btn" name="answer" value="' . $answers[2] . '" />';
    $quizQuestion .= '</form>';

return $quizQuestion;
}