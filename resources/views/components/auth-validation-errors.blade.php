@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="title">
            @lang('auth.oops')
        </div>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
