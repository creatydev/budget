@extends('layout')

@section('title', $earning->description)

@section('body')
    <div class="wrapper my-3">
        <h2>{{ $earning->description }}</h2>
        <div class="box mt-3">
            <div class="box__section">
                Hello world
            </div>
        </div>
        @include('partials.attachments', ['payload' => $earning])
    </div>
@endsection
