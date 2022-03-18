@extends('adminlte::page')

@section('title', 'Meu Perfil')

@section('content_header')
<h1>Meu Perfil</h1>
@endsection


@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            <h4><i class="icon fas fa-ban"></i>Ocorreu(ram) o(s) seguinte(s) erro(s)</h4>
            @foreach ($errors->all() as $error)
                <li>
                    <h5>
                        {{$error}}
                    </h5>
                </li>

            @endforeach

        </ul>
    </div>
@endif


<div class="card card-info">
     <div class="card-header">
        <h3 class="card-title">Meu Perfil</h3>
    </div>

    <div class="card-body">
        <form class="form-horizontal" action="{{route('profile.save')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nome Completo</label>
                <div class="col-sm-10">
                     <input type="text" name="name" value="{{$user->name}}"class="form-control @error('name') is-invalid @enderror" id="inputEmail3" placeholder="Nome Completo">
                </div>
            </div>
            <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" id="inputPassword3" placeholder="Password">
                </div>
            </div>
            <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nova Senha</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword3" placeholder="Password">
                </div>
            </div>
            <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Confirmação da Nova Senha</label>
                <div class="col-sm-10">
                    <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="inputPassword3" placeholder="Password">
                </div>
            </div>
            {{-- <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck2">
                <label class="form-check-label" for="exampleCheck2">Remember me</label>
            </div> --}}
            </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Cadastrar</button>
                    <button type="reset" class="btn btn-default float-right">Cancelar</button>
                </div>
            </div>


            </form>
    </div>

</div>
@endsection

