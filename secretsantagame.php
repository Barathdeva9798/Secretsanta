<?php

class SecretSantaGame {
    private $employees = [];
    private $previousAssignments = [];

    public function __construct($employeesCSV, $previousAssignmentsCSV=null) {
        // Load employees from the CSV
        $employeesData = CSVHandler::readCSV($employeesCSV);
        foreach ($employeesData as $data) {
            $this->employees[] = new Employee($data['Employee_Name'], $data['Employee_EmailID']);
        }
        // echo "<pre>";
        // print_r($this->employees);
        // echo"</pre>";
        // Load previous year's assignments
        if($previousAssignmentsCSV)
        {
            $previousAssignmentsData = CSVHandler::readCSV($previousAssignmentsCSV);
            $this->previousAssignments = $previousAssignmentsData;
        }
    }

    public function run() {
        //print_r($this->previousAssignments);
        $secretSanta = new SecretSanta($this->employees, $this->previousAssignments);
        $assignments = $secretSanta->assignSecretSantas();

        if ($assignments === null) {
            echo "Error: Unable to assign Secret Santa due to constraints.\n";
            return;
        }

        // Write the assignments to a new CSV
        print_r($assignments);
        $filepath = "./uploads/secret_santa_assignments".time().".csv";
        CSVHandler::writeCSV($filepath, $assignments);
        echo "Secret Santa assignments have been successfully generated. <br>";
        echo '<a href="uploads/secret_santa_assignments.csv" download>Download the Secret Santa Assignments</a>';
    }
}
?>