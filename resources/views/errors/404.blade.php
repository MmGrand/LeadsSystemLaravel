@extends('layouts.app')

@section('title',  __('The page not found'))

@section('content')
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center">
            <h1 class="display-1 fw-bold">404</h1>
            <p class="lead">
                {{ __('The page not found') }}.
            </p>
            <a href="{{ route('home') }}" class="btn btn-primary">{{ __('Go back to the main page') }}</a>
        </div>
    </div>
@endsection
