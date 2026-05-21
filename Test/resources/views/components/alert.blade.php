
@if (session()->has($type))
    <div class="alert alert-{{$type}} alert-dismissible fade show"  >
        {{ session($type) }}
    </div>
@endif


