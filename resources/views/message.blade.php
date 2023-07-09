@if (session()->has('message') || session()->has('status'))
    <div class="alert alert-{{ session()->get('type') }} mb-4" role="alert"> 
        <i class="flaticon-cancel-12 close" data-dismiss="alert"></i> 
        {{ session()->get('message') }}
    </div>
@endif

@if ($errors->count() > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif