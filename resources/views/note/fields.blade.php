{{csrf_field()}}
@if($errors->count()>0)
    <div class="ui red segment">
        @foreach($errors->all() as $error)
            <p style="color: red">
                {{$error}}
            </p>

        @endforeach
    </div>
@endif

<div class="field">
    <label>Title</label>
    <input type="text" name="title" value="{{old('title',$note->title)}}">
</div>
<div class="field">
    <label>Content
    </label>
    <textarea type="text" name="content">{{old('content',$note->content)}}</textarea>
</div>
