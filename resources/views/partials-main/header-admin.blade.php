<div class="app-header">
    <nav class="navbar navbar-light navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-nav" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="material-icons">first_page</i></a>
                    </li>
                    <li class="nav-item hidden-on-mobile">
                        <a class="nav-link"><strong>MES</strong> (Mirea Education System) <span class="badge badge-style-light rounded-pill badge-info">BETA</span></a>
                    </li>
                </ul>

            </div>
            <div class="d-flex">
                <ul class="navbar-nav">
                    <li class="nav-item hidden-on-mobile">
                        <a class="nav-link" href="#">{{Auth::user()->email}}</a>
                    </li>
                    <li class="navbar-nav">
                        <a class="nav-link text-dark hidden-on-mobile"><strong>{{Auth::user()->name}}</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link language-dropdown-toggle" href="#" id="languageDropDown" data-bs-toggle="dropdown">
                            <img class="avatar avatar-rounded" src="{{asset('public/assets/images/mirea.png')}}" alt=""></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
