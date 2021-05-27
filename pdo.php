<?php

include $_SERVER['DOCUMENT_ROOT'] . '/db.php'; 

    $sql = "SELECT * FROM users";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die($e);
    }

?>
