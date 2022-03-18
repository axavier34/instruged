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
                <a href="{{route('posts.create')}}" class="btn btn-primary" >Novo Documento</a>
            </div>
            <div class="col-md-6">
                <form action="{{route('posts.index')}}" method="get">
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
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Depar/to</th>
                        <th>Usuario</th>
                        <th>Data</th>
                        <th>Arquivos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->name}}</td>
                            <td>{{$post->cpf}}</td>
                            <td>{{$post->departamento}}</td>
                            <td>{{$post->author}}</td>
                            <td>{{$post->data_file->format('d/m/Y')}}</td>
                            <td>
                                @foreach($post->images as $file)
                                    
                                        {{-- @if(file_exists(public_path('files/{{$file->image}}')))    --}}
                                            <a href="/files/{{$file->image}}"><img src="{{url('images/pdf_down.jpg')}}" class="img responsive" style="max-height: 100px; max-width: 100px" alt="" /></a>
                                            <p>| {{$file->image}} |</p>
                                        {{-- @endif --}}
                                @endforeach


                            </td>
                            
                            <td>
                                @if($loggedId !== intval($post->id))
                                 <a href="{{ route('posts.edit',['post'=> $post->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-pen fa-fw"></i>  Editar</a>
                                @endif
                                @if($loggedId !== intval($post->id))
                                    <form class="d-inline" method="POST" action="{{ route('posts.destroy',['post'=> $post->id]) }}" onsubmit="return confirm('Tem certeza que deseja excluir este registro?')">
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
                        <th>CPF</th>
                        <th>Depar/to</th>
                        <th>Usuario</th>
                        <th>Data</th>
                        <th>Arquivos</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>

    {{ $posts->links('pagination::bootstrap-4') }}
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


@endsection

@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- selec2 cdn --}}
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script> --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>



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
