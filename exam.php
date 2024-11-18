<?php
session_start();
include('db.php');


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


$sql = "SELECT * FROM questions";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows === 0) {
    echo "<p>No questions available at the moment.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
        }
        form {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .question {
            margin-bottom: 20px;
        }
        .question p {
            font-weight: bold;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<h1>Online Exam</h1>

<form method="POST" action="submit.php" id="quizForm">
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="question">
            <p><?php echo htmlspecialchars($row['question']); ?></p>
            <input type="radio" name="question_<?php echo $row['id']; ?>" value="option1"> <?php echo htmlspecialchars($row['option1']); ?><br>
            <input type="radio" name="question_<?php echo $row['id']; ?>" value="option2"> <?php echo htmlspecialchars($row['option2']); ?><br>
            <input type="radio" name="question_<?php echo $row['id']; ?>" value="option3"> <?php echo htmlspecialchars($row['option3']); ?><br>
            <input type="radio" name="question_<?php echo $row['id']; ?>" value="option4"> <?php echo htmlspecialchars($row['option4']); ?><br>
        </div>
    <?php } ?>
    <p class="error" id="errorMsg"></p>
    <button type="submit">Submit</button>
</form>

<script>
    
    document.getElementById('quizForm').addEventListener('submit', function (e) {
        let errorMsg = document.getElementById('errorMsg');
        errorMsg.textContent = ''; // Clear previous error messages

        let questions = document.querySelectorAll('.question');
        let unanswered = false;

        questions.forEach(question => {
            let inputs = question.querySelectorAll('input[type="radio"]');
            let answered = Array.from(inputs).some(input => input.checked);

            if (!answered) {
                unanswered = true;
            }
        });

        if (unanswered) {
            e.preventDefault(); // Prevent form submission
            errorMsg.textContent = 'Please answer all the questions before submitting.';
        }
    });
</script>

</body>
</html>
