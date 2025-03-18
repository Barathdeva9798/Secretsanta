<?php
class SecretSanta {
    private $employees;
    private $previousAssignments;

    public function __construct($employees, $previousAssignments) {
        $this->employees = $employees; 
        $this->previousAssignments = $previousAssignments; 
    }

    public function assignSecretSantas() {
        $assignments = [];
        $remainingEmployees = $this->employees;
        
        // Create a mapping of previous assignments by email
        $prevAssignmentsMap = [];
        foreach ($this->previousAssignments as $assignment) {
            $prevAssignmentsMap[$assignment['Employee_EmailID']] = $assignment['Secret_Child_EmailID'];
        }

        // Loop over employees to assign secret child
        foreach ($this->employees as $employee) {
            // Exclude self and the previous year's secret child for this employee based on email
            $excluded = [$employee->email, $prevAssignmentsMap[$employee->email] ?? ''];

            // Filter remaining employees who are not excluded
            $validOptions = array_filter($remainingEmployees, function($candidate) use ($excluded) {
                return !in_array($candidate->email, $excluded);
            });
            // echo "<br><br><br>";
            // print_r($validOptions);
            // If no valid options left, return null (indicating failure)
            if (empty($validOptions)) {
                return null;
            }
            $chosenOne = null;
            // Randomly pick a secret child from valid options
            while(empty($chosenOne))
            {
                $rand = array_rand($validOptions);
                $chosenOne = array_splice($validOptions, $rand, 1)[0];
            }
            // echo "<br><br><br> $rand ,  $employee->name ,  $employee->email ";
            // var_dump($chosenOne);
            // echo "<hr>";
            // Assign the secret child and remove from remaining list
            $assignments[] = [
                'Employee_Name' => $employee->name,
                'Employee_EmailID' => $employee->email,
                'Secret_Child_Name' => $chosenOne->name,
                'Secret_Child_EmailID' => $chosenOne->email,
            ];

            // Remove the assigned secret child from the list of remaining employees
            $remainingEmployees = array_filter($remainingEmployees, function($e) use ($chosenOne) {
                return $e->email !== $chosenOne->email;
            });
            // print_r($remainingEmployees);
        }
        // echo "<pre>";
        // print_r($assignments);
        return $assignments;
    }
}

?>