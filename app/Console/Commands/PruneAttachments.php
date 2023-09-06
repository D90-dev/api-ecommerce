<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Attachments\PendingAttachment;
use Laravel\Nova\Fields\Attachments\PruneStaleAttachments;

class PruneAttachments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attachments:prune';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prune stale attachments';

    /**
     * Execute the console command.
     */
    public function handle(Schedule $schedule): void
    {
        $prune = new PruneStaleAttachments();
        $prune();
    }
}
