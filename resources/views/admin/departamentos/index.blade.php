@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
<div class="row">
    <div class="col-md-4">
        <h1>Documentos</h1>
    </div>
    <div class="col-md-8" style="text-align: right;">
        <div class="row">
            <div class="col-md-6">
                <a href="{{route('departamento.create')}}" class="btn btn-primary" >Novo Documento</a>
            </div>
            <div class="col-md-6">
                <form action="{{route('users.index')}}" method="get">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Pesquisar">
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('content')
    <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">lista de Documentos</h3>
        </div>

        <div class="card-body">
            <table id="example2"  class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deptos as $depto)
                        <tr>
                            <td>{{$depto->id}}</td>
                            <td>{{$depto->departamento}}</td>
                            
                            
                            <td>
                                <a href="{{ route('departamento.edit',['departamento'=> $depto->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-pen fa-fw"></i>  Editar</a>
                                
                                    <form class="d-inline" method="POST" action="{{ route('departamento.destroy',['departamento'=> $depto->id]) }}" onsubmit="return confirm('Tem certeza que deseja excluir este registro?')">
                                        @method('DELETE')
                                        @csrf
                                    <button class="btn btn-danger btn-sm" ><i class="fas fa-trash fa-fw"></i>Excluir</button>

                                    </form>
                               
                            </td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>

    {{ $deptos->links('pagination::bootstrap-4') }}
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


@endsection

@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
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
