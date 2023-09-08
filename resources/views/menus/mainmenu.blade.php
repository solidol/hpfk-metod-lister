@if (Auth::user())
    @include('menus.main_user')
@else
    @include('menus.main_guest')
@endif