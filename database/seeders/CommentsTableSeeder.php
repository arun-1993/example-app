<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = BlogPost::all();
        $users = User::all();

        if ($posts->count() === 0 || $users->count() === 0) {
            $this->command->info('There are no blog posts or users, so no comments will be created.');
            return;
        }

        $comments = (int) $this->command->ask('How many comments would you like to create?', 150);

        Comment::factory($comments)->make()->each(function ($comment) use ($posts, $users) {
            $comment->user_id      = $users->random()->id;
            $comment->commentable_id = $posts->random()->id;
            $comment->commentable_type = BlogPost::class;
            $comment->save();
        });

        Comment::factory($comments)->make()->each(function ($comment) use ($users) {
            $comment->user_id      = $users->random()->id;
            $comment->commentable_id = $users->random()->id;
            $comment->commentable_type = User::class;
            $comment->save();
        });
    }
}
