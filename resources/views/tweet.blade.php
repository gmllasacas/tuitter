<!DOCTYPE html>
<html>
    @component('components.header')
        @slot('title')
            Create tweet
        @endslot
    @endcomponent
    <body>    
        <div class="container">
            @component('components.menu')
            @endcomponent

            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <form action="{{ route('tweets.store') }}" class='form-signin' id="" method="POST">
                <h2 class="form-signin-heading">Create tweet</h2>

                @csrf
                <div class="form-group">
                    <label for="textarea">Tweet (Max 280 chars.)</label>
                    <textarea class="form-control" name="body" id="textarea" cols="30" rows="10"></textarea>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Post</button>
            </form>

            @component('components.errors')
            @endcomponent

        </div>
    </body>

</html>