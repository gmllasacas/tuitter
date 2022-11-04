<!DOCTYPE html>
<html>
    @component('components.header')
        @slot('title')
            Followers
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
                        <h3>Followers list</small></h3>
                    </div>

                    @foreach ($followers as $item)
                        <div class="card">
                            <p>
                                <a href="{{ route('index', ['id' => $item->user_id]) }}">{{ $item->name }}, {{ '@' . $item->username }}</a>
                                @if (!in_array($item->user_id, $followingUser))
                                    <a class="btn btn-info pull-right" href="{{ route('api.get.follow', ['id' => $item->user_id]) }}" role="button">Follow</a>
                                @endif
                            </p>
                        </div>
                    @endforeach
                    <div class="text-center">
                        {!! $followers->links() !!}
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </body>
</html>