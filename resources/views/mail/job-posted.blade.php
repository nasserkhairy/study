<h2>
    {{ $job?->title }}
    {{ $name }}
</h2>
<p>congrates! your job is now live on our website.</p>

<p>
    <a href="{{ url('/jobs/'.$job?->id) }}">view your job listing</a>
</p>