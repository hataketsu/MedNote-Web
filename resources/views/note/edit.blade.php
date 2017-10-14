@extends('default')
@section('title','Edit note')
@section('content')
    <div class="ui container segment">
        <h2 style="text-align: center">Edit</h2>
        <form action="/notes/{{$note->id}}" method="post" class="ui form">
            {{method_field('put')}}
            @include('note.fields')
            <p style="text-align: center">
                <input type="submit" value='Update' class="ui primary button">
            </p>
        </form>
    </div>
@endsection