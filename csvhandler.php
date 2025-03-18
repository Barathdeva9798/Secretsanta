<?php
class CSVHandler {
    public static function readCSV($filePath) {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new Exception("File not found or unreadable: $filePath");
        }

        $data = [];
        if (($handle = fopen($filePath, 'r')) !== false) {
            // Get header
            $header = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== false) {
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    public static function writeCSV($filePath, $data) {
        if (($handle = fopen($filePath, 'w')) === false) {
            throw new Exception("Unable to open file for writing: $filePath");
        }

        // Write header
        fputcsv($handle, ['Employee_Name', 'Employee_EmailID', 'Secret_Child_Name', 'Secret_Child_EmailID']);
        foreach ($data as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);
    }
}


?>
