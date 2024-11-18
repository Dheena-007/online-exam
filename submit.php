<?php
session_start();
include('db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$score = 0;

$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $question_id = $row['id'];
    $correct_answer = $row['answer'];
    $user_answer = $_POST["question_$question_id"] ?? null;

    if ($user_answer === $correct_answer) {
        $score++;
    }
}

echo "<h1>Your Score: $score</h1>";
session_destroy();
?>
