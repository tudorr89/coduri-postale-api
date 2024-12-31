<?php

namespace App\Console\Commands;

use App\Imports\ZipcodeImport;
use Illuminate\Console\Command;

class ImportZipCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = 'infocod.xls';
        $this->output->title('Starting import');
        (new ZipcodeImport)->withOutput($this->output)->import($file);
        $this->output->success('Import successful');
    }
}
