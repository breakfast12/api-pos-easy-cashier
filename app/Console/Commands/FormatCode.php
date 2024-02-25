<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class FormatCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:format';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Formats code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Formatting Code...');

        $process = new Process(['./vendor/bin/php-cs-fixer', 'fix', base_path()]);
        $process->run();

        if (!$process->isSuccessful()) {
            $this->error('Code formatting failed.');
            return 1;
        }

        $this->info('Code has been formatted successfully.');

        return 0;
    }
}
