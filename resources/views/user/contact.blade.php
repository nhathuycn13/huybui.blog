@extends('layout.user')
@section('title', 'Liên Hệ')

@section('content')
    <div class="contact-content" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="container">
            <div class="contact-info">
                <h2>Liên Hệ</h2>
                <p>Tôi viết blog này với mục đích nâng cao khả năng diễn dạt, trình bày vấn đề, cũng như chia sẻ kinh nghiệm và kiến thức cho mọi người. Mọi comment góp ý hay ném đá, miễn là ko mang tính xúc phạm, đều được hoan nghênh.</p>
            </div>
            <div class="contact-details">
                <form @submit.prevent="doFeedback">
                    <input type="text" placeholder="Tên *" v-model="form.$fields.name"/>
                    <input type="text" placeholder="Email *" v-model="form.$fields.email"/>
                    <input type="text" placeholder="Điện thoại" v-model="form.$fields.phone"/>
                    <input type="text" placeholder="Địa chỉ" v-model="form.$fields.address"/>
                    <textarea placeholder="Lời nhắn" v-model="form.$fields.message"></textarea>
                    <input type="submit" value="Gửi"/>
                </form>
            </div>
            <div class="contact-details">
                <div class="col-md-6 contact-map">
                    <h4>Địa chỉ</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d803187.8113675824!2d-120.11910914056458!3d38.15292455846902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb9fe5f285e3d%3A0x8b5109a227086f55!2sCalifornia%2C+USA!5e0!3m2!1sen!2sin!4v1423829283333" frameborder="0" style="border:0"></iframe>
                </div>
                <div class="col-md-6 company_address">
                    <h4>Liên Lạc</h4>
                    <p>{{ $config->address }}</p>
                    @if($config->phone)<p>Điện thoại: {{ $config->phone }}</p>@endif
                    <p>Email: <a href="mailto:{{ $config->email }}">{{ $config->email }}</a></p>
                    <p>Theo dõi:
                        @if($config->facebook)<a href="{{ $config->facebook }}">Facebook</a>@endif
                        @if($config->instagram)<a href="{{ $config->instagram }}">Instagram</a>@endif
                        @if($config->github)<a href="{{ $config->github }}">Github</a>@endif
                </div>
                <div class="clearfix"></div>
            </div>


        </div>
    </div>
    </div>
@endsection
@push('bottomInclude')
<script src="{{ asset('js/contact.js') }}"></script>
<script !src="">
    $(document).ready(function(){
        $('#contact').addClass('active');
    });
</script>
@endpush
