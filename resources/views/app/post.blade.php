@extends('layout.master')

@section('title', 'Bài Viết')

@section('content')
    <section class="content-header">
        <h1>
            Bài Viết
            {{--<small>it all starts here</small>--}}
        </h1>
    </section>

<router-view></router-view>
@endsection

@push('script')
<script src="{{ asset('js/post.js') }}"></script>
@endpush