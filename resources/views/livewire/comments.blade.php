<div class="flex justify-center">
    <div class=" w-6/12">
        
        <h1>Comments</h1>
       
        <form  wire:submit.prevent="addComment">
            @error('newComment') <span class=" text-red-500 text-xs">{{ $message }}</span> @enderror
        <div class="my-4 flex">
            <input
                class="placeholder:italic  placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                placeholder="Dodaj nesto..." type="text"  wire:model.live.debounce.500ms='newComment'/>
            <div class="">
                <button type="submit" class="ml-5 mr-2 p-2 bg-blue-500 rounded shadow text-white" >Dodaj</button>
            </div>
        </div>
        @foreach ($comments as $comment)
            <div class=" rounded border shadow p-3 my-2">
                <div class="flex justify-start my-2">
                    <p class="font-bold text-lg">{{ $comment->creator->name}}</p>
                    <p class=" mx-3 py-1 text-xs text-gray-500 font-semibold">{{ @$comment->created_at->diffForHumans()}}</p>
                </div>
                <p class=" text-gray-500">{{ $comment->body }}</p>

            </div>
        @endforeach
    </form>
    </div>
</div>
