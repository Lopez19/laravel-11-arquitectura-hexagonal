<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;

class ImportEmployee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:employee {filename : The name of the file to import}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Contact Importer';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('filename');

        // Retrieve the employees from the file
        $employees = $this->readCsv($filename);

        // Import the employees
        foreach ($employees as $employee) {
            // Find the employee
            $employeeFound = Employee::find($employee['id']);
            if ($employeeFound) {
                // Calculate the salary
                $employeeFound->salary = $employeeFound->pricePerHour * $employee['hoursWorked'];
                // Save the in bew file
                $this->saveDataToCsv($employeeFound->toArray());
            }
        }

        // Show finalization message
        $this->info('All rows were imported successfully');
    }

    /**
     * Read the CSV file and return the data as an array.
     *
     * @param string $filename
     * @return array
     */
    private function readCsv(string $filename): array
    {
        $data = [];
        $file = fopen($filename, 'r');
        while (($row = fgetcsv($file)) !== false) {
            $data[] = [
                'id' => $row[0],
                'hoursWorked' => $row[1],
            ];
        }
        fclose($file);
        return $data;
    }

    /**
     * Save the data to a CSV file.
     *
     * @param array $data
     */
    private function saveDataToCsv(array $data): void
    {
        $file = fopen('newfile.csv', 'a');
        fputcsv($file, $data);
        fclose($file);
    }
}
