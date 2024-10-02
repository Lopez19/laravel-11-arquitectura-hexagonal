<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

final class EmployeeController extends Controller
{
    public function updateSalary(Request $request)
    {
        // Validate the request
        $request->validate([
            'employess.*.id' => 'required|exists:employees',
            'employees.*.hoursWorked' => 'required|min:0',
        ]);

        // Retrieve the employees
        $employees = $request->employees;

        // Update the salary of each employee
        foreach ($employees as $employee) {
            // Find the employee
            $employeeFound = Employee::find($employee['id']);
            if ($employeeFound) {
                // Calculate the salary
                $employeeFound->salary = $employeeFound->pricePerHour * $employee['hoursWorked'];
                // Save the employee
                $employeeFound->save();
            }
        }

        // Return a success message
        return view('employee.success', ['message' => 'The salary of the employees has been updated successfully']);
    }
}
