<!DOCTYPE html>
<html>
    @component('components.header')
        @slot('title')
            Login
        @endslot
    @endcomponent
    <body>    
        <div class="container">
            <form action="{{ route('api.login') }}" class='form-signin' id="form" method="POST">
                <h2 class="form-signin-heading">Log in</h2>

                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>

            @component('components.errors')
            @endcomponent

        </div>
    </body>

</html>