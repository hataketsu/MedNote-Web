@extends('default')
@section('title','Create new note')
@section('content')
    <div class="ui container segment">
        <h2 style="text-align: center">Edit</h2>
        <form action="/notes" method="post" class="ui form">
            @include('note.fields')
            <p style="text-align: center">
                <input type="submit" value='Save new' class="ui primary button">
            </p>
        </form>
    </div>
@endsection