<!DOCTYPE html>
<html>
    @component('components.header')
        @slot('title')
            Following
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
                        <h3>Following list</small></h3>
                        @if (Session::has('user'))
                            <p><a class="btn btn-info" href="{{ route('follow') }}" role="button">Follow another user</a></p>
                        @endif
                    </div>

                    @foreach ($following as $item)
                        <div class="card">
                            <p>
                                <a href="{{ route('index', ['id' => $item->followed_id]) }}">{{ $item->name }}, {{ '@' . $item->username }}</a>
                                @if (!in_array($item->followed_id, $followingUser))
                                    <a class="btn btn-info pull-right" href="#" role="button">Follow</a>
                                @endif
                            </p>
                        </div>
                    @endforeach
                    <div class="text-center">
                        {!! $following->links() !!}
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </body>
</html>