@extends('layout.master')

@section('title', 'Thể Loại')

@section('content')
    <section class="content-header">
        <h1>
            Thể Loại
            {{--<small>it all starts here</small>--}}
        </h1>
    </section>

<router-view></router-view>
@endsection

@push('script')
<script src="{{ asset('js/category.js') }}"></script>
@endpush