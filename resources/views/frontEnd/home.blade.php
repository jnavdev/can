 @extends('frontLayout.master')

 @section('content')
    <div class="row state-overview">
        <div class="col-lg-4 col-sm-6">
            <a href="{{ url('nuevo-negocio') }}">
                <section class="panel purple">
                    <div class="symbol">
                        <i class="fa fa-send"></i>
                    </div>
                    <div class="value white">
                        <p>Nuevo Negocio</p>
                    </div>
                </section>
            </a>
        </div>
        <div class="col-lg-4 col-sm-6">
            <a href="{{ url('crear-cliente') }}">
                <section class="panel blue">
                    <div class="symbol blue">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value gray">
                        <p>Nuevo Cliente</p>
                    </div>
                </section>
            </a>
        </div>
        <div class="col-lg-4 col-sm-6">
            <a href="{{ url('cotizacion-simple') }}">
                <section class="panel green">
                    <div class="symbol ">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="value white">
                        <p>Nueva Cotización</p>
                    </div>
                </section>
            </a>
        </div>
    </div>
    <!--state overview end-->

    <div class="row">
        <div class="col-md-12">
            <section class="panel" id="block-panel">
                <header class="panel-heading head-border">
                    Negocios los últimos 30 días
                </header>
                <div class="panel-body">
                    @if ($dealsLast30Days->count() > 0)
                        <ul class="container col-md-12">
                            <li class=" col-md-6 col-sm-12 col-xs-12" style="width: 50%;">
                                <div class="easy-pie-chart">
                                    <div class="iphone-visitor"><span>{{ round(($dealsLast30Days->where('deal_state_id', 2)->count() * 100) / $dealsLast30Days->count()) }}</span>%</div>
                                </div>
                                <div class="visit-title ">
                                    <span>Vigentes</span>
                                </div>
                            </li>
                            <li class=" col-md-6 col-sm-12 col-xs-12" style="width: 50%;">
                                <div class="easy-pie-chart">
                                    <div class="iphone-visitor"><span>{{ round(($dealsLast30Days->where('deal_state_id', 3)->count() * 100) / $dealsLast30Days->count()) }}</span>%</div>
                                </div>
                                <div class="visit-title ">
                                    <span>Cerrados</span>
                                </div>
                            </li>
                        </ul>
                    @else
                        <p>¡Sin registros!</p>
                    @endif
                </div>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <section class="panel post-wrap pro-box team-member">
                <aside>
                    <header class="panel-heading head-border">
                        Ranking clientes
                    </header>
                    <div class="post-info">
                        <ul class="team-list cycle-pager external">
                            @foreach ($rankingClients as $client)
                                <li>
                                    <a href="javascript:;">
                                        <span class="thumb-small">
                                            <img class="circle" src="{{ asset('uploads/users/avatar.png') }}" alt=""/>
                                            <i class="online dot"></i>
                                        </span>
                                        <span class="name">{{ $client->full_name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </section>
        </div>

        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading head-border">
                    Negocios año {{ Carbon\Carbon::now()->year }}
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="sale-monitor">
                                @php
                                    $enero = App\Deal::whereMonth('created_at', 1)->whereYear('created_at', Carbon\Carbon::now()->year)->count();
                                   
                                    $febrero = App\Deal::whereMonth('created_at', 2)->whereYear('created_at', Carbon\Carbon::now()->year)->count();

                                    $marzo = App\Deal::whereMonth('created_at', 3)->whereYear('created_at', Carbon\Carbon::now()->year)->count();

                                    $abril = App\Deal::whereMonth('created_at', 4)->whereYear('created_at', Carbon\Carbon::now()->year)->count();

                                    $mayo = App\Deal::whereMonth('created_at', 5)->whereYear('created_at', Carbon\Carbon::now()->year)->count();

                                    $junio = App\Deal::whereMonth('created_at', 6)->whereYear('created_at', Carbon\Carbon::now()->year)->count();

                                    $julio = App\Deal::whereMonth('created_at', 7)->whereYear('created_at', Carbon\Carbon::now()->year)->count();

                                    $agosto = App\Deal::whereMonth('created_at', 8)->whereYear('created_at', Carbon\Carbon::now()->year)->count();

                                    $septiembre = App\Deal::whereMonth('created_at', 9)->whereYear('created_at', Carbon\Carbon::now()->year)->count();

                                    $octubre = App\Deal::whereMonth('created_at', 10)->whereYear('created_at', Carbon\Carbon::now()->year)->count();

                                    $noviembre = App\Deal::whereMonth('created_at', 11)->whereYear('created_at', Carbon\Carbon::now()->year)->count();

                                    $diciembre = App\Deal::whereMonth('created_at', 12)->whereYear('created_at', Carbon\Carbon::now()->year)->count();
                                @endphp
                                
                                <div class="states" style="width: 100%">
                                    <div class="info">
                                        <div class="desc pull-left">Enero</div>
                                        <div class="percent pull-right">Cantidad: {{ $enero }} (@if ($enero > 0) {{ round(($enero * 100) / $totalDeals) }} @else 0 @endif %)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="@if ($enero > 0) {{ round(($enero * 100) / $totalDeals) }} @else 0 @endif" aria-valuemin="0" aria-valuemax="100" style="width: @if ($enero > 0) {{ round(($enero * 100) / $totalDeals).'%' }} @else 0% @endif">
                                            <span class="sr-only">@if ($enero > 0) {{ round(($enero * 100) / $totalDeals) }} @else 0 @endif</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="states" style="width: 100%">
                                    <div class="info">
                                        <div class="desc pull-left">Febrero</div>
                                        <div class="percent pull-right">Cantidad: {{ $febrero }} (@if ($febrero > 0) {{ round(($febrero * 100) / $totalDeals) }} @else 0 @endif %)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="@if ($febrero > 0) {{ round(($febrero * 100) / $totalDeals) }} @else 0 @endif" aria-valuemin="0" aria-valuemax="100" style="width: @if ($febrero > 0) {{ round(($febrero * 100) / $totalDeals).'%' }} @else 0% @endif">
                                            <span class="sr-only">@if ($febrero > 0) {{ round(($febrero * 100) / $totalDeals) }} @else 0 @endif</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="states" style="width: 100%">
                                    <div class="info">
                                        <div class="desc pull-left">Marzo</div>
                                        <div class="percent pull-right">Cantidad: {{ $marzo }} (@if ($marzo > 0) {{ round(($marzo * 100) / $totalDeals) }} @else 0 @endif %)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="@if ($marzo > 0) {{ round(($marzo * 100) / $totalDeals) }} @else 0 @endif" aria-valuemin="0" aria-valuemax="100" style="width: @if ($marzo > 0) {{ round(($marzo * 100) / $totalDeals).'%' }} @else 0% @endif">
                                            <span class="sr-only">@if ($marzo > 0) {{ round(($marzo * 100) / $totalDeals) }} @else 0 @endif</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="states" style="width: 100%">
                                    <div class="info">
                                        <div class="desc pull-left">Abril</div>
                                        <div class="percent pull-right">Cantidad: {{ $abril }} (@if ($abril > 0) {{ round(($abril * 100) / $totalDeals) }} @else 0 @endif %)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="@if ($abril > 0) {{ round(($abril * 100) / $totalDeals) }} @else 0 @endif" aria-valuemin="0" aria-valuemax="100" style="width: @if ($abril > 0) {{ round(($abril * 100) / $totalDeals).'%' }} @else 0% @endif">
                                            <span class="sr-only">@if ($abril > 0) {{ round(($abril * 100) / $totalDeals) }} @else 0 @endif</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="states" style="width: 100%">
                                    <div class="info">
                                        <div class="desc pull-left">Mayo</div>
                                        <div class="percent pull-right">Cantidad: {{ $mayo }} (@if ($mayo > 0) {{ round(($mayo * 100) / $totalDeals) }} @else 0 @endif %)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="@if ($mayo > 0) {{ round(($mayo * 100) / $totalDeals) }} @else 0 @endif" aria-valuemin="0" aria-valuemax="100" style="width: @if ($mayo > 0) {{ round(($mayo * 100) / $totalDeals).'%' }} @else 0% @endif">
                                            <span class="sr-only">@if ($mayo > 0) {{ round(($mayo * 100) / $totalDeals) }} @else 0 @endif</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="states" style="width: 100%">
                                    <div class="info">
                                        <div class="desc pull-left">Junio</div>
                                        <div class="percent pull-right">Cantidad: {{ $junio }} (@if ($junio > 0) {{ round(($junio * 100) / $totalDeals) }} @else 0 @endif %)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="@if ($junio > 0) {{ round(($junio * 100) / $totalDeals) }} @else 0 @endif" aria-valuemin="0" aria-valuemax="100" style="width: @if ($junio > 0) {{ round(($junio * 100) / $totalDeals).'%' }} @else 0% @endif">
                                            <span class="sr-only">@if ($junio > 0) {{ round(($junio * 100) / $totalDeals) }} @else 0 @endif</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="states" style="width: 100%">
                                    <div class="info">
                                        <div class="desc pull-left">Julio</div>
                                        <div class="percent pull-right">Cantidad: {{ $julio }} (@if ($julio > 0) {{ round(($julio * 100) / $totalDeals) }} @else 0 @endif %)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="@if ($julio > 0) {{ round(($julio * 100) / $totalDeals) }} @else 0 @endif" aria-valuemin="0" aria-valuemax="100" style="width: @if ($julio > 0) {{ round(($julio * 100) / $totalDeals).'%' }} @else 0% @endif">
                                            <span class="sr-only">@if ($julio > 0) {{ round(($julio * 100) / $totalDeals) }} @else 0 @endif</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="states" style="width: 100%">
                                    <div class="info">
                                        <div class="desc pull-left">Agosto</div>
                                        <div class="percent pull-right">Cantidad: {{ $agosto }} (@if ($agosto > 0) {{ round(($agosto * 100) / $totalDeals) }} @else 0 @endif %)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="@if ($agosto > 0) {{ round(($agosto * 100) / $totalDeals) }} @else 0 @endif" aria-valuemin="0" aria-valuemax="100" style="width: @if ($agosto > 0) {{ round(($agosto * 100) / $totalDeals).'%' }} @else 0% @endif">
                                            <span class="sr-only">@if ($agosto > 0) {{ round(($agosto * 100) / $totalDeals) }} @else 0 @endif</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="states" style="width: 100%">
                                    <div class="info">
                                        <div class="desc pull-left">Septiembre</div>
                                        <div class="percent pull-right">Cantidad: {{ $septiembre }} (@if ($septiembre > 0) {{ round(($septiembre * 100) / $totalDeals) }} @else 0 @endif %)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="@if ($septiembre > 0) {{ round(($septiembre * 100) / $totalDeals) }} @else 0 @endif" aria-valuemin="0" aria-valuemax="100" style="width: @if ($septiembre > 0) {{ round(($septiembre * 100) / $totalDeals).'%' }} @else 0% @endif">
                                            <span class="sr-only">@if ($septiembre > 0) {{ round(($septiembre * 100) / $totalDeals) }} @else 0 @endif</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="states" style="width: 100%">
                                    <div class="info">
                                        <div class="desc pull-left">Octubre</div>
                                        <div class="percent pull-right">Cantidad: {{ $octubre }} (@if ($octubre > 0) {{ round(($octubre * 100) / $totalDeals) }} @else 0 @endif %)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="@if ($octubre > 0) {{ round(($octubre * 100) / $totalDeals) }} @else 0 @endif" aria-valuemin="0" aria-valuemax="100" style="width: @if ($octubre > 0) {{ round(($octubre * 100) / $totalDeals).'%' }} @else 0% @endif">
                                            <span class="sr-only">@if ($octubre > 0) {{ round(($octubre * 100) / $totalDeals) }} @else 0 @endif</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="states" style="width: 100%">
                                    <div class="info">
                                        <div class="desc pull-left">Noviembre</div>
                                        <div class="percent pull-right">Cantidad: {{ $noviembre }} (@if ($noviembre > 0) {{ round(($noviembre * 100) / $totalDeals) }} @else 0 @endif %)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="@if ($noviembre > 0) {{ round(($noviembre * 100) / $totalDeals) }} @else 0 @endif" aria-valuemin="0" aria-valuemax="100" style="width: @if ($noviembre > 0) {{ round(($noviembre * 100) / $totalDeals).'%' }} @else 0% @endif">
                                            <span class="sr-only">@if ($noviembre > 0) {{ round(($noviembre * 100) / $totalDeals) }} @else 0 @endif</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="states" style="width: 100%">
                                    <div class="info">
                                        <div class="desc pull-left">Diciembre</div>
                                        <div class="percent pull-right">Cantidad: {{ $diciembre }} (@if ($diciembre > 0) {{ round(($diciembre * 100) / $totalDeals) }} @else 0 @endif %)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="@if ($diciembre > 0) {{ round(($diciembre * 100) / $totalDeals) }} @else 0 @endif" aria-valuemin="0" aria-valuemax="100" style="width: @if ($diciembre > 0) {{ round(($diciembre * 100) / $totalDeals).'%' }} @else 0% @endif">
                                            <span class="sr-only">@if ($diciembre > 0) {{ round(($diciembre * 100) / $totalDeals) }} @else 0 @endif</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection