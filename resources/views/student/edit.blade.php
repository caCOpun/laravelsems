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
    {!! Form::model($student, ['route' => ['students.update',$student->id], 'method' => 'PATCH']) !!}
    <div class="form-group">
        {!! Form::label('name', 'name') !!}
        {!! Form::text('name',($student->name), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('surname', 'Surname') !!}
        {!! Form::text('surname',($student->surname), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('idnumber', 'Identification Number') !!}
        {!! Form::text('identification_number',($student->identification_number), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('age', 'Age') !!}
        {!! Form::text('age',($student->age), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('gener', 'Gener') !!}
        <select name="gender" class="form-control select2-multi" required>
            <option value="{{$student->gender}}">{{$student->gender}}</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>
    <div class="form-group">
        {!! Form::label('birthday', 'birthday') !!}
        {!! Form::text('birthday',($student->birthday), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('school_flow', 'Active') !!}
        @if($student->active == 1)
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
        {!! Form::textarea("desc", old("desc") ? old("desc") : (!empty($student) ? $student->desc : null),["class" => "form-control"]) !!}
    </div>

    <div class="row form-group">
        <div class="col col-md-3">
            <label for="select" class=" form-control-label">Years of study</label>
        </div>
        <div class="col-12 col-md-10">
            <select name="year" class="form-control"required>
                <option value="{{$student->year}}">{{$student->year}}</option>
                @foreach($years as $year)
                    <option value="{{$year->school_flow}}">{{$year->school_flow}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row form-group">
        <div class="col col-md-3">
            <label for="select" class=" form-control-label">Semester</label>
        </div>
        <div class="col-12 col-md-10">
            <select name="semester" class="form-control"required>
                <option value="{{$student->semester}}">{{$student->semester}}</option>
                @foreach($semesters as $semester)
                    <option value="{{$semester->semester}}">{{$semester->semester}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="row form-group">
        <div class="col col-md-3">
            <label for="select" class=" form-control-label">Subjects</label>
        </div>
        <div class="col-12 col-md-10">
            <select name="subject[]" class="form-control select2-multi" multiple="multiple" required>
                @foreach($subjects as $subject)
                    <option value="{{$subject->id}}">{{$subject->subject}}</option>
                @endforeach
            </select>

        </div>
    </div>

    <div class="form-group">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop