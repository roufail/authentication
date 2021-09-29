@if (Session::has('success'))
    <div class="callout callout-success">
        <h5>{{ Session::get('success') }}</h5>
    </div>
@endif


@if ($errors->any())
    <div class="callout callout-error">
        @foreach ($errors->all() as $error)
            <h5>{{ $error }}</h5>
        @endforeach
    </div>
@endif
