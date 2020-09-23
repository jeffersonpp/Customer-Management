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
          <td>Name</td>
          <td>Phone</td>
          <td>Address</td>
          <td>Period</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{$client->name}}</td>
            <td>{{$client->phone}}</td>
            <td>{{$client->address}}</td>
            <td>{{$client->method}}</td>
            <td><a href="{{ route('show_client',$client->id)}}" class="btn btn-info">View</a></td>
            <td><a href="{{ route('edit_client',$client->id)}}" class="btn btn-primary">Edit</a></td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection