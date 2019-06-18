@extends('app')

@section('content')

    <h3>Name</h3>
    <p>{{$student->name}}</p>

    <h3>Surname</h3>
    <p>{{$student->surname}}</p>

    <h3>id number(Leternjoftimi)</h3>
    <p>{{$student->identification_number}}</p>


    <h3>Age</h3>
    <p>{{$student->age}}</p>

    <h3>Gender</h3>
    <p>{{$student->gender}}</p>

    <h3>Birthday</h3>
    <p>{{$student->birthday}}</p>

    <h3>Description</h3>
    <p>{{$student->desc}}</p>

    <h3>Start study</h3>
    <p>{{$student->year}}</p>

    <h3>Semester</h3>
    <p>{{$student->semester}}</p>

    <h3>Create data</h3>
    <p>{{$student->created_at}}</p>


    {{--<table class="table">--}}
{{--<h1>Subject</h1>--}}
        {{--<tbody>--}}
        {{--@foreach($student->subjects as $s)--}}
            {{--<tr>--}}
                {{--<td> {{$s->subject}}</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
        {{--</tbody>--}}
    {{--</table>--}}

    <table class="table">
        <thead>
        <tr>
            <th>Subject</th>
            <th>Note</th>
            {{--<th colspan="2"><a href="{{ URL::route('students.create') }}" class="btn btn-primary btn-block">Create</a></th>--}}
        </tr>
        </thead>
        <tbody>
        {{--{{print_r($student->subjects)}}--}}
        @foreach($student->subjects as $s)
            <tr>
                <td>{{ $s->subject }}</td>
                <td>
                    @if($s->pivot->note == 0)
                        <span class="label label-danger">This student has no notes</span>
                    @else
                        <span class="label label-info">{{ $s->pivot->note }}</span>
                    @endif
                </td>
                <td width="80">
                    <a class="btn btn-success" href="{{ URL::route('students.addNote',['id'=>$s->id,'idStudent'=>$student->id]) }}">Note</a>
                </td>
                    {!!  Form::close() !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop