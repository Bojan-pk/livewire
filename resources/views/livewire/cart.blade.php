<div>
   <h2>Posao</h2>
   @if ($jobsIds)
    @foreach ($jobsIds as $jobId)
        {{$jobId}}
    @endforeach
   @endif
</div>
