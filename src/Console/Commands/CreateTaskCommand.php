<?php

namespace Lmottasin\LaravelPermissionEditor\Console\Commands;

use Illuminate\Console\Command;
use Lmottasin\LaravelPermissionEditor\Models\Task;

class CreateTaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create task from using the package';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('What is your task name?');

        if ($name) {
            Task::create([
                'name' => $name,
            ]);
        }

        return Command::SUCCESS;
    }
}
