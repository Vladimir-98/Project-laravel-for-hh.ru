@extends('layouts.admin.layouts.app')
@section('admin_content')
    <div class="container">
        <div class="columns">
            <div class="fake-offset w-100">
                <div class="flex-space-b header-block">
                    <h3>{{ __('Отзывы') }}</h3>
                </div>
                <div class="block" id="tableData">
                    @include('admin.reviews.table')
                </div>
            </div>
        </div>
    </div>
@endsection

