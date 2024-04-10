<?php
include "header.php";
include "databaseconnection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the ID of the list to be edited
    $list_id = $_GET['id'];

    // Fetch the list details from the database
    $sql = "SELECT * FROM `lijst` WHERE `id` = $list_id";
    $result = mysqli_query($conn, $sql);
    $sql1 = "SELECT * FROM `lijst_vragen` WHERE `lists_id` = $list_id";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    // Check if the list exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Display the form with pre-filled values for editing
        ?>
        <div class="edit-list-form">
    <h2>Edit List</h2>
    <form method="POST" action="update_list.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
        <label for="description">Description:</label>
        <textarea id="description" name="description"><?php echo $row['description']; ?></textarea>

        <?php
        // Loop through each question and good answer
        while ($row1 = mysqli_fetch_assoc($result1)) {
            ?>
            <label for="question_<?php echo $row1['id']; ?>">Question:</label>
            <input type="text" id="question_<?php echo $row1['id']; ?>" name="question_<?php echo $row1['id']; ?>" value="<?php echo $row1['question']; ?>">
            <label for="good_answer_<?php echo $row1['id']; ?>">Good Answer:</label>
            <input type="text" id="good_answer_<?php echo $row1['id']; ?>" name="good_answer_<?php echo $row1['id']; ?>" value="<?php echo $row1['good_answer']; ?>">
            <?php
        }
        ?>

        <button type="submit">Update</button>
    </form>
</div>
        <?php
    } else {
        echo "List not found.";
    }
} else {
    echo "Invalid request.";
}

// Close database connection
mysqli_close($conn);
?>