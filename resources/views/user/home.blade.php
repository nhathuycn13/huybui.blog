@extends('layout.user')
@section('title', 'Trang Chủ')

@section('content')
    <div class="content">
        <div class="container">
            <div class="content-grids">
                <div class="col-md-8 content-main">
                    <div class="content-grid">
                        <?php
                        \Carbon\Carbon::setLocale('vi')
                        ?>
                        @foreach($posts as $post)
                        <div class="content-grid-info">
                            <img src="{{ $post->thumbnail }}" alt=""/>
                            <div class="post-info">
                                <h4><a href="{{ route('post', $post->slug) }}">{{ $post->title }}</a>  {{ $post->created_at->diffForHumans() }}</h4>
                                <p>{{ $post->intro }}</p>
                                <a href="{{ route('post', $post->slug) }}"><span></span>Đọc tiếp</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {!! $posts->links() !!}
                </div>
                @include('user.rightBar')
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection

@push('bottomInclude')
<script !src="">
    $(document).ready(function(){
        $('#home').addClass('active');
    });
</script>
@endpush
