@extends('layout')

@section('title', $spending->description)

@section('body')
    <div class="wrapper my-3">
        <h2>{{ $spending->description }}</h2>
        <div class="box mt-3">
            <div class="box__section">
                Hello world
            </div>
        </div>
    </div>
@endsection
