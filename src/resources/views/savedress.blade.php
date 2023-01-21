@extends('layout')

@section('title')Cохранение платьев@endsection

@section('main_content')
    <h1>Форма сохранения платьев</h1><br>
    <form action="/savedress/check" method="post">
        @csrf
{{--        <input type="email" name="email" id="email" placeholder="Введите email" class="form-control"><br>--}}
        <input type="text" name="title" id="title" placeholder="Введите название" class="form-control"><br>
        <textarea name="description" id="description" class="form-control" placeholder="Введите описание"></textarea><br>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection

