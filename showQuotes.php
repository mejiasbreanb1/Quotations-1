<?php
// Author: Chris Peterson
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>show Quote</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<h3>Quotes</h3>
<?php

function sortArray($array) {
    if (count($array) < 2) {
        return $array;
    }

    for ($i = 0; $i < count($array)-1; $i++) {
        for ($j = 0; $j < count($array); $j++) {
            $temp = $array[$i];
            $compare = $array[$j];

            if ($temp['points'] < $compare['points']) {
                $array[$i] = $compare;
                $array[$i+1] = $temp;
            }
        }
    }

}

echo "<form action='http://localhost:63342/CSC337/quotations/controller.php' method='get'>";
echo "<button type='submit' name='mode' value='new'>Add Quote</button>";
echo"</form>";

require_once './DataBaseAdaptor.php';
$DataBaseFunctions = new DatabaseAdaptor();
$array =  $DataBaseFunctions->getQuotesAsArray();
foreach($array as $record) {
    $id = $record['ID'];
    $points = $record['points'];

    echo "<div id='element'>";
    echo "<div id='quote'>" . $record['quotation'] ;
    echo "<div id='author'><br/>-" . $record['author'] . "</div></div>";
    echo "<div id='button'>";
    echo ("<button type='submit' onclick='location=\"./controller.php?mode=addPoint&id=$id\"'>+</button><br/>");
    echo ("<button type='submit' onclick='location=\"./controller.php?mode=subtractPoint&id=$id\"'>-</button>");
    echo "</div>";
    echo "<div id='point'>" . $record['points'] . "</div>";
    echo "</div>";
}

?>

</body>
</html>
