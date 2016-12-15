@extends('layout.master')

@section('title', 'Thiết lập thông tin chung')

@section('content')
    <section class="content-header">
        <h1>
            Thiết Lập Thông Tin Chung
        </h1>
    </section>
    <config></config>
@endsection

@push('script')
<script src="{{ asset('js/config-information.js') }}"></script>
@endpush