<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Src\Employee\Application\UseCases\UpdateSalaryUseCase;
use Src\Employee\Infrastructure\Repositories\EloquentEmployeeRepository;

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
            $useCase = new UpdateSalaryUseCase(new EloquentEmployeeRepository());
            $useCase->execute(
                $employee['id'],
                $employee['hoursWorked']
            );
        }

        // Return a success message
        return view('employee.success', ['message' => 'The salary of the employees has been updated successfully']);
    }
}
