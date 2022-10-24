@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-around gap-2">
    @forelse ($notes as $note)
        <div class="card border border-2 shadow p-3"
            style="background-color: {{$user->color}};">
            <div class="card-header">{{$note->title}}</div>
            <div class="card-body">{{$note->content}}</div>
        </div>
    @empty
        <div class=" alert alert-danger">
            Nenhuma anotação cadastradas!
        </div>
    @endforelse
@endsection
