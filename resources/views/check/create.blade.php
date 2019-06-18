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
    {!! Form::open(['route' => 'checks.store']) !!}
    <div class="form-group">
        {!! Form::label('school_flow', 'Identification Number') !!}
        {!! Form::number('identification_number', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Check', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop