@extends('layouts.app')

@section('title', 'User Info')

@section('content')
    <head>
        <style>
            footer {
                position: fixed;
            }
        </style>
    </head>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h1>User Info</h1>
                <hr>
                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Created at:</strong> {{ Auth::user()->created_at->format('M d, Y') }}</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                <a href="{{ route('favorites.index') }}" class="btn btn-warning" style="color: #fff; border: 2px solid #fff;">Go to "My Favorites"</a>
            </div>
        </div>
    </div>
@endsection
