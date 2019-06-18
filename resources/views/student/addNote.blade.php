@extends('app')

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['route' => 'students.addNote']) !!}

    <input type="hidden" name="id" value="{{ Request::segment(3) }}">
    <input type="hidden" name="idStudent" value="{{ Request::segment(5) }}">

    <div class="form-group">
        {!! Form::label('idnumber', 'Note') !!}
        <select name="note" class="form-control select2-multi" required>
            <option value="0">Reject</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
    </div>
    <div class="form-group">
        {!! Form::submit('Add note', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop