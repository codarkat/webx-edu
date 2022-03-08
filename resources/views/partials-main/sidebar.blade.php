<div class="app-sidebar">
    <div class="logo">
        <a href="index.html" class="logo-icon" style="background-image: url('{{asset('assets/images/mirea.png')}}')"><span class="logo-text"><strong>MIREA</strong>VN</span></a>
        <div class="sidebar-user-switcher user-activity-online">
            <a href="#">
                <img src="../../assets/images/avatars/avatar.png">
                <span class="activity-indicator"></span>
                <span class="user-info-text">Chloe<br><span class="user-state-info">On a call</span></span>
            </a>
        </div>
    </div>
    <div class="app-menu">
        <ul class="accordion-menu">
            <li>
                <a href="{{route('admin.dashboard')}}"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
            </li>
            <li>
                <a href="{{route('user.topics')}}"><i class="material-icons-two-tone">description</i>Kiểm tra</a>
            </li>
            <li>
                <a href=""><i class="material-icons-two-tone">emoji_events</i>Kết quả</a>
            </li>
            <li>
                <a href=""><i class="material-icons-two-tone">notifications_active</i>Thông báo<span class="badge rounded-pill badge-success float-end">14</span></a>
            </li>
            <li>
                <a href=""><i class="material-icons-two-tone">logout</i>Thoát</a>
            </li>
        </ul>
    </div>
</div>
