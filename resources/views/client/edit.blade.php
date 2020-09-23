@extends('layouts.app')
@section('scripts')
    @parent

@stop
@section('content')


<script src='https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css' rel='stylesheet' />

    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.2.0/mapbox-gl-geocoder.min.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.2.0/mapbox-gl-geocoder.css' type='text/css' />



<style>
  .uper {
    margin-top: 40px;
  }
</style>

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
      <form method="post" action="{{ route('update_client', $client->id) }}">
          <div class="form-group">
              @csrf
              <label for="name">Name:</label>
              <input type="text" class="form-control" name="name"  value="{{$client->name}}"/>
          </div>
        
          <div id="map_show" style="width:100%;height:300px; ">
                <input type="hidden"  id="latlong" name="latlong" value="{{$client->latlong}}"/>
                <input type="hidden"  id="city" name="city" value="{{$client->city}}" />
                <input type="hidden"  id="address"  name="address" value="{{$client->address}}" />
          </div>
          
         <div class="form-group">
              <label for="quantity">Phone:</label>
              <input type="text" class="form-control" name="phone" value="{{$client->phone}}"/>
          </div>
          <div class="form-group">
              <label for="quantity">Email:</label>
              <input type="text" class="form-control" name="email" value="{{$client->email}}"/>
          </div>
          <div class="form-group">
              <label for="quantity">Price:</label>
              <input type="text" class="form-control" name="price" value="{{$client->price}}"/>
          </div>
          <div class="form-group">
              <select class="form-control" name="method">
                  <option>Select</option>
                  <option value='daily'   @if($client->method=='daily') selected @endif>Daily</option>
                  <option value='weekly'  @if($client->method=='weekly') selected @endif>Weekly</option>
                  <option value='biweekly'@if($client->method=='biweekly') selected @endif>Biweekly</option>
                  <option value='monthly' @if($client->method=='monthly') selected @endif>Monthly</option>
                  <option value='custom'  @if($client->method=='custom') selected @endif>Custom</option>
              </select>
          </div>     
          
          <button type="submit" class="btn btn-primary">Edit Client</button>
      </form>
  </div>
</div>


<script>
  const mapbox_token = "{{env('MAPBOX_TOKEN')}}";
</script>
<script src="../../js/maps.js"></script>
<script>
  window.onload=function(){
        setTimeout(()=>{
            setEditMap();
        }, 500);
    
    }
</script>
@endsection