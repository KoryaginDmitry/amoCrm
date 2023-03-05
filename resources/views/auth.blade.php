@extends('layouts.main')

@section('title', 'Авторизация')

@section('content')
    <form action="{{ route('auth.code') }}" method="POST">
        @csrf
        @error('code')
            <p>{{ $message  }}</p>
        @enderror
        <label>
            <input type="text" name="code" placeholder="Введите код авторизации">
        </label><br>
        <input type="submit" value="Авторизоваться через код авторизации">
    </form>
@endsection
