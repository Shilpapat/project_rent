<?php
include('db.php');

if (isset($_GET['state']) && isset($_GET['city'])) {
    $state = $_GET['state'];
    $city = $_GET['city'];
    $state = mysqli_real_escape_string($connect, $state);
    $city = mysqli_real_escape_string($connect, $city);

    //$sql = "SELECT * FROM cities WHERE CITY = '$city' AND ID_STATE = (SELECT ID FROM states WHERE STATE_NAME = '$state')";
    //$sql = "SELECT c.*, s.Author_Name, s.Author_Bio
    //        FROM cities c
      //      INNER JOIN states s ON c.Author_ID = s.Author_ID
      //      WHERE c.CITY = '$city' AND c.ID_STATE = (SELECT ID FROM states WHERE STATE_NAME = '$state')";
      $sql = "SELECT c.*, a.Author_Name, a.Author_Bio
            FROM cities c
            INNER JOIN author a ON c.Author_ID = a.Author_ID
            WHERE c.CITY = '$city' AND c.ID_STATE = (SELECT ID FROM states WHERE STATE_NAME = '$state')";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h1>Rent Assistance in $city, $state</h1>";
        //echo "Author: " . $row['Author_Name'] . "<br>";
        //echo "Author Bio: " . $row['Author_Bio'] . "<br>";
        // Output questions and answers
        for ($i = 1; $i <= 7; $i++) {
            $questionKey = "Question_$i";
            $answerKey = "Answer_$i";
            if (isset($row[$questionKey]) && isset($row[$answerKey])) {
                echo "{$row[$questionKey]}: {$row[$answerKey]}<br><br />";
            }
        }
        echo "Author: " . $row['Author_Name'] . "<br><br>";
        echo "Author Bio: " . $row['Author_Bio'] . "<br>";
    } else {
        echo "City not found.";
    }
} else {
    echo "State and city not specified.";
}
?>
