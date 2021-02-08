@extends('layouts.app')

@section('content')
    <div class="container">
        <!--card stats start-->
        <div id="card-stats">
            <div class="row mt-1">
                <div class="col s12 m6 l3">
                    <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text">
                        <div class="padding-4">
                            <div class="col s7 m7">
                                <i class="material-icons background-round mt-5">perm_identity</i>
                            </div>
                            <div class="col s5 m5 right-align">
                                <h5 class="mb-0">{{$customers}}</h5>
                                <p class="no-margin">Locatários</p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l3">
                    <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text">
                        <div class="padding-4">
                            <div class="col s7 m7">
                                <i class="material-icons background-round mt-5">perm_identity</i>
                            </div>
                            <div class="col s5 m5 right-align">
                                <h5 class="mb-0">{{$owners}}</h5>
                                <p class="no-margin">Locadores</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l3">
                    <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text">
                        <div class="padding-4">
                            <div class="col s7 m7">
                                <i class="material-icons background-round mt-5">store</i>
                            </div>
                            <div class="col s5 m5 right-align">
                                <h5 class="mb-0">{{$properties}}</h5>
                                <p class="no-margin">Imóveis</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l3">
                    <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text">
                        <div class="padding-4">
                            <div class="col s7 m7">
                                <i class="material-icons background-round mt-5">attach_money</i>
                            </div>
                            <div class="col s5 m5 right-align">
                                <h5 class="mb-0">{{$contracts}}</h5>
                                <p class="no-margin">Contratos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--card stats end-->
    </div>
@endsection
