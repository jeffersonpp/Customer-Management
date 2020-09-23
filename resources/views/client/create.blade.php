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
          <form method="post" action="{{ route('ins_client') }}">
              <div class="form-group">
                  @csrf
                  <label for="name">Name:</label>
                  <input type="text" class="form-control" name="name"/>
              </div>
              
              <div class="form-group">
                <div id="map_show" style="width: 100%; height: 250px; z-index:1;border:solid 1px rgba(150,150,150,0.5);border-radius:8px;">
                
                </div>
                <input type="hidden"  id="latlong" name="location"/>
                <input type="hidden"  id="city" name="city"/>
                <input type="hidden"  id="address"  name="address"/>
              </div>

             <div class="form-group">
                  <label for="quantity">Phone:</label>
                  <input type="text" class="form-control" name="phone"/>
              </div>
              <div class="form-group">
                  <label for="quantity">Email:</label>
                  <input type="text" class="form-control" name="email"/>
              </div>
              <div class="form-group">
                  <label for="quantity">Price:</label>
                  <input type="text" class="form-control" name="price"/>
              </div>
              <div class="form-group">
                  <select class="form-control" name="method">
                      <option>Select</option>
                      <option value='daily'>Daily</option>
                      <option value='weekly'>Weekly</option>
                      <option value='biweekly'>Biweekly</option>
                      <option value='monthly'>Monthly</option>
                      <option value='custom'>Custom</option>
                  </select>
              </div>     

              <button type="submit" class="btn btn-primary">Add Client</button>
          </form>
      </div>
    </div>
</div>
<script>
  const mapbox_token = "{{env('MAPBOX_TOKEN')}}";
</script>
<script src="../js/maps.js"></script>
@endsection