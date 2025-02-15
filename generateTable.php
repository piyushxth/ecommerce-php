<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = ''; // or your password
$database = 'iconic';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch table names and column details
$query = "
    SELECT 
        TABLE_NAME, 
        COLUMN_NAME, 
        COLUMN_TYPE, 
        IS_NULLABLE, 
        COLUMN_DEFAULT
    FROM 
        information_schema.columns 
    WHERE 
        table_schema = '$database'
";

$result = $conn->query($query);

$tables = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tables[$row['TABLE_NAME']][] = $row;
    }
}

// Open a file to store the SQL output
$file = fopen("GTable.sql", "w");

if ($file) {
    // Function to generate CREATE TABLE statement for each table
    foreach ($tables as $tableName => $columns) {
        $createTableQuery = "CREATE TABLE `$tableName` (\n";
        $fields = [];
        
        foreach ($columns as $column) {
            $columnName = $column['COLUMN_NAME'];
            $columnType = $column['COLUMN_TYPE'];
            $isNullable = ($column['IS_NULLABLE'] === 'YES') ? 'NULL' : 'NOT NULL';
            $defaultValue = ($column['COLUMN_DEFAULT']) ? "DEFAULT '{$column['COLUMN_DEFAULT']}'" : '';

            // Build column definition
            $columnDefinition = "`$columnName` $columnType $isNullable $defaultValue";
            $fields[] = $columnDefinition;
        }

        // Join all column definitions with commas
        $createTableQuery .= implode(",\n", $fields);

        $createTableQuery .= "\n);\n\n";

        // Write the query to the file
        fwrite($file, $createTableQuery);
    }

    // Close the file after writing
    fclose($file);

    echo "SQL queries have been written to 'createTables.sql'.\n";
} else {
    echo "Unable to open file for writing.\n";
}

$conn->close();
?>
