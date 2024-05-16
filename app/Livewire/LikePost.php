<?php

namespace App\Livewire;

use App\Models\Like;
use Livewire\Component;

class LikePost extends Component
{
    public mixed $post;
    public bool $isLiked;
    public $likeCount;

    public function mount($post = [])
    {
        $this->post = $post;
        $this->isLiked = $this->post->checkLikeAuthUser();
        $this->likeCount = $this->post->likes()->count();
    }

    public function like()
    {
       
        if ($this->isLiked) {
            $like = Like::where(['post_id' => $this->post->id, "user_id" => auth()->user()->id]);
            $like->delete();
            $this->isLiked = false;
            $this->likeCount--;
            return;
        }

        Like::create([
            "post_id" => $this->post->id,
            "user_id" => auth()->user()->id,
        ]);
        $this->isLiked = true;
        $this->likeCount++;
    }



    public function render()
    {
        return view('livewire.like-post');
    }
}
