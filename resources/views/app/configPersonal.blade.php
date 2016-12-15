@extends('layout.master')

@section('title', 'Thiết lập thông tin cá nhân')

@section('content')
    <section class="content-header">
        <h1>
            Thiết Lập Thông Tin Cá Nhân
            {{--<small>it all starts here</small>--}}
        </h1>
    </section>
    <config></config>
@endsection

@push('script')
<script src="{{ asset('js/config-personal.js') }}"></script>
@endpush