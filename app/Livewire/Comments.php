<?php

namespace App\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class Comments extends Component
{
    
    use WithPagination;
    use WithFileUploads;
    public $image;
   /*  public $comments; */
    public $title='';

    public $newComment;
    public $ticketId;

     protected $listeners=[
        'ticketSelected'=>'ticketSelected'
    ];
    
    public function ticketSelected($ticketId) {
        
        $this->ticketId=$ticketId;
    }

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
        $image=$this->storeImage(); 
        //dd($this->ticketId);
        $createdComment=Comment::create([
            'body'=>$this->newComment,
            'user_id'=>rand(1,3),
            'image'=>$image,
            'support_ticket_id'=>$this->ticketId,
        ]);

        /* $this->comments->prepend($createdComment); */
        $this->newComment='';
        $this->image='';
        session()->flash('message','Uspesnoo ste dodali komentar');
    }

   /*  public function mount()
    {
      //dd($initialComments);
      $initialComments=Comment::latest()->get();
        $this->comments=$initialComments;
    } */

    public function storeImage()
    {
        if(!$this->image) return null;

      $path=$this->image->store('public/photos');//snima fajl

      return basename($path);
      
        
    }

    public function remove ($commentId) {

        //dd($commentId);
        $comment=Comment::find($commentId)->delete();
        /* $this->comments=$this->comments->except($commentId); */
        session()->flash('message','Uspesnoo ste obrisali komentar');

    }

    public function render()
    {
        return view('livewire.comments', ['comments'=>Comment::where('support_ticket_id',$this->ticketId)->latest()->paginate(10)]);
    }
}
