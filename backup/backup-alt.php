<?php

$filename = 'db-backup.sql';

$result = exec('mysqldump database_name --password="" --user=root --single-transaction > /backup/' . $filename, $output);

if (empty($output)) {
    http_response_code(200);
    $mimetype = 'aplication/json';
    $data = file_get_contents($filename);
    $size = strlen($data);
    header("Content-Disposition: attachment; filename= $filename");
    header("Content-Length: $size");
    header("Content-Type: $mimetype");
    echo $data;
} else {
    http_response_code(500);
    echo "Tas wey";
}
