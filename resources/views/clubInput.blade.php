@extends('layouts.app')

@section('content')
    <h1>Input Klub</h1>
    <form action="/" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama Klub</label>
            <input type="text" class="form-control" id="name" aria-describedby="name" name="name">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Kota Klub</label>
            <input type="text" class="form-control" id="city" aria-describedby="city" name="city">
            @error('city')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
