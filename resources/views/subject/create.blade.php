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
    {!! Form::open(['route' => 'subjects.store']) !!}
    <div class="form-group">
        {!! Form::label('subject', 'Subject') !!}
        {!! Form::text('subject', null, ['class' => 'form-control']) !!}
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            <label for="select" class=" form-control-label">Teacher</label>
        </div>
        <div class="col-12 col-md-10">
            <select name="teacher_id" class="form-control"required>
                @foreach($teachers as $teacher)
                    <option value="{{$teacher->id}}">{{$teacher->email}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('school_flow', 'Active') !!}
        {!!Form::radio("active","1",true, ['class' => 'form-control']) !!}
        {!! Form::label('school_flow', 'Deactive') !!}
        {!!Form::radio("active","0",false, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::textarea("desc", old("desc") ? old("desc") : (!empty($user) ? $user->description : null),["class" => "form-control"]) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop