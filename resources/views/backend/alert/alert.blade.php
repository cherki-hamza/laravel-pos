@if($message = Session::get('success'))
<div class="my-2 alert alert-success">

    <strong>{{$message}}</strong>

</div>


@elseif($message = Session::get('danger'))
<div class="my-2 alert alert-danger">
    <strong>{{$message}}</strong>

</div>

@elseif($message = Session::get('warning'))
<div class="my-2 alert alert-warning">
    <strong>{{$message}}</strong>

</div>

@elseif($message = Session::get('info'))
<div class="my-2 alert alert-info">
    <strong>{{$message}}</strong>

</div>

@elseif($message = Session::get('twitter'))
<div class="btn btn-block btn-social btn-twitter">
    <strong>{{$message}}</strong>

</div>

@elseif($message = Session::get('darck'))
<div class="my-2 alert alert-darck">
    <strong>{{$message}}</strong>

</div>
@endif
