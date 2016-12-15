<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        {{--todoHuy: làm lại cái này--}}
        <!-- Sidebar user panel -->
        {{--<div class="user-panel">--}}
            {{--<div class="pull-left image">--}}
                {{--<img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}
            {{--</div>--}}
            {{--<div class="pull-left info">--}}
                {{--<p>Alexander Pierce</p>--}}
                {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
            {{--</div>--}}
        {{--</div>--}}
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li><a href="{{ route('getCategory') }}"><i class="fa fa-adjust"></i><span>Thể Loại</span></a></li>
            <li><a href="{{ route('getPost') }}"><i class="fa fa-adjust"></i><span>Bài Viết</span></a></li>
            <li><a href="{{ route('getConfigInformation') }}"><i class="fa fa-adjust"></i><span>Thiết Lập Thông Tin Trang</span></a></li>
            <li><a href="{{ route('getConfigPersonal') }}"><i class="fa fa-adjust"></i><span>Thiết Lập Thông Tin Cá Nhân</span></a></li>
            <li><a href="{{ route('getFeedback') }}"><i class="fa fa-adjust"></i><span>Phản Hồi</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>