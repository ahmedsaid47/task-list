@extends('layouts.app')


@section('title')
    {{ $task->title }}
@endsection


@section('content')


<p>{{ $task->description }}</p>

@if( $task->long_description )
    <p>{{ $task->long_description }}</p>

@endif

@endsection
