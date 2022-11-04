<div class="header clearfix">
    <nav>
        <ul class="nav nav-pills pull-right">
            @if (Session::has('user'))
            <li role="presentation" class="text-danger"><a href="{{ route('logout') }}">Logout</a></li>
            <li role="presentation" class="active">
                <a>{{ Session::get('user.username')}}</a>
            @endif
            </li>
        </ul>
    </nav>
    <h3 class="text-muted"><a href="{{ route('index', ['id' => Session::get('user.id')]) }}">Home</a></h3>
</div>