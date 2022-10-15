<?php
include '../config/ROUTE.php';


header("Content-disposition: attachment; filename: db-backup.sql");
header('Access-Control-Allow-Origin:' . $ROUTE . '');
header("Access-Control-Allow-Credentials: true");
header("Accept: application/json, aplication/sql");
//headers que permiten requests al mismo servidor, potencialmente no necesarios cuando este distribuido 
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
//header que permite utilzar json 
header('content-type: application/json; charset=utf-8');
header('mode:cors');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // The request is using the POST method
    header("HTTP/1.1 200 OK");
    return;
}
include_once '../config/database.php';
include_once '../objects/acido_graso.php';

backupDatabaseTables();

function backupDatabaseTables()
{
    //connect & select the database
    $database = new Database();
    $db = $database->getConnection();
    $tables = '*';
    $return = "";
    //get all of the tables
    if ($tables == '*') {
        $tables = array();
        $result = $db->query("SHOW TABLES");
        while ($row = $result->fetch()) {
            $tables[] = $row[0];
        }
    } else {
        $tables = is_array($tables) ? $tables : explode(',', $tables);
    }

    //loop through the tables
    foreach ($tables as $table) {
        $result = $db->query("SELECT * FROM $table");
        $numColumns = $result->columnCount();

        $return .= "DROP TABLE $table;";

        $result2 = $db->query("SHOW CREATE TABLE $table");
        $row2 = $result2->fetch();

        $return .= "nn" . $row2[1] . ";nn";

        for ($i = 0; $i < $numColumns; $i++) {
            while ($row = $result->fetch()) {
                $return .= "INSERT INTO $table VALUES(";
                for ($j = 0; $j < $numColumns; $j++) {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = preg_replace("/n/", "/n/", $row[$j]);
                    if (isset($row[$j])) {
                        $return .= '"' . $row[$j] . '"';
                    } else {
                        $return .= '""';
                    }
                    if ($j < ($numColumns - 1)) {
                        $return .= ',';
                    }
                }
                $return .= ");n";
            }
        }

        $return .= "\n\n\n";
    }

    //save file
    $name = 'db-backup.sql';
    $handle = fopen($name, 'w+');
    fwrite($handle, $return);
    flush();
    if (fclose($handle)) {
        echo json_encode(array("status" => true, "message" => $name, "file" => readfile($name)));
        exit;
    }
}
