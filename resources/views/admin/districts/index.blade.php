@extends('layouts.admin.layouts.app')
@section('admin_content')
    <div class="container">
        <div class="columns">
            <div class="fake-offset w-100">
                <div class="flex-space-b header-block">
                    <h3>{{ __('Список районов') }}</h3>
                    <a href="javascript:void(0)" onclick="getModalAdmin('districts/show');" class="btn btn-add-project">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <span>{{ __('добавить район') }}</span>
                    </a>
                </div>
                <div class="block" id="tableData">
                    @include('admin.districts.table')
                </div>
            </div>
        </div>
    </div>
@endsection

