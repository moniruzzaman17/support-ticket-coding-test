
<div class="navbar-wrapper w-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a href="{{ route('admin.index') }}" class="navbar-brand">
                <img src="{{ asset('images/logo.png') }}" class="w-100" alt=""> 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse justify-content-end text-center" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="btn btn-outline-success"><i class="fas fa-home"></i>&nbsp;Home</a>
                    </li>
                    @auth('administrator')
                    <li class="nav-item ms-md-2 mt-2 mt-md-0">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" class="btn btn-outline-success" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>&nbsp;Logout
                        </a>
                    </li>                    
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</div>