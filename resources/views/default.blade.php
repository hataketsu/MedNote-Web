<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="/semantic/dist/semantic.css"/>
    <script src="/bower/jquery/dist/jquery.js"></script>
    <script src="/semantic/dist/semantic.js"></script>
</head>
<body>
@include('.nav')
@yield('content')

<div class="ui footer segment">
    <div class="ui container">
            <p style="text-align: center">My hobby project @hataketsu</p>
    </div>
</div>

</body>
<form action="/notes/" method="post" hidden id="delete_form">
    {{csrf_field()}}
    {{method_field('delete')}}
</form>
<script>
    function confirm_delete(id) {
        if(confirm('Delete this note?')){
            $('#delete_form').attr('action','/notes/'+id);
            $('#delete_form').submit();
        }
    }
</script>
</html>