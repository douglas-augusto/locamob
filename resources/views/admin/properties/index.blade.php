@extends('layouts.app')

@section('content')
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red">
            <i class="large material-icons">add</i>
        </a>
        <ul>
            <li><a href="#modal_new" class="btn-floating red modal-trigger" title="Novo Imóvel">
                    <i class="material-icons">store</i></a></li>

        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="col s8">
                        <h5 style="padding: 17px;" class="breadcrumbs-title">Imóveis</h5>
                    </div>
                    <div class="col s4" style="padding-top: 10px;">
                        <form action="{{route('admin.owners.index')}}">
                            @csrf
                            <div class="input-field col s12">
                                <i class="material-icons prefix">search</i>
                                <input id="icon_prefix" value="{{$search}}" name='search' id='search' type="text"
                                       class="active" placeholder="">
                                <label for="icon_prefix">Buscar</label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-panel" style="margin-top: -5px;">
                    @if($properties->isEmpty())
                        <h6 align="center">Nenhum registro salvo no sistema!</h6>
                    @else
                        <table class="striped">
                            <thead>
                            <tr>
                                <th>Proprietário</th>
                                <th>Rua</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($properties as $c)
                                <tr>
                                    <td>{{$c->name}}</td>
                                    <td>{{$c->street}}</td>
                                    <td>{{$c->district}}</td>
                                    <td>{{$c->city}}</td>
                                    <td style="padding: 5px 5px;">
                                        <div class="row">
                                            <div class="col s3">
                                                <a id="edit_customer" href='#modal_edit'
                                                   data-rota="{{route('admin.properties.edit',['property' => $c->id])}}"
                                                   data-update="{{route('admin.properties.update',['property' => $c->id])}}"
                                                   class="btn-table blue modal-trigger" title="Editar"><i
                                                        class="material-icons">edit</i></a>
                                            </div>
                                            <div class="col s3">
                                                <form
                                                    action="{{route('admin.properties.destroy', ['property' => $c->id])}}"
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
                        {{ $properties->appends(['search' => $search])->links('vendor.pagination.materializecss') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Cadastrar -->
    <div id="modal_new" class="modal modal-fixed-footer" style="height: 480px; max-height: 100%;">
        <form class="col s12" action="{{route('admin.properties.store')}}" method="post">
            @csrf
            <div class="modal-content">
                <h5>Novo Imóvel</h5>
                <div class="row">
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="hidden" name="owner_id" id="owner_id">
                            <input type="text" id="owner_name" name="owner_name" class="autocomplete" required
                                   placeholder="Buscar proprietário" autocomplete="off">
                            <label for="owner_name">Proprietário</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="street" name="street" type="text" class="validate" maxlength="40"
                                   placeholder="" required>
                            <label for="email">Rua</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s2">
                            <input id="number" name="number" type="text" class="validate" maxlength="5"
                                   placeholder="">
                            <label for="email">Número</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="district" name="district" type="text" class="validate"
                                   placeholder="">
                            <label for="phone">Bairro</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="city" name="city" type="text" class="validate"
                                   placeholder="">
                            <label for="phone">Cidade</label>
                        </div>
                        <div class="input-field col s2">
                            <input id="uf" name="uf" type="text" class="validate"
                                   placeholder="">
                            <label for="phone">Estado</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input id="zip_code" name="zip_code" type="text" class="validate"
                                   placeholder="Busque pelo CEP">
                            <label for="phone">CEP</label>
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
    <div id="modal_edit" class="modal modal-fixed-footer" style="height: 480px; max-height: 100%;">
        <form class="col s12" name="edit_form">
            @csrf
            @method("PUT")
            <div class="modal-content">
                <h5 id="modal-title">Editar Imóvel</h5>
                <div class="row">
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="hidden" name="owner_id_" id="owner_id_">
                            <input type="text" id="owner_name_" name="owner_name_" class="autocomplete" required
                                   placeholder="Buscar proprietário" autocomplete="off">
                            <label for="owner_name">Proprietário</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="street_" name="street_" type="text" class="validate" maxlength="40"
                                   placeholder="" required>
                            <label for="email">Rua</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s2">
                            <input id="number_" name="number_" type="text" class="validate" maxlength="5"
                                   placeholder="">
                            <label for="email">Número</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="district_" name="district_" type="text" class="validate"
                                   placeholder="" >
                            <label for="phone">Bairro</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="city_" name="city_" type="text" class="validate"
                                   placeholder="" >
                            <label for="phone">Cidade</label>
                        </div>
                        <div class="input-field col s2">
                            <input id="uf_" name="uf_" type="text" class="validate"
                                   placeholder="" >
                            <label for="phone">Estado</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input id="zip_code_" name="zip_code_" type="text" class="validate"
                                   placeholder="Busque pelo CEP">
                            <label for="phone">CEP</label>
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
            $('#modal_new').modal();
            $('#modal_edit').modal();
            $("#zip_code").mask("00000-000");
            $("#zip_code_").mask("00000-000");

            var update;

            $('body').on('click', '#edit_customer', function (event) {
                event.preventDefault();
                var rota = $(this).data('rota');
                update = $(this).data('update');
                $.get(rota, function (data) {
                    $('#owner_name_').val(data.name);
                    $('#owner_id_').val(data.data.owner_id);
                    $('#street_').val(data.data.street);
                    $('#city').val(data.data.city);
                    $('#district_').val(data.data.district);
                    $('#zip_code_').val(data.data.zip_code);
                    $('#city_').val(data.data.city);
                    $('#uf_').val(data.data.uf);
                    $('#number_').val(data.data.number);
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

            $.ajax({
                type: 'get',
                url: '{{route('admin.properties.search.owner')}}',
                success: function (response) {
                    var custArray = response;
                    var dataCust = {};
                    var dataCust2 = {};
                    for (var i = 0; i < custArray.length; i++) {
                        dataCust[custArray[i].name] = null;
                        dataCust2[custArray[i].name] = custArray[i];
                    }
                    $('input#owner_name').autocomplete({
                        data: dataCust,
                        onAutocomplete: function (reqdata) {
                            $('#owner_id').val(dataCust2[reqdata]['id']);
                        }
                    });
                    $('input#owner_name_').autocomplete({
                        data: dataCust,
                        onAutocomplete: function (reqdata) {
                            $('#owner_id_').val(dataCust2[reqdata]['id']);
                        }
                    });
                }
            });

            $("#zip_code").focusout(function() {
                $.ajax({
                    url: 'https://viacep.com.br/ws/' + $(this).val() + '/json/unicode/',
                    dataType: 'json',
                    success: function(resposta) {
                        $("#street").val(resposta.logradouro);
                        $("#district").val(resposta.bairro);
                        $("#city").val(resposta.localidade);
                        $("#uf").val(resposta.uf);
                        $("#number").focus();
                    }
                });
            });

            $("#zip_code_").focusout(function() {
                $.ajax({
                    url: 'https://viacep.com.br/ws/' + $(this).val() + '/json/unicode/',
                    dataType: 'json',
                    success: function(resposta) {
                        $("#street_").val(resposta.logradouro);
                        $("#district_").val(resposta.bairro);
                        $("#city_").val(resposta.localidade);
                        $("#uf_").val(resposta.uf);
                        $("#number_").focus();
                    }
                });
            });

        });

    </script>
@endsection

