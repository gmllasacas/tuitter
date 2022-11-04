<!DOCTYPE html>
<html>
    @component('components.header')
        @slot('title')
            Follow user
        @endslot
    @endcomponent
    <body>    
        <div class="container">
            @component('components.menu')
            @endcomponent

            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <form action="{{ route('api.followUsername') }}" class='form-signin' id="" method="POST">
                <h2 class="form-signin-heading">Follow user</h2>

                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Follow user</button>
            </form>

            @component('components.errors')
            @endcomponent

        </div>
    </body>

</html>