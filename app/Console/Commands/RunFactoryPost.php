<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Console\Command;
use function Laravel\Prompts\progress;

class RunFactoryPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var strings
     */
    protected $signature = 'app:run-factory-post {userId=1} {count=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run factory for Post class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        progress(
            label: 'Making Post/s',
            steps: $this->argument("count"),
            callback: function () {
                Post::factory(["user_id" => $this->argument("userId")])
                    ->has(Comment::factory()->count(mt_rand(3, 6)), "comments")
                    ->create();
            },
        );
    }
}
