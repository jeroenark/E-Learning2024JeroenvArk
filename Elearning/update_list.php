<?php
// update_list.php

// Include necessary files
include "databaseconnection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the list ID from the form
    $list_id = $_POST['id'];

    // Update list details
    $name = $_POST['name'];
    $description = $_POST['description'];
    $sql = "UPDATE `lijst` SET `name` = '$name', `description` = '$description' WHERE `id` = $list_id";
    $result = mysqli_query($conn, $sql);

    // Check if list details are updated successfully
    if ($result) {
        // Loop through each question and good answer to update
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'question_') !== false) {
                $question_id = substr($key, strpos($key, '_') + 1);
                $question = $_POST[$key];
                $good_answer = $_POST['good_answer_' . $question_id];
                $sql_update_question = "UPDATE `lijst_vragen` SET `question` = '$question', `good_answer` = '$good_answer' WHERE `id` = $question_id";
                $result_update_question = mysqli_query($conn, $sql_update_question);
                // Check if question is updated successfully
                if (!$result_update_question) {
                    echo "Error updating question.";
                    exit;
                }
            }
        }
        // Redirect back to the edit_list.php with a success message
        header("Location: lijst.php");
        exit;
    } else {
        echo "Error updating list details.";
    }
} else {
    echo "Invalid request.";
}

// Close database connection
mysqli_close($conn);
?>