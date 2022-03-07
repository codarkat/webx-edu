<!DOCTYPE html>
<html lang="en">

@include('partials-main.head')

<body>
<div class="app align-content-stretch d-flex flex-wrap">
    @include('partials-main.sidebar')
    <div class="app-container">
        @include('partials-main.search')
        @include('partials-main.header')
        <div class="app-content">
            <div class="content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials-main.script')

</body>

</html>
