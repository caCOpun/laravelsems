@extends('app')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Subject</th>
            <th>active</th>
            <th>Description</th>
            <th colspan="2"><a href="{{ URL::route('subjects.create') }}" class="btn btn-primary btn-block">Create</a></th>
        </tr>
        </thead>
        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->id }}</td>
                <td>{{ $subject->subject }}</td>
                <td>
                    @if($subject->active == 1)
                        <span class="label label-info">Active</span>
                    @else
                        <span class="label label-danger">Deactive</span>
                    @endif
                </td>
                <td>{{ $subject->desc }}</td>
                <td width="80"><a class="btn btn-primary" href="{{ URL::route('subjects.edit', $subject->id) }}">Edit</a></td>
                <td width="80">{!! Form::open(['route' => ['subjects.update', $subject->id], 'method' => 'DELETE']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure?");']) !!}
                    {!!  Form::close() !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $subjects->render() !!}

@stop