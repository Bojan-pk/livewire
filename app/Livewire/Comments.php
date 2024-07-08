<?php

namespace App\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $comments;
    public $title='';

    public $newComment;


    public function updated($field)
    {
        $this->validateOnly($field, [
            'newComment'=>'required|max:255'
        ]);
    }

    public function addComment()
    {
        $this->validate([
            'newComment'=>'required|max:255'
        ]);

        $createdComment=Comment::create([
            'body'=>$this->newComment,
            'user_id'=>1
        ]);

        $this->comments->prepend($createdComment);
        $this->newComment='';
    }

    public function mount()
    {
      //dd($initialComments);
      $initialComments=Comment::latest()->get();
        $this->comments=$initialComments;
    }

    public function render()
    {
        return view('livewire.comments', ['title1'=>$this->title]);
    }
}
