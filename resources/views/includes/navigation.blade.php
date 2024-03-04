<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand {{ Request::path() ==  '/' ? 'active' : '' }}" href="{{ url('/') }}" href="/">Weather Forecast</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() ==  '/' ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() ==  'about' ? 'active' : '' }}" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() ==  'prognoses' ? 'active' : '' }}" href="/prognoses">Prognoses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() ==  'contact' ? 'active' : '' }}" href="/contact">Contact</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
