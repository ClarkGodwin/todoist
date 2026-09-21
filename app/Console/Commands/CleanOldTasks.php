<?php

namespace App\Console\Commands;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:clean-old-tasks')]
#[Description('to delete the past tasks and clean the database')]
class CleanOldTasks extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Supprime toutes les tâches dont la date/échéance est passée (avant le début d'aujourd'hui)
        $deletedCount = Task::where('day', '<', now()->toDateString())->delete();

        $this->info("Old Tasks cleaned : {$deletedCount} task(s) deleted.");
    }
}
