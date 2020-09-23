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
          <td colspan="4">Action</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$client->id}}</td>
            <td>{{$client->name}}</td>
            <td>{{$client->phone}}</td>
            <td>{{$client->address}}</td>

            <td><a href="{{ route('edit_client',$client->id)}}" class="btn btn-primary">Edit</a></td>
            <td colspan="2"><a href="{{ route('new_preference',$client->id)}}" class="btn btn-primary">Add Preference</a></td>
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

    
      <table class="table table-striped">
    <thead>
        <tr>
          <td colspan="2">Preferences</td>
        </tr>
    </thead>
    <tbody>
        @foreach($preferences as $preference)
        <tr>
            <td>{{date('d/m/Y', strtotime($preference->date))}}</td>
            <td>{{$preference->title}}</td>
            <td>{{$preference->text}}</td>
        </tr>
        @endforeach
     </tbody>
    </table>
    <table class="table table-striped">
    <thead>
        <tr>
          <td>All Services</td>
        </tr>
    </thead>
    <tbody>
        @foreach($agendas as $agenda)
        <tr>
            <td>{{ date('d F, Y (l)', strtotime($agenda->date))}}</td>
            <td>{{ date('H:i', strtotime($agenda->date))}}</td>
        </tr>
        @endforeach
     </tbody>
    </table>
<div>
@endsection