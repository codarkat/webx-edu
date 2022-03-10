<div class="app-sidebar">
    <div class="logo">
        <a href="index.html" class="logo-icon" style="background-image: url('{{asset('public/assets/images/mirea.png')}}')"><span class="text-dark hidden-on-mobile">MIREAVN</span><strong class="text-danger hidden-on-mobile">EDUCATION</strong></a>
{{--        <div class="sidebar-user-switcher user-activity-online">--}}
{{--            <a href="#">--}}
{{--                <img src="https://www.mireavn.ru/data/images/upload/users/{{Auth::user()->image}}">--}}
{{--                <span class="activity-indicator"></span>--}}
{{--                <span class="user-info-text">{{ Auth::user()->name }}<br><span class="user-state-info">{{ Auth::user()->email }}</span></span>--}}
{{--            </a>--}}
{{--        </div>--}}
    </div>
    <div class="app-menu">
        <ul class="accordion-menu">
            <li>
                <a href="{{route('admin.dashboard')}}"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
            </li>
            <li>
                <a href="{{route('admin.list-results')}}"><i class="material-icons-two-tone">emoji_events</i>Kết quả</a>
            </li>
            <li>
                <a href="" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="material-icons-two-tone">logout</i>Thoát</a>
                <form id="logout-form" action="{{ route('admin.logout')}}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
{{--    <div class="clock text-dark text-center">--}}
{{--        <h1 id="clock" class="mt-3"></h1>--}}
{{--        <p class="">Thời gian làm bài</p>--}}
{{--    </div>--}}
</div>
