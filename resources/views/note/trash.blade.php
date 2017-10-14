@extends('default')

@section('title','All notes')

@section('content')
    <div class="ui container">
        <h1 class="ui centered header">MedNote - Noting system -Trash</h1>

        @if(isset($delta))
            <p style="text-align: center">{{$notes->total()}} results in {{$delta}} microsecond</p>
        @endif
        <div class="ui two column doubling stackable grid ">
            @foreach($notes as $note)
                <div class="column">
                    <div class="ui  segment">
                        <h3><a href="/notes/{{$note->id}}">{{$note->title}}</a></h3>
                        <p>
                        <div class="ui label">Updated:
                            <div class="detail"> {{$note->updated_at}}</div>
                        </div>
                        <a href="/trash/restore/{{$note->id}}" class="ui blue label"><i class="refresh icon"></i>
                            Restore</a>
                        <a class="ui red label" href="/trash/delete/{{$note->id}}"><i
                                    class="remove icon"></i> Detele</a>
                        <p style="white-space: pre-wrap">{{$note->content}}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <p>{{$notes->links()}}</p>
    </div>
@endsection

