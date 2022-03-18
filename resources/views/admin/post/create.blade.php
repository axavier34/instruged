@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Novo Documento</h1>

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
            <h3 class="card-title">Formulário de cadastro de Documentos</h3>
        </div>

        <div class="card-body">
            <form class="form-horizontal" action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-10">
                         <input type="text" name="name" value="{{old('name')}}"class="form-control @error('name') is-invalid @enderror" id="inputEmail3" placeholder="Nome Completo">
                    </div>
                </div>
                <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">CPF</label>
                    <div class="col-sm-10">
                        <input type="text" name="cpf" id="cpf" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' value="{{old('cpf')}}" class="form-control @error('cpf') is-invalid @enderror" id="inputPassword3" placeholder="CPF" maxlength="18">
                    </div>
                </div>
                <div class="form-group row">
                    {{-- <label for="inputPassword3" class="col-sm-2 col-form-label">Dt. Cadastro</label>
                    <div class="col-sm-10"> --}}
                        <input type="hidden" name="author" value="{{Auth::user()->name;
                        }}">
                    {{-- </div> --}}
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Departamento</label>
                    <div class="col-sm-10">
                        <select name="departamento" id="myselect" class="form-control @error('departamento') is-invalid @enderror">
                            <option value="">Selecione um Departamento</option>
                            @foreach($deptos as $depto)
                                <option value="{{$depto->departamento}}">{{$depto->departamento}}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" name="departamento" class="form-control @error('departamento') is-invalid @enderror" id="inputPassword3" placeholder="Departamento"> --}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Data do Arquivo</label>
                    <div class="col-sm-10">
                        <input  type="date" name="data_file" class="form-control  @error('data_file') is-invalid @enderror">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Descrição</label>
                    <div class="col-sm-10">
                        <input type="text" name="post" value="{{old('post')}}"class="form-control @error('post') is-invalid @enderror" id="inputEmail3" placeholder="Descrição">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Arquivo</label>
                <div class="col-sm-10">
                     <input type="file" name="file_path[]" value="{{old('file_path')}}"class="form-control @error('file_path') is-invalid @enderror" id="inputEmail3" placeholder="Arquivo" multiple>
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

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


@endsection

@section('js')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
      $("#single").select2({
          placeholder: "Select a programming language",
          allowClear: true
      });
      </script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    {{-- selec2 cdn --}}
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script> --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>

    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>

<script>
     function mascaraMutuario(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function cpfCnpj(v){

    //Remove tudo o que não é dígito
    v=v.replace(/\D/g,"")

    if (v.length <= 14) { //CPF

        //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um hífen entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

    } else { //CNPJ

        //Coloca ponto entre o segundo e o terceiro dígitos
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")

        //Coloca ponto entre o quinto e o sexto dígitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")

        //Coloca uma barra entre o oitavo e o nono dígitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")

        //Coloca um hífen depois do bloco de quatro dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")

    }

    return v
}
</script>


<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



<script>
    @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.success("{{ session('message') }}");
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>

<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            language:{
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });
    });

</script>
