@if (Auth::user()->id != $user->id)
    @if (Auth::user()->is_favorite($micropost->id))
        {!! Form::open(['route' => ['user.delete_favorite', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('Delete Favorite', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.add_favorite', $micropost->id]]) !!}
            {!! Form::submit('Add Favorite', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif