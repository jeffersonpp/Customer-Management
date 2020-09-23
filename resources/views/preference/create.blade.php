@extends('layouts.app')
@section('scripts')
    @parent

@stop
@section('content')

<style>
  .uper {
    margin-top: 40px;
  }
    .areaT{
        resize:none;
        height:120px;
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
          <form method="post" action="{{ route('ins_preference') }}">
                  @csrf
              <div class="form-group">
                    <label for="title">Title</label>
                        <input name="title" maxlength='45' placeholder="Subject" class="form-control">
              </div>              
              <div class="form-group">
                        <label for="address_address">Preference</label>
                        <textarea name="text" maxlength='255' placeholder="Escreva aqui" class="form-control areaT">
                            
                  </textarea>
              </div>
                <input type="hidden" id="client_id" name="client_id" value="{{$id}}">
              <button type="submit" class="btn btn-primary">Add Preference</button>
          </form>
      </div>
    </div>
</div>
@endsection