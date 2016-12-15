@extends('layout.master')

@section('title', 'Phản hồi')

@section('content')
    <section class="content-header">
        <h1>
            Phản hồi
            {{--<small>it all starts here</small>--}}
        </h1>
    </section>

<router-view></router-view>
@endsection

@push('script')
<script src="{{ asset('js/feedback.js') }}"></script>
@endpush