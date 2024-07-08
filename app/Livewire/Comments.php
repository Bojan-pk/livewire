<?php

namespace App\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Comments extends Component
{
    
    use WithPagination;
    use WithFileUploads;
    public $photo;
   /*  public $comments; */
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

        /* $this->comments->prepend($createdComment); */
        $this->newComment='';
        session()->flash('message','Uspesnoo ste dodali komentar');
    }

   /*  public function mount()
    {
      //dd($initialComments);
      $initialComments=Comment::latest()->get();
        $this->comments=$initialComments;
    } */

    public function remove ($commentId) {

        //dd($commentId);
        $comment=Comment::find($commentId)->delete();
        /* $this->comments=$this->comments->except($commentId); */
        session()->flash('message','Uspesnoo ste obrisali komentar');

    }

    public function render()
    {
        return view('livewire.comments', ['comments'=>Comment::latest()->paginate(2)]);
    }
}
