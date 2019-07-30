@extends('frontLayout.master')
@section('content')
 <div class="page-head">
    <h3 class="m-b-less">
        Perfil de Usuario
    </h3>
</div>
<div class="profile-hero">
    <div class="profile-intro">
        <div class="profile-follow" style="margin-bottom: 5%; left: 5%;">
          <img src="{{ Auth::user()->profile_picture }}" alt="{{ Auth::user()->full_name }}" style="width: 260px !important; height: 260px !important">
        </div>
        <div class="s-n" style="margin-top: 7% !important;">
             <span>{{ Auth::user()->full_name }}</span>
        </div>
        <div class="s-n">
            <span>{{ Auth::user()->rut }}</span>
        </div>
        <div class="s-n">
            <span>{{ Auth::user()->email }}</span>
        </div>
    </div>
    <div class="profile-follow">
        <a href="{{ url('perfil/foto/' .Auth::user()->id) }}" class="btn btn-success"> <i class="fa fa-check"></i> Cambiar mis datos</a>
    </div>
    <div class="profile-value-info">
        
    </div>
</div>
 <br>
 <div class="table table-responsive">
    <div class="page-head">
        <h3 class="m-b-less">
            Mis negocios registrados
        </h3>
    </div>
       
        <table class="table table-bordered table-striped table-hover" id="table">
            <thead>
                <tr>
                    <th>Titulo Negocio</th>
                    <th>Estado</th>
                    <th>Cliente</th>
                    <th>Creado el</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deals as $deal)
                    <tr>
                        <td>{{ $deal->title }}</td>
                        <td>{{ $deal->dealState->name }}</td>
                        <td>{{ $deal->client->full_name }}</td>
                        <td>{{ $deal->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop            