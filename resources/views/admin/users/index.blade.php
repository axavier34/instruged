@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
<div class="row">
    <div class="col-md-4">
        <h1>Usuários</h1>
    </div>
    <div class="col-md-8" style="text-align: right;">
        <div class="row">
            <div class="col-md-6">
                <a href="{{route('users.create')}}" class="btn btn-primary" >Novo Usuário</a>
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
            <h3 class="card-title">Lista de Usuários</h3>
        </div>

        <div class="card-body">
            <table  class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a href="{{ route('users.edit',['user'=> $user->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-pen fa-fw"></i>  Editar</a>
                                @if($loggedId !== intval($user->id))
                                    <form class="d-inline" method="POST" action="{{ route('users.destroy',['user'=> $user->id]) }}" onsubmit="return confirm('Tem certeza que deseja excluir este registro?')">
                                        @method('DELETE')
                                        @csrf
                                    <button class="btn btn-danger btn-sm" ><i class="fas fa-trash fa-fw"></i>Excluir</button>

                                    </form>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>

    {{ $users->links('pagination::bootstrap-4') }}
@endsection

{{-- @section('css')
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


@endsection

@section('js')


{{-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}



{{-- <script>
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
</script> --}}

{{-- <script>
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

</script> --}}
