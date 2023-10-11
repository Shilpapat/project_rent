<?php
include('db.php');

if (isset($_GET['state'])) {
    $state = $_GET['state'];
    $state = mysqli_real_escape_string($connect, $state);

    $sql = "SELECT s.STATE_NAME, c.CITY, c.CITY_DESC
            FROM cities c
            JOIN states s ON c.ID_STATE = s.ID
            WHERE s.STATE_NAME = '$state'";

    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li><a href='content.php?state=" . $row['STATE_NAME'] . "&city=" . $row['CITY'] . "'>" . $row['CITY'] . "</a>:". $row['CITY_DESC'] ."</li>";
        }
        echo "</ul>";
    } else {
        echo "No cities found for $state.";
    }
} else {
    echo "State not specified.";
}
?>
