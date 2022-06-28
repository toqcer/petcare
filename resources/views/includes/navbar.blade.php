<!-- Navbar -->
<div class="container-fluid">
    <nav class="row navbar navbar-expand-lg navbar-light bg-#F9F9F9">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ url('frontend/images/Logo.png') }}" alt="Logo PetCare">
        </a>
        <button class="navbar-toggler navbar-toggler-right"
            type="button"
            data-toggle="collapse"
            data-target="#navb">
                <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav ml-auto mr-3">
                <li class="nav-item mx-md-2">
                    <a href="#" class="nav-link active">Home</a>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="#popular" class="nav-link">Paket Sehat</a>
                </li>
                @auth
                    <li class="nav-item mx-md-2">
                        <a href="{{ route('my-order') }}" class="nav-link">My Order</a>
                    </li>
                @endauth
            </ul>

            @guest
                <!-- Mobile Button -->
                <form class="form-inline d-sm-block d-md-none">
                    <button class="btn btn-login my-2 my-sm-0 px-4" type="button"
                        onclick="event.preventDefault(); location.href='{{ url('login') }}';">
                        Masuk
                    </button>
                </form>

                <!-- Desktop Button -->
                <form class="form-inline my-2 my-lg-0 d-none d-md-block">
                    <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button"
                        onclick="event.preventDefault(); location.href='{{ url('login') }}';">
                        Masuk
                    </button>
                </form>
            @endguest

            @auth
                <!-- Mobile Button -->
                <form class="form-inline d-sm-block d-md-none" action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-login my-2 my-sm-0 px-4" type="submit">
                        Keluar
                    </button>
                </form>

                <!-- Desktop Button -->
                <form class="form-inline my-2 my-lg-0 d-none d-md-block" action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="submit">
                        Keluar
                    </button>
                </form>
            @endauth

        </div>
    </nav>
</div>