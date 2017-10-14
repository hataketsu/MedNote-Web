@extends('default')

@section('title','All notes')

@section('content')
    <div class="ui container">
        <h1 class="ui centered header">MedNote - Noting system</h1>
        <div class="ui grid">
            <div class="ui two wide column"></div>
            <div class="ui twelve wide column">
                <form class="ui fluid massive labeled icon input" action="/notes/search" method="post">
                    {{csrf_field()}}
                    <i class="search icon"></i>
                    <input name="query" placeholder="Search whatever...">
                </form>
            </div>
        </div>

        @if(isset($delta))
            <p style="text-align: center">{{$notes->total()}} results in {{$delta}} microsecond</p>
        @endif
        <div class="ui two column doubling stackable grid ">
            @foreach($notes as $note)
                <div class="column">
                    <div class="ui  segment">
                        <h3><a href="/notes/{{$note->id}}">{{$note->title}}</a></h3>
                        <p>
                            <div class="ui label">Updated:<div class="detail"> {{$note->updated_at}}</div></div>
                            <a href="/notes/{{$note->id}}/edit" class="ui blue label"><i class="pencil icon"></i>
                                Edit</a>
                            <a  class="ui red label" onclick="confirm_delete({{$note->id}})"><i
                                        class="remove icon"></i> Detele</a>
                        </p>
                        <p style="white-space: pre-wrap">{{$note->content}}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <p>{{$notes->links()}}</p>
    </div>
@endsection

