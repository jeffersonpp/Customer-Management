@extends('layouts.app')

@section('content')
<script>
function agendas_day(value){
    window.open('/agendas/day/'+value, '_self');
}
function agendas_week(value){
    window.open('/agendas/week/'+value, '_Self');
}
</script>
<style>
  .uper {
    margin-top: 40px;
  }
  .title{
    font-size:24px;
    color:cadetblue;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
<div class="title">{{$title}}</div>
  <table class="table table-striped">
    <thead>
        <tr>
          <td> &nbsp; </td>
          <td colspan="2"><a href="/agendas" >All</a></td>
          <td colspan="3"><input type="date" onchange="agendas_day(this.value)" style="width:190px;" class="form-control" placeholder="Day"></td>
          <td colspan="3"><input type="number" onchange="agendas_week(this.value)" style="width:190px;" class="form-control" placeholder="Week"></td>
        </tr>
        <tr>
          <td>Name</td>
          <td>Phone</td>
          <td>Address</td>
          <td>Date</td>
          <td>Hour</td>
          <td>Price</td>
          <td colspan="3">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($agendas as $agenda)
        <tr>
            <td>{{$agenda->name}}</td>
            <td>{{$agenda->phone}}</td>
            <td>{{$agenda->address}}</td>
            <td>{{ date('d F, Y (l)', strtotime($agenda->date))}}</td>
            <td>{{ date('H:i', strtotime($agenda->date))}}</td>
            <td>{{$agenda->price}}</td>
            <td><a href="{{ route('show_client',$agenda -> client_id)}}" class="btn btn-info">View Client</a></td>
            <td><a href="{{ route('edit_agenda',$agenda -> id)}}" class="btn btn-info">Edit</a></td>
            <td>
                <form action="{{ route('destroy_agenda', $agenda->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection