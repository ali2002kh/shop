@extends('admin.layouts.menu')

@section('title')
    Products
@endsection 

@section('content')
    <div class="container d-flex">
        <a href="{{ route('admin.createProduct') }}" class="btn btn-primary">new product</a>
    </div>
    <div class="container mt-2">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">name</th>
                <th scope="col">price</th>
                <th scope="col">sold</th>
                <th scope="col">category</th>
                <th scope="col">reccomended</th>
                <th scope="col">count</th>
                <th scope="col">handle</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->price }}</td>
                    <td>{{ $p->sold }}</td>
                    <td>{{ $p->category()->name }}</td>
                    <td>@if ($p->recommended) <i class="fa fa-check"></i> @endif</td>
                    <td>{{ $p->count }}</td>
                    <td>
                        <a href="{{ route('admin.editProduct', $p->id) }}" class="btn btn-dark"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('admin.deleteProduct', $p->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection