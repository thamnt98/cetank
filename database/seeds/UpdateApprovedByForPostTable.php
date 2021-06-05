<?php

use App\Models\Post;
use Illuminate\Database\Seeder;

class UpdateApprovedByForPostTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::where('status', 1)->whereNotNull('user_id')->get();
        foreach($posts as $post ){
            Post::where('id', $post->id)->update(['approved_by' => $post->user_id]);
        }
    }
}
