@extends('layout.app')

@section('contents')
    <h1>{{ $Event->title}}</h1>
    @include('layout._errors')
        <div class="form-group">
            <label><h3>报名人如下:</h3></label>
            @foreach($event_members as $event_member)
            <input type="text" name="title" class="form-control" value="{{ $event_member->users->name }}">
            @endforeach
        </div>
        {{ csrf_field() }}
    @stop