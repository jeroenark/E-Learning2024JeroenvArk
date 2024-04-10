<?php

include "header.php";
$nummers = [];
include "databaseconnection.php";
$con = new mysqli($servername, $username, $password, 'mydb');
$user_id = $_SESSION['gebruikersID'];


$sql1 = "SELECT * FROM `lijst` WHERE mode_id=2";
$sql2 = "SELECT * FROM `lijst` WHERE `users_id`=$user_id AND `mode_id`=1;";

$result = mysqli_query($con, $sql2);
    echo '<div class="heading">';
    echo '<h1 class="cards_heading">Jouw prive lijsten</h1>';
    echo '</div>';
    echo '<div class="cards">';

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            ?>

            <div class="card">
            <div class="card-body">
            <h5 class="card-title"><?php echo $row['name'];?></h5>

            <p class="card-text"><?php echo $row['description'];?></p>

            <a class="lan_select" href="<?php echo "lijst-spelen.php?id=" . $row['id']; ?>">NL>EN</a>
            <a class="lan_select" href="<?php echo "lijst-spelen1.php?id=" . $row['id']; ?>">EN>NL</a>

            <?php
            if ($row['users_id'] == $user_id) {
                echo '<form method="POST" action="delete_list.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="delete_list">Delete</button>';
                echo '</form>';

                echo '<form method="GET" action="edit_list.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="delete_list">Edit</button>';
                echo '</form>';
            }
            ?>
            </div>

            </div>

            <?php

        }

    }
    echo '</div>';


$result = mysqli_query($con, $sql1);
    echo '<div class="heading">';
    echo '<h1 class="cards_heading">Alle lijsten</h1>';
    echo '</div>';
    echo '<div class="cards">';

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            ?>

            <div class="card">
            <div class="card-body">
            <h5 class="card-title"><?php echo $row['name'];?></h5>

            <p class="card-text"><?php echo $row['description'];?></p>
            <?php
            if ($row['users_id'] == $user_id) {
                echo '<form method="POST" action="delete_list.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="delete_list">Verwijder</button>';
                echo '</form>';

                echo '<form method="GET" action="edit_list.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="delete_list">Edit</button>';
                echo '</form>';
            }
            ?>
            <a class="lan_select" href="<?php echo "lijst-spelen.php?id=" . $row['id']; ?>">NL>EN</a>
            <a class="lan_select" href="<?php echo "lijst-spelen1.php?id=" . $row['id']; ?>">EN>NL</a>
            </div>

            </div>

            <?php

        }

    }
    echo '</div>';
?>
</div>