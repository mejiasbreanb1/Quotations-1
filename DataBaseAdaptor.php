<?php
// Author: Chris Peterson

class DatabaseAdaptor {
    private $DB;

    public function __construct() {
        $db = 'mysql:dbname=quotes;host=127.0.0.1';
        $user = 'root';
        $password = '';

        try {
            $this->DB = new PDO($db, $user, $password);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo ('Error establishing connection.');
            exit();
        }
    }

    public function getQuotesAsArray() {
            $stmt = $this->DB->prepare("SELECT * FROM quotations ORDER BY points DESC, dateAdded DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($quote, $author) {
        $stmt = $this->DB->prepare("INSERT INTO quotations (dateAdded, quotation, author, points)
                                    values(now(), :quote, :author, 0)");
        $stmt->bindParam('quote', $quote);
        $stmt->bindParam('author', $author);
        $stmt->execute();
    }

    public function delete($quote) {
        $stmt = $this->DB->prepare("DELETE FROM quotations
                                    WHERE quotation=:quote");
        $stmt->bindParam('quote', $quote);
        $stmt->execute();
    }

    public function changePoint($id, $value) {
        $stmt = $this->DB->prepare("SELECT * FROM quotations WHERE ID=" .$id);
        echo "ID = " . intVal($id) . PHP_EOL;
        //$stmt->bindParam('id', $id);
        $stmt->execute();
        $points = $stmt->fetchColumn(4);
        echo "VALUE = " . $value. PHP_EOL;
        $value = $value+intval($points);
        echo "POINTS = " . intVal($points) . PHP_EOL;
        echo "VALUE = " . $value. PHP_EOL;

        $stmt = $this->DB->prepare("UPDATE quotations SET points=:value WHERE ID=:id");
        $stmt->bindParam('value', $value);
        $stmt->bindParam('id', $id);
        $stmt->execute();
    }

    public function sort() {
        $stmt = $this->DB->prepare("SELECT * FROM quotations ORDER BY points");
        $stmt->execute();
    }
}
