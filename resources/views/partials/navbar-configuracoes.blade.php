<!-- resources/views/partials/navbar.blade.php -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Request::is('clinica*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('clinica.index') }}">Clinica <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {{ Request::is('convenios*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('convenios.index') }}">Convenios</a>
            </li>
            <li class="nav-item {{ Request::is('procedimentos*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('procedimentos.index') }}">Procedimentos</a>
            </li>
        </ul>
    </div>
</nav>