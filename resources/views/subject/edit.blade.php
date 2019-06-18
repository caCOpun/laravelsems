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
    {!! Form::model($subject, ['route' => ['subjects.update',$subject->id], 'method' => 'PATCH']) !!}
    <div class="form-group">
        {!! Form::label('school_flow', 'School Flow') !!}
        {!! Form::text('subject',($subject->subject), ['class' => 'form-control']) !!}
    </div>

    <div class="row form-group">
        <div class="col col-md-3">
            <label for="select" class=" form-control-label">Teacher</label>
        </div>
        <div class="col-12 col-md-10">
            <select name="teacher_id" class="form-control"required>
                 <option value="{{$subject->id}}">teacher-default</option>
                @foreach($teachers as $teacher)
                    <option value="{{$teacher->id}}">{{$teacher->email}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('school_flow', 'Active') !!}
        @if($subject->active == 1)
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
        {!! Form::textarea("desc", old("desc") ? old("desc") : (!empty($subject) ? $subject->desc : null),["class" => "form-control"]) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop
