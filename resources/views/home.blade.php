@extends('layouts.app')

@section('content')
<style>
    .list{        
        text-align:center;
        margin:auto;
    }
    .list > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }
    .part{
        display:inline-block;
        margin-left:30px;
        margin-right:30px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="list">
                        <div class="part">
                            <a href="{{ route('clients') }}"><img src="{{asset('/image/client_list.png')}}" height="60px"><br>Client List</a>
                        </div>
                        <div class="part">
                            <a href="{{ route('new_client') }}"><img src="{{asset('/image/new_client.png')}}" height="60px"><br>New Client</a>
                        </div>
                        <div class="part">
                            <a href="{{ route('new_agenda') }}"><img src="{{asset('/image/new_agenda.png')}}" height="60px"><br>Schedule Service</a>
                        </div>
                        <div class="part">
                            <a href="{{ route('agendas') }}"><img src="{{asset('/image/calendar.png')}}" height="60px"><br>Calendar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
