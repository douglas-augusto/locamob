@extends('layouts.app')

@section('content')
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red">
            <i class="large material-icons">add</i>
        </a>
        <ul>
            <li><a href="#modal_new" class="btn-floating red modal-trigger" title="Novo Contrato">
                    <i class="material-icons">insert_drive_file</i></a></li>

        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="col s8">
                        <h5 style="padding: 17px;" class="breadcrumbs-title">Contratos</h5>
                    </div>
                    <div class="col s4" style="padding-top: 10px;">
                        <form action="{{route('admin.contracts.index')}}">
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
                    @if($contracts->isEmpty())
                        <h6 align="center">Nenhum registro salvo no sistema!</h6>
                    @else
                        <table class="striped">
                            <thead>
                            <tr>
                                <th>Locatário</th>
                                <th>Locador</th>
                                <th>Início</th>
                                <th>Fim</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contracts as $c)
                                <tr>
                                    <td>{{$c->name_owner}}</td>
                                    <td>{{$c->name_customer}}</td>
                                    <td>{{date("d/m/Y", strtotime($c->start_day))}}</td>
                                    <td>{{date("d/m/Y", strtotime($c->end_day))}}</td>
                                    <td style="padding: 5px 5px;">
                                        <div class="row">
                                            <div class="col s2">
                                                <a href='{{route('admin.contracts.monthly_payments',['contract' => $c->id,])}}'
                                                   class="btn-table orange modal-trigger" title="Ver mensalidades"><i
                                                        class="material-icons">date_range</i></a>
                                            </div>
                                            <div class="col s2">
                                                <a href='{{route('admin.contracts.transfers',['contract' => $c->id,])}}'
                                                   class="btn-table orange modal-trigger" title="Ver repasses"><i
                                                        class="material-icons">add_to_photos</i></a>
                                            </div>
                                            <div class="col s2">
                                                <a id="edit_customer" href='#modal_edit'
                                                   data-rota="{{route('admin.contracts.show',['contract' => $c->id])}}"
                                                   class="btn-table green modal-trigger" title="Ver contrato"><i
                                                        class="material-icons">remove_red_eye</i></a>
                                            </div>
                                            <div class="col s2">
                                                <form
                                                    action="{{route('admin.contracts.destroy', ['contract' => $c->id])}}"
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
                        {{ $contracts->appends(['search' => $search])->links('vendor.pagination.materializecss') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Cadastrar -->
    <div id="modal_new" class="modal modal-fixed-footer" style="height: 480px; max-height: 100%;">
        <form class="col s12" action="{{route('admin.contracts.store')}}" method="post">
            @csrf
            <div class="modal-content">
                <h5>Novo Contrato</h5>
                <div class="row">
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="hidden" name="owner_id" id="owner_id">
                            <input type="hidden" name="property_id" id="property_id">
                            <input type="text" id="property" name="property" class="autocomplete" required
                                   placeholder="Buscar imóvel" autocomplete="off">
                            <label for="owner_name">Imóvel</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="hidden" name="customer_id" id="customer_id">
                            <input type="text" id="customer_name" name="customer_name" class="autocomplete" required
                                   placeholder="Buscar locador" autocomplete="off">
                            <label for="owner_name">Locatário</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <input id="start_day" name="start_day" type="text" class="dataIniFim" placeholder=""
                                   required>
                            <label for="start_day">Data inicial</label>
                        </div>
                        <div class="input-field col s3">
                            <input id="end_day" name="end_day" type="text" class="validate" placeholder="" readonly
                                   required>
                            <label for="phone">Data final</label>
                        </div>
                        <div class="input-field col s3">
                            <input id="administrative_fee" name="administrative_fee" type="text" class="active"
                                   maxlength="10" required
                                   placeholder="">
                            <label for="administrative_fee">Taxa Administrativa</label>
                        </div>
                        <div class="input-field col s3">
                            <input id="rent_amount" name="rent_amount" type="text" class="active" maxlength="10"
                                   required
                                   placeholder="">
                            <label for="rent_amount">Aluguel</label>
                        </div>
                        <div class="input-field col s3">
                            <input id="condominium_amount" name="condominium_amount" type="text" class="active"
                                   maxlength="10" required
                                   placeholder="">
                            <label for="condominium_amount">Condomínio</label>
                        </div>
                        <div class="input-field col s3">
                            <input id="iptu_amount" name="iptu_amount" type="text" class="active" maxlength="10"
                                   required
                                   placeholder="">
                            <label for="iptu_amount">IPTU</label>
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

    <!-- Modal Ver -->
    <div id="modal_edit" class="modal" style="height: 400px; max-height: 100%;">
        <div class="modal-content">
            <h5 id="modal-title">Ver Contrato</h5>
            <div class="row">
                <div class="row">
                    <div class="input-field col s6">
                        <input type="text" id="property_" name="property_" class="active" readonly
                               placeholder="" autocomplete="off">
                        <label for="property_">Imóvel</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" id="customer_" name="customer_" class="active" readonly
                               placeholder="" autocomplete="off">
                        <label for="customer_">Locatário</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3">
                        <input id="start_day_" name="start_day_" type="text" class="active" placeholder="" readonly>
                        <label for="start_day_">Data inicial</label>
                    </div>
                    <div class="input-field col s3">
                        <input id="end_day_" name="end_day_" type="text" class="active" placeholder="" readonly>
                        <label for="end_day_">Data final</label>
                    </div>
                    <div class="input-field col s3">
                        <input id="administrative_fee_" name="administrative_fee_" type="text" class="active"
                               maxlength="10" required placeholder="">
                        <label for="administrative_fee_">Taxa Administrativa</label>
                    </div>
                    <div class="input-field col s3">
                        <input id="rent_amount_" name="rent_amount_" type="text" class="active" maxlength="10" readonly
                               placeholder="">
                        <label for="rent_amount_">Aluguel</label>
                    </div>
                    <div class="input-field col s3">
                        <input id="condominium_amount_" name="condominium_amount_" type="text" class="active"
                               maxlength="10" readonly placeholder="">
                        <label for="condominium_amount_">Condomínio</label>
                    </div>
                    <div class="input-field col s3">
                        <input id="iptu_amount_" name="iptu_amount_" type="text" class="active" maxlength="10" required
                               placeholder="">
                        <label for="iptu_amount_">IPTU</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript" src="{!! asset('assets/js/moment.js') !!}"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            function FormataStringData(data) {
                var dia = data.split("/")[0];
                var mes = data.split("/")[1];
                var ano = data.split("/")[2];

                return ano + '-' + ("0" + mes).slice(-2) + '-' + ("0" + dia).slice(-2);
                // Utilizo o .slice(-2) para garantir o formato com 2 digitos.
            }

            $('.dataIniFim').on('mousedown', function (event) {
                event.preventDefault();
            }).pickadate({
                selectMonths: true,
                selectYears: 15,
                labelMonthNext: 'Próximo Mês',
                labelMonthPrev: 'Mês Anterior',
                labelMonthSelect: 'Selecione o Mês',
                labelYearSelect: 'Selecione o Ano',
                monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
                weekdaysLetter: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
                today: 'Hoje',
                clear: 'Limpar',
                close: 'Fechar',
                format: 'dd/mm/yyyy',
                onClose: function () {
                    var dataa = $('#start_day').val();
                    var dataFormatada = FormataStringData(dataa);

                    var addAno = moment(dataFormatada).add(1, 'year');
                    var novaData = moment(addAno).format('DD/MM/YYYY');

                    $('#end_day').val(novaData);
                }
            });

            $('#administrative_fee').mask('#.##0,00', {reverse: true});
            $('#rent_amount').mask('#.##0,00', {reverse: true});
            $('#condominium_amount').mask('#.##0,00', {reverse: true});
            $('#iptu_amount').mask('#.##0,00', {reverse: true});

            $('#modal_new').modal();
            $('#modal_edit').modal();

            function formatMoney(n, c, d, t) {
                c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ?
                    "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
                return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math
                    .abs(n - i).toFixed(c).slice(2) : "");
            }

            $('body').on('click', '#edit_customer', function (event) {
                event.preventDefault();
                var rota = $(this).data('rota');
                $.get(rota, function (data) {
                    $('#property_').val(data.data[0].name_owner);
                    $('#customer_').val(data.data[0].name_customer);
                    $('#start_day_').val(moment(data.data[0].start_day).format('DD/MM/YYYY'));
                    $('#end_day_').val(moment(data.data[0].end_day).format('DD/MM/YYYY'));
                    $('#administrative_fee_').val(formatMoney(data.data[0].administrative_fee));
                    $('#rent_amount_').val(formatMoney(data.data[0].rent_amount));
                    $('#condominium_amount_').val(formatMoney(data.data[0].condominium_amount));
                    $('#iptu_amount_').val(formatMoney(data.data[0].iptu_amount));
                })

            });


            $('#search').keypress(function (e) {
                if (e.which == 13) {
                    $('search_button').click();
                }
            });

            $.ajax({
                type: 'get',
                url: '{{route('admin.properties.search.customer')}}',
                success: function (response) {
                    var custArray = response;
                    var dataCust = {};
                    var dataCust2 = {};
                    for (var i = 0; i < custArray.length; i++) {
                        dataCust[custArray[i].name] = null;
                        dataCust2[custArray[i].name] = custArray[i];
                    }
                    $('input#customer_name').autocomplete({
                        data: dataCust,
                        onAutocomplete: function (reqdata) {
                            $('#customer_id').val(dataCust2[reqdata]['id']);
                        }
                    });
                }
            });

            $.ajax({
                type: 'get',
                url: '{{route('admin.properties.search.property')}}',
                success: function (response) {
                    var custArray = response;
                    var dataCust = {};
                    var dataCust2 = {};

                    for (var i = 0; i < custArray.length; i++) {
                        dataCust['Locador: ' + custArray[i].name + ' | Endereço: ' + custArray[i].street + ', ' + custArray[i].number] = null;
                        dataCust2[custArray[i].number] = custArray[i];
                    }
                    $('input#property').autocomplete({
                        data: dataCust,
                        onAutocomplete: function (reqdata) {
                            let number = reqdata.replace(/([^\d])+/gim, '');
                            $('#owner_id').val(dataCust2[number]['owner_id']);
                            $('#property_id').val(dataCust2[number]['id']);
                        }
                    });
                }
            });

        });

    </script>
@endsection

