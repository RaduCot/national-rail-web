<?php
// Retrieve the JSON data sent in the request
$data = json_decode(file_get_contents('php://input'), true);

// Process and save the data to MySQL
$host = 'aws.connect.psdb.cloud';
$dbname = 'nationalrail';
$username = 'le40l5igln90eexjtwwc';
$password = 'pscale_pw_v3pqjqy5s2J6lJzDe07J3tntweNUzyXZiX3svILBTnH';

// Connection
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::MYSQL_ATTR_SSL_CA => __DIR__ . "/cacert.pem",
);
$pdo = new PDO($dsn, $username, $password, $options);


// Query for deleting all rows
$query = "DELETE FROM TRENURI";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Prepare the SQL query for inserting data
$query = 'INSERT INTO TRENURI (id_tren, vagoane, masa, v_max) VALUES ';
$placeholders = array();
$bindValues = array();

// Iterate over the data array and build the placeholders and bind values for the prepared statement
foreach ($data as $row) {
    $placeholders[] = '(?, ?, ?, ?)';
    $bindValues = array_merge($bindValues, array_values($row));
}

// Combine the query and placeholders
$query .= implode(', ', $placeholders);

// Prepare the statement
$stmt = $pdo->prepare($query);

// Bind the values to the prepared statement
$stmt->execute($bindValues);

// Return a response indicating success or failure
if ($stmt) {
    http_response_code(200); // OK
} else {
    http_response_code(500); // Internal Server Error
}
//terminate the connection
$pdo = null;
?>