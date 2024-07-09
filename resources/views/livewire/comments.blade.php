<div>
    <h1 class=" text-3xl mb-2">Comments</h1>
    @if ($image)
    image Preview:
    <img src="{{ $image->temporaryUrl() }}" width="100px">
    @endif
    <form wire:submit.prevent="addComment">

        <input type="file" wire:model="image">
        @error('image') <span class="error">{{ $message }}</span> @enderror
        <div>
            @error('newComment') <span class=" text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
            @if (session()->has('message'))
            <div class="p-3 bg-green-300 text-green-800 rounded shadow-sm ">
                {{ session('message') }}
            </div>
            @endif
        </div>
        <div class="my-4 flex" >
            <input class="placeholder:italic  placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Dodaj nesto..." type="text" wire:model.live.debounce.500ms='newComment' />
            <div class="">
                <button type="submit" class="ml-5 mr-2 p-2 bg-blue-500 rounded shadow text-white">Dodaj</button>
            </div>
        </div>
        @foreach ($comments as $comment)
        <div class=" rounded border shadow p-3 my-2">
            <div class="flex justify-between my-2">
                <div class="flex">
                    <p class="font-bold text-lg">{{ $comment->creator->name}}</p>
                    <p class=" mx-3 py-1 text-xs text-gray-500 font-semibold">{{ @$comment->created_at->diffForHumans()}}</p>
                </div>
                <span class="text-red-200 hover:text-red-600 cursor-pointer" wire:click="remove({{$comment->id}})">x</span>
            </div>
            <p class=" text-gray-500">{{ $comment->body }}</p>
            @if ($comment->image)
            <img src="{{ asset('storage/photos/'.$comment->image)}}" alt="aa" width="100px">
            @endif

        </div>
        @endforeach
        {{$comments->links()}}
    </form>
</div>