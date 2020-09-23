@extends('layouts.app')
@section('scripts')
    @parent

@stop
@section('content')

<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container" style="max-width:100%;text-align:center;">
    <div class="card uper">
      <div class="card-header">
        Add Client
      </div>
      <div class="card-body">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div><br />
        @endif
          <form method="post" action="{{ route('update_agenda', $agenda->id) }}">
              <div class="form-group">
                  @csrf
                  <label for="name">Client:</label>
                  <select name="client_id" class="form-control">
                      <option>SELECT CLIENT</option>
                      @foreach ($clients as $client)
                      <option value="{{$client->id}}" 
                            @if( $client->id == $agenda->client_id)
                                selected 
                            @endif 
                            >{{$client->name}} - {{$client->phone}}</option>
                      @endforeach
                  </select>
              </div>

             <div class="form-group">
                  <label for="quantity">Date:</label>
                  <input type="datetime-local" class="form-control" name="date" value="{{ date('Y-m-d\TH:i:s', strtotime($agenda->date)) }}"/>
             </div>

              <button type="submit" class="btn btn-primary">Update Service</button>
          </form>
      </div>
    </div>
</div>
@endsection