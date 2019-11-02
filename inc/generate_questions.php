<?php
// Loop for required number of questions
$quizElements = [];
// Get random numbers to add
$leftAdder = rand(0, 100);
$rightAdder = rand(0, 100);
// Generate random questions
$randQuestion = "What is {$leftAdder}  + {$rightAdder}";

// Calculate correct answer
$answer = $leftAdder + $rightAdder;

// Get incorrect answers within 10 numbers either way of correct answer
$firstIncorrectAnswer = rand(3, 10);
$secondIncorrectAnswer = rand(4, 10);

// Make sure it is a unique answer
$answers[] = $answer;
$answers[] = $answer + $firstIncorrectAnswer;
$answers[] = $answer - $secondIncorrectAnswer;

shuffle($answers);

// Build the quiz elements
$quizElements['question'] = $randQuestion;
$quizElements['answers'] = $answers;

    // echo "<pre>";
    // var_dump($quizElements);
    // echo "</pre>";




// Add question and answer to questions array