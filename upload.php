<?php
// Include classes (for modularity and OOP)
error_reporting(0);
require_once './employee.php';
require_once './csvhandler.php';
require_once './secretsanta.php';
require_once './secretsantagame.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['employeeFile']) && isset($_FILES['previousFile'])) {
    try {
        // Ensure the files are valid CSV files
        // print_r($_FILES['employeeFile']['type']);
        if (trim($_FILES['employeeFile']['type']) !== 'text/csv') {
            throw new Exception('Only CSV files are allowed.');
        }
        if(empty($_FILES['previousFile']) && $_FILES['previousFile']['type'] !== 'text/csv')
        {
            throw new Exception('Only CSV files are not allowed.');
        }

        // Move the uploaded files to a temporary directory
        $employeeFilePath = 'uploads/' . basename($_FILES['employeeFile']['name']);
        $previousFilePath = 'uploads/' . basename($_FILES['previousFile']['name']);
        $fileType = strtolower(pathinfo($employeeFilePath, PATHINFO_EXTENSION));
        if (!move_uploaded_file($_FILES['employeeFile']['tmp_name'], $employeeFilePath)) {
            throw new Exception('Error moving the employee CSV file.');
        }

        if (empty($previousFilePath['name']) && !move_uploaded_file($_FILES['previousFile']['tmp_name'], $previousFilePath)) {
            throw new Exception('Error moving the previous year CSV file.');
        }

        // Load the data from the uploaded files
        // $game = new SecretSantaGame($employeeFilePath, $previousFilePath);
        // $game->run();

        if ($fileType === "csv") {
            $game = new SecretSantaGame($employeeFilePath, $previousFilePath); // Change the previous assignments file if needed.
            $game->run();
        } 

        echo "Secret Santa assignments have been successfully generated.";

    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Please upload both CSV files.';
    echo '<meta http-equiv="refresh" content="0;url=./index.html">';

}
?>
