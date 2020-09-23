@extends('layouts.app')
@section('scripts')
    @parent

@stop
@section('content')

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key={{ env('GOOGLE_MAPS_API_KEY') }}" async defer></script>
    <script src="{{ asset('js/mapInput.js') }}"></script>

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
          
          <div class="form-group">
                    <label for="address_address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Address" value="{{$client->address}}" class="form-control map-input">
          </div>
          <div>
                    <input type="text" id="apartment" name="apartment" placeholder="Apartment" value="{{$client->apartment}}" class="form-control">
                    
                    <input type="hidden" id="city" name="city" value="{{$client->city}}" class="form-control">
                    <input type="hidden" name="address_latitude" value="{{$client->latitude}}" id="address_latitude" value="0" />
                    <input type="hidden" name="address_longitude" value="{{$client->longitude}}" id="address_longitude" value="0" />
                    <input type="hidden" name="street_number" id="street_number" value="0" />
                    <input type="hidden" name="route" id="route" value="0" />
                    <input type="hidden" name="country" id="country" value="0" />
                    <input type="hidden" name="administrative_area_level_1" id="administrative_area_level_1" value="0" />
                    <input type="hidden" name="administrative_area_level_2" id="administrative_area_level_2" value="0" />
                    <input type="hidden" name="postal_code" id="postal_code" value="0" />
                    <input type="hidden" name="zipcode" id="zipcode" value="0" />
                    <input type="hidden" name="place" id="place" value="0" />
                    <input type="hidden" name="library" id="library" value="0" />
                    <input type="hidden" name="locality" id="locality" value="0" />
          </div>
          <div id="address-map-container" style="width:100%;height:300px; ">
                    <div style="width: 100%; height: 100%" id="map"></div>
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
setTimeout(function(){
var lati =  document.getElementById('address_latitude').value;
var lngi =    document.getElementById('address_longitude').value;     
  //Map zooms in to the location given
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: +lati, lng: +lngi},
    zoom: 18
  });
  
  //Map marker is created and displays address
  var marker = new google.maps.Marker({
    map: map,
    position: {lat: +lati, lng: +lngi}
  });
},1000);
</script>
@endsection