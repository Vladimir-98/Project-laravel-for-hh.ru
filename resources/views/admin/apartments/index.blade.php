@extends('layouts.admin.layouts.app')
@section('admin_content')
    <div class="container">
        <div class="columns">
            <div class="fake-offset w-100">
                <div class="flex-space-b header-block">
                    <h3>{{ __('Список квартиры') }}</h3>
                    <a href="javascript:void(0)" onclick="getModalAdmin('apartments/show');"
                       class="btn btn-add-project">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <span>{{ __('добавить квартиру') }}</span>
                    </a>
                </div>
                <div class="block" id="tableData">
                    @include('admin.apartments.table')
                </div>
            </div>
        </div>
    </div>
@endsection

