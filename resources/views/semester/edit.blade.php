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
    {!! Form::model($semester, ['route' => ['semesters.update',$semester->id], 'method' => 'PATCH']) !!}
    <div class="form-group">
        {!! Form::label('semester', 'Semester') !!}
        {!! Form::text('semester',($semester->semester), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('school_flow', 'Active') !!}
        @if($semester->active == 1)
            {!!Form::radio("active","1",true, ['class' => 'form-control']) !!}
            {!! Form::label('school_flow', 'Deactive') !!}
            {!!Form::radio("active","0",false, ['class' => 'form-control']) !!}
        @else
            {!!Form::radio("active","1",false, ['class' => 'form-control']) !!}
            {!! Form::label('school_flow', 'Deactive') !!}
            {!!Form::radio("active","0",true, ['class' => 'form-control']) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::textarea("desc", old("desc") ? old("desc") : (!empty($semester) ? $semester->desc : null),["class" => "form-control"]) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop