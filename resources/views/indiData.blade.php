@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <td>By(Username)</td>
                    <td>Title</td>
                    <td>Description</td>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                    <tr>
                        <td>{{$d->user->name}}</td>
                        <td>{{$d->id}}</td>
                        <td>{{$d->title}}</td>
                        <td>{{$d->description}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection