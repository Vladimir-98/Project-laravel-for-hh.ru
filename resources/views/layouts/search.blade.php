<div class="search">
    <div class="box">
        <form action="{{ route('search-projects') }}" method="GET">
            <input class="search_input" type="text" placeholder="@lang('main.search')" name="search" value="@if(isset($search)) {{ $search }}@endif">
            <button type="submit" class="btn btn-search" title="search"></button>
        </form>
    </div>
</div>
