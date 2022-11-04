<!DOCTYPE html>
<html>
    @component('components.header')
        @slot('title')
            Home
        @endslot
    @endcomponent
    <body>
        <div class="container">
            @component('components.menu')
            @endcomponent

            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            @component('components.errors')
            @endcomponent

            <div class="row marketing">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="jumbotron">
                        <h3>{{ $user->name }} <small>{{ '@' . $user->username }}</small></h3>
                        <p>
                            <a href="{{ route('following', ['id' => $user->id]) }}">{{ $user->following->count() }} following</a> | <a href="{{ route('followers', ['id' => $user->id]) }}">{{ $user->followers->count() }} followers</a>
                        </p>
                        <p>
                        @if ( Session::has('user') && !in_array($user->id, $followingUser) )
                            <a class="btn btn-info" href="{{ route('api.get.follow', ['id' => $user->id]) }}" role="button">Follow</a>
                        @endif
                        @if ( Session::has('user') && Session::get('user.id') == $user->id )
                            <a class="btn btn-success" href="{{ route('tweet', ['id' => $user->id]) }}" role="button">Create tweet</a>
                        @endif
                        </p>
                    </div>

                    @foreach ($feed as $item)
                        <div class="card">
                            <p><a href="{{ route('index', ['id' => $item->user->id]) }}">{{ $item->user->name }}, {{ '@' . $item->user->username }}</a> - {{ $item->created_at }}</p>
                            <p>{{ $item->body }}</p>
                        </div>
                    @endforeach
                    <div class="text-center">
                        {!! $feed->links() !!}
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>

        </div>
    </body>
</html>