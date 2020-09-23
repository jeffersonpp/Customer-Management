@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Phone</td>
          <td>Address</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$client->id}}</td>
            <td>{{$client->name}}</td>
            <td>{{$client->phone}}</td>
            <td>{{$client->address}}</td>

       <!---     
////////////////////////////// AGENDA
            //////////////////// PREFERENCIAS
            //////////////////// LIMPEZAS / OCORRENCIAS --????????
--------->
            <td><a href="{{ route('edit_client',$client->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('destroy_client', $client->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
    </tbody>
  </table>
<div>
@endsection