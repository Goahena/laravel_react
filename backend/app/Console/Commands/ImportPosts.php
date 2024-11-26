<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportPosts extends Command
{
    protected $signature = 'scout:auto-import';
    protected $description = 'Automatically import posts to Meilisearch';

    public function handle()
    {
        $this->info('Starting import...');
        $modelClass = \App\Models\Post::class;
        (new $modelClass)->newQuery()->searchable();
        $this->info('All posts have been imported!');
    }
}
