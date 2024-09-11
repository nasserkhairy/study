<x-layout>
    <x-slot:heading>
        jobs Page
    </x-slot:heading>
    <div class="space-y-4" >
 @foreach ($jobs as $job)
    
      
     <a href=" jobs/{{ $job['id']  }}" class="block  px-4 py-6 border border-gray-200 rounded-lg" >
        <div class="font-bold text-blue-500 text-sm" >{{ $job->employer->name }}</div>
        {{-- <div class="font-bold text-blue-500 text-sm" >{{ $job->employer>user_id }}</div> --}}
        <div>
           <strong>{{ $job['title']  }}: {{ $job['salary']  }} per year.</strong> 
        </div>
     </a>
        
@endforeach
    </div>
    <div>
       
        {{ $jobs->links() }}
    </div>
   
</x-layout>