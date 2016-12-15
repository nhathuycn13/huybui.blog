@extends('layout.user')
@section('title', 'Trang Chủ')

@section('content')
    <div class="single">
        <div class="container">
            <div class="col-md-8 single-main">
                <div class="single-grid">
                    <img src="{{ $post->thumbnail }}" alt=""/>
                    {!! $post->content !!}
                </div>
                <ul class="comment-list">
                    <h5 class="post-author_head">Đăng bởi <a href="#" title="Posts by admin" rel="author">{{ $post->user->name }}</a></h5>
                    <li><img src="{{ $post->user->thumbnail }}" class="img-responsive" alt="">
                        <div class="desc">
                            <p>Xem bài đăng của : <a href="#" title="Posts by admin" rel="author">{{ $post->user->name }}</a></p>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                </ul>
                <div class="content-form">
                    <h3>Bình luận</h3>
                    <form>
                        <input type="text" placeholder="Tên *" required/>
                        <input type="text" placeholder="Email *" required/>
                        <input type="text" placeholder="Điện thoại" required/>
                        <textarea placeholder="Lời bình luận"></textarea>
                        <input type="submit" value="Đồng Ý"/>
                    </form>
                </div>
            </div>

            @include('user.rightBar')
            <div class="clearfix"></div>
        </div>
        </div>
    </div>
@endsection