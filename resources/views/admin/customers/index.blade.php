@extends('layouts.app')

@section('content')
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red">
            <i class="large material-icons">add</i>
        </a>
        <ul>
            <li><a href="#modal_new" class="btn-floating red modal-trigger" title="Novo Cliente">
                    <i class="material-icons">person_add</i></a></li>

        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="col s8">
                        <h5 style="padding: 17px;" class="breadcrumbs-title">Clientes</h5>
                    </div>
                    <div class="col s4" style="padding-top: 10px;">
                        <form action="{{route('admin.customers.index')}}">
                            @csrf
                            <div class="input-field col s12">
                                <i class="material-icons prefix">search</i>
                                <input id="icon_prefix" value="{{$search}}" name='search' id='search' type="text" class="active" placeholder="">
                                <label for="icon_prefix">Buscar</label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-panel" style="margin-top: -5px;">
                    @if($customers->isEmpty())
                        <h6 align="center">Nenhum registro salvo no sistema!</h6>
                    @else
                    <table class="striped">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $c)
                            <tr>
                                <td>{{$c->name}}</td>
                                <td>{{$c->email}}</td>
                                <td>{{$c->phone}}</td>
                                <td style="padding: 5px 5px;">
                                    <div class="row">
                                        <div class="col s3">
                                            <a id="edit_customer" href='#modal_edit'
                                               data-rota="{{route('admin.customers.edit',['customer' => $c->id])}}"
                                               data-update="{{route('admin.customers.update',['customer' => $c->id])}}"
                                               class="btn-table blue modal-trigger" title="Editar"><i
                                                    class="material-icons">edit</i></a>
                                        </div>
                                        <div class="col s3">
                                            <form action="{{route('admin.customers.destroy', ['customer' => $c->id])}}"
                                                  method="post" name="form_delete">
                                                @method("DELETE")
                                                @csrf
                                                <button class="btn-table red" title="Apagar" type="submit"
                                                        onclick="return confirm('Tem certeza que deseja apagar o registro?')">
                                                    <i class="material-icons">delete</i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $customers->appends(['search' => $search])->links('vendor.pagination.materializecss') }}
                        @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Cadastrar -->
    <div id="modal_new" class="modal modal-fixed-footer" style="max-height: 58%;">
        <form class="col s12" action="{{route('admin.customers.store')}}" method="post">
            @csrf
            <div class="modal-content">
                <h5>Novo Locatário</h5>
                <div class="row">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="name" name="name" type="text" class="validate" required maxlength="50"
                                   placeholder="Insira o nome">
                            <label for="name">Nome</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s8">
                            <input id="email" name="email" type="text" class="validate" maxlength="40"
                                   placeholder="Insira o email">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="phone" name="phone" type="text" class="validate" required
                                   placeholder="Insira o telefone">
                            <label for="phone">Telefone</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-right: 20px">
                <button class="waves-effect waves-light btn green" type="submit">
                    cadastrar
                </button>
            </div>
        </form>
    </div>

    <!-- Modal Editar -->
    <div id="modal_edit" class="modal modal-fixed-footer" style="max-height: 58%;">
        <form class="col s12" name="edit_form">
            @csrf
            @method("PUT")
            <div class="modal-content">
                <h5 id="modal-title">Editar Locatário</h5>
                <div class="row">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="name_" name="name_" type="text" class="validate" required maxlength="50"
                                   placeholder="Insira o nome">
                            <label for="name_">Nome</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s8">
                            <input id="email_" name="email_" type="text" class="validate" maxlength="40"
                                   placeholder="Insira o email">
                            <label for="email_">Email</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="phone_" name="phone_" type="text" class="validate" required
                                   placeholder="Insira o telefone">
                            <label for="phone_">Telefone</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-right: 20px">
                <button class="waves-effect waves-light btn green" type="submit">
                    Salvar
                </button>
            </div>
        </form>
    </div>

@endsection
@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            $('#phone').mask('(00)00000-0000');
            $('#phone_').mask('(00)00000-0000');
            $('#modal_new').modal();
            $('#modal_edit').modal();

            var update;

            $('body').on('click', '#edit_customer', function (event) {
                event.preventDefault();
                var rota = $(this).data('rota');
                update = $(this).data('update');
                $.get(rota, function (data) {
                    $('#name_').val(data.data.name);
                    $('#email_').val(data.data.email);
                    $('#phone_').val(data.data.phone);
                })

            });

            $(function () {
                $('form[name="edit_form"]').submit(function (event) {
                    event.preventDefault();
                    $.ajax({
                        url: update,
                        type: "post",
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function (response) {
                            window.location.reload(true);
                        }
                    });
                });
            });

            $('#search').keypress(function (e) {
                if (e.which == 13) {
                    $('search_button').click();
                }
            });

        });

    </script>
@endsection

