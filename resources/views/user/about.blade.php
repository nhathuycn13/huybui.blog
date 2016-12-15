@extends('layout.user')
@section('title', 'Trang Chủ')

@section('content')
    <div class="about-content">
        <div class="container">
            <h2>Một Vài Điều Về Tôi</h2>
            <div class="about-section">
                <div class="about-grid">
                    <h3>Về bản thân</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including
                        versions of Lorem Ipsum.</p>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages
                        and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                </div>
                <div class="who-iam">
                    <h3>Chủ đề của blog</h3>
                    <div class="man-info">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. </p>
                        <h4>Some facts about me.</h4>
                        <li>Nullam at turpis a orci pretium pharetra.</li>
                        <li>Curabitur tincidunt purus mollis facilisis placerat.</li>
                        <li>Mauris a nulla ac est tincidunt interdum.</li>
                        <li>Pellentesque vel enim nec urna imperdiet mollis.</li>
                        <li>Integer interdum risus et scelerisque volutpat.</li>
                    </div>
                    <div class="man-pic">
                        <img class="img-thumbnail" src="https://scontent-sit4-1.xx.fbcdn.net/v/t1.0-9/13938553_693272027488068_2684978527911506280_n.jpg?oh=f17b9d2aa2b5f39dc47faa9218768214&oe=58B91483" alt=""/>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('bottomInclude')
<script !src="">
    $(document).ready(function(){
        $('#about').addClass('active');
    });
</script>
@endpush