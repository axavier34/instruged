@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Editar Departamento</h1>

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
            <h3 class="card-title">Formulário de Edição de Departamentos</h3>
        </div>

        <div class="card-body">
            <form class="form-horizontal" action="{{route('departamento.update', ['departamento' => $depto->id])}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Descrição</label>
                    <div class="col-sm-10">
                         <input type="text" name="name" value="{{$depto->departamento}}"class="form-control @error('name') is-invalid @enderror" id="inputEmail3" placeholder="Nome Completo">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ativo</label>
                        <div class="col-sm-10">
                            <input type="radio" value="ativo" class="flat" 
                            name="meterial" 
                            {{ $depto->ativo == 0 ? 'checked' : '' }} >
                        </div>
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Inativo</label>
                        <div class="col-sm-10">
                            <input type="radio" value="ativo" class="flat" 
                            name="meterial" 
                            {{ $depto->ativo == 1 ? 'checked' : '' }} >
                        </div>
            </div>
               
                </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Atualizar</button>
                        <button type="reset" class="btn btn-default float-right">Cancelar</button>
                    </div>
                </div>


                </form>
        </div>

    </div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


@endsection

@section('js')


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
