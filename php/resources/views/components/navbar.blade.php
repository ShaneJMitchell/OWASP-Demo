<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="color: #4040409c; font-weight: bold; text-shadow: #fffffb7a 1px 1px 1px;">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/owasplogo.png') }}" alt="OWASP" style="max-height: 65px;"/></a>
        <a class="navbar-brand" href="{{ url('/') }}">Dev Box</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="/">Home</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('boxes') }}">Boxes</a>
                </li>
                {{--<li class="nav-item dropdown">--}}
                    {{--<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>--}}
                    {{--<div class="dropdown-menu" aria-labelledby="dropdown01">--}}
                        {{--<a class="dropdown-item" href="#">Link</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                <!-- Spacing between nav and login/logout sections-->
                <li style="width: 25px; height: 100%;"></li>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Join</a>
                    </li>
                    <li class="nav-item pt-2">
                        or
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    @if(\Illuminate\Support\Facades\Auth::user()->admin)
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Manage Boxes
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('items') }}">Items</a>
                                <a class="dropdown-item" href="{{ route('item') }}">Create Item</a>
                                <a class="dropdown-item" href="{{ route('manage_boxes') }}">Boxes</a>
                                <a class="dropdown-item" href="{{ route('create_boxes') }}">Create Box</a>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                            <a class="dropdown-item" href="{{ route('payment_info') }}">Payment Info</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
