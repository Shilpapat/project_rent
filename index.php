<?php
// Include the database connection file
include('db.php');

// Fetch data from the states table
$sql = "SELECT STATE_NAME, STATE_DESC FROM states";
$result = mysqli_query($connect, $sql);


if (!$result) {
    die("Query failed: " . mysqli_error($connect));
}


mysqli_close($connect);
?>

<!DOCTYPE html>
<html>
<head>
    <title>States List</title>
</head>
<body>
    <h1>States</h1>

    <ul>
        <?php
        mysqli_data_seek($result, 0);
        while ($row = mysqli_fetch_assoc($result)) {
            $stateName = urlencode($row['STATE_NAME']);
            echo "<li><a href='city.php?state={$stateName}'>{$row['STATE_NAME']}:</a>{$row['STATE_DESC']}</li>";
            echo "<br />";

        }
        ?>
    </ul>



</body>
</html>
