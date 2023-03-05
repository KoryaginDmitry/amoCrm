@extends('layouts.main')

@section('title', 'Список сделок')

@section('content')
    <!-- Отображаю самый минимум данных, можно добавить еще -->
    @foreach($leads as $lead)
        id - {{ $lead->amo_crm_id  }}
        price - {{ $lead->price  }}
        <br>
    @endforeach

    <form action="{{ route('deal.Update') }}" method="POST">
        @csrf
        <input type="submit" value="Обновить">
    </form>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <input type="submit" value="Выход">
    </form>
@endsection
