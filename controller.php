<?php
// Author: Chris Peterson

require_once('./DataBaseAdaptor.php');
$DataBase = new DatabaseAdaptor();

if (isset($_GET['quote']) && isset($_GET['author'])) {
    $DataBase->add($_GET['quote'], $_GET['author']);
}


if (isset($_GET ['mode'])) {
    if ($_GET['mode'] == "new") {
        header("Location: index.php?mode=new");
    } else if ($_GET['mode'] == "show") {
        header("Location: index.php");
    } else if ($_GET['mode'] == "addPoint") {
        $DataBase->changePoint($_GET['id'], 1);
        header("Location: index.php");
    } else if ($_GET['mode'] == "subtractPoint") {
        $DataBase->changePoint($_GET['id'], -1);
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}


/*
$array = $DataBase->getQuotesAsArray();
$record = $array[$_GET['id']-1];
$record['points'] = $record['points']+1;
$DataBase->changePoint($_GET['id'], $record['points']);

$array = $DataBase->getQuotesAsArray();
$record = $array[$_GET['id']-1];
$record['points'] = $record['points']-1;
        $DataBase->changePoint($_GET['id'], $record['points']);
*/
