<x-layout>
    <x-slot:heading>
      Job Details
    </x-slot:heading>


 <h1 class="font-bold text-lg" > {{ $job->title}}</h1>
 <p>
  this job pays {{ $job->salary}} per year
  </p>
  @can('edit',$job)
  <p class="mt-6" >
    <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
   </p>
  @endcan

</x-layout>