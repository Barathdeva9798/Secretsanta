# Secret Santa Assignment System

## Overview
This system assigns Secret Santa partners to employees while respecting certain rules:
1. An employee cannot assign themselves as their Secret Santa.
2. Employees cannot be assigned to the same Secret Santa as the previous year.
3. Every employee will have exactly one Secret Santa, and each Secret Santa will have only one recipient.

## Requirements
- PHP 7.0 or higher.
- The system reads two CSV files:
  1. **employees.csv**: Contains the list of employees.
  2. **previous_assignments.csv**: Contains last year's Secret Santa assignments.
- Generates a new CSV file **secret_santa_assignments.csv** with the new assignments.

## Setup Instructions
- Upload CSV Files:
  1. Open the provided HTML form and upload the two CSV files:
    employees.csv (mandatory)
    previous_assignments.csv (optional)
- How it Works:
      If the previous_assignments.csv is not available, it will simply generate new assignments from the employees.csv file.
- Generate Assignments:
  2. After uploading the files, click the button to start the Secret Santa assignment process.
- Download the Result:

  3. A new secret_santa_assignments.csv will be generated and uploaded to the ./upload directory.

## Error Handling
The system checks for invalid or unreadable CSV files and reports errors accordingly.

## Testing
Tests can be created by modifying the employee and previous assignment data.
