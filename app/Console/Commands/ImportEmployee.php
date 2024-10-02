<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;
use Src\Employee\Application\UseCases\UpdateSalaryUseCase;
use Src\Employee\Infrastructure\Repositories\InFileEmployeeRepository;

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
            $useCase = new UpdateSalaryUseCase(new InFileEmployeeRepository());
            $useCase->execute(
                $employee['id'],
                $employee['hoursWorked']
            );
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
    private function readCsv(string $filename, string $delimiter = ","): array
    {
        $data = [];
        $file = fopen($filename, 'r');
        while (($row = fgetcsv($file, 1000, $delimiter)) !== false) {
            $data[] = $row;
        }
        fclose($file);
        return $data;
    }
}
