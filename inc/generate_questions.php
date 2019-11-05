<?php
// Loop for required number of questions
$quizElements = [];

// Get random numbers to add
$leftAdder = rand(10, 100);
$rightAdder = rand(30, 100);

// Generate random questions
$randQuestion = "What is {$leftAdder}  + {$rightAdder}";

// Calculate correct answer
$answer = $leftAdder + $rightAdder;

// Get incorrect answers within 10 numbers either way of correct answer
$firstIncorrectAnswer = rand(-10, 10);
$secondIncorrectAnswer = rand(-10, 10);

/**
 * Make sure it is a unique answer
 * This makes sure that each of the answer option is unique and that no answer is predictable.
 */
if ($firstIncorrectAnswer == $secondIncorrectAnswer || $answer == $firstIncorrectAnswer || $answer == $secondIncorrectAnswer || $firstIncorrectAnswer == 0 || $firstIncorrectAnswer == -$firstIncorrectAnswer || $secondIncorrectAnswer == 0 || $secondIncorrectAnswer == -$secondIncorrectAnswer) {
    $firstIncorrectAnswer += 2;
    $secondIncorrectAnswer += 5;
} 

$answers[] = $answer;
$answers[] = $answer + $firstIncorrectAnswer;
$answers[] = $answer + $secondIncorrectAnswer;

// Shuffle the answers so that the correct answer shows upi different position each time
shuffle($answers);

// Build the quiz elements
// Add question and answer to questions array
$quizElements['question'] = $randQuestion;
$quizElements['answers'] = $answers;
