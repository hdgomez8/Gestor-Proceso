@extends('layouts.main', ['activePage' => 'facturacionRips', 'titlePage' => 'Rips'])
@section('content')

    @can('facturacion_soportes_adjuntar')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title">RIPS</h4>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary text-center">
                                                <th>Tipo Documento</th>
                                                <th>Numero Documento</th>
                                                <th>Nombre Paciente</th>
                                                <th>Nombre Empresa</th>
                                                <th>Fecha Admision</th>
                                                <th>Consecutivo De Ingreso</th>
                                                <th>Factura</th>
                                                <th>Remision</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($carpetas as $carpeta)
                                                    <tr>
                                                        <td>{{ $carpeta->MPTDoc ?? null }}</td>
                                                        <td>{{ $carpeta->MPCEDU ?? null }}</td>
                                                        <td>{{ $carpeta->MPNOMC ?? 'None' }}</td>
                                                        <td>{{ $carpeta->MENOMB ?? 'None' }}</td>
                                                        <td>{{ $carpeta->IngFecAdm ?? null }}</td>
                                                        <td>{{ $carpeta->IngCsc ?? null }}</td>
                                                        <td>{{ $carpeta->IngFac ?? null }}</td>
                                                        <td>{{ $carpeta->REMISION ?? null }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    @can('facturacion_digitalizacion')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title">Buscar Facturas</h4>
                                    </div>
                                    <form action="{{ route('carpetas.buscarFactura') }}" method="post">
                                        @csrf
                                        <div class="card-body">
                                            @if (session('success'))
                                                <div class="alert alert-success" role="success">
                                                    {{ session('success') }}
                                                </div>
                                            @endif

                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="row justify-content-right">

                                                <label for="name" class="col-sm-2 col-form-label">Numero Factura</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="numeroFactura"
                                                        placeholder="Ingrese Numero Factura"
                                                        value="{{ old('numeroFactura') }}" autofocus>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center my-1">
                                                <div class="col-2 text-right">
                                                    <input type="submit" value="BUSCAR" class="btn btn-sm"
                                                        style="background:#0EA0A7; color:white;">
                                                </div>
                                            </div>
                                    </form>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary text-center">
                                                <th>Tipo ID</th>
                                                <th>Numero Documento</th>
                                                <th>Nombre Paciente</th>
                                                <th>Nombre Empresa</th>
                                                <th>Fecha Admision</th>
                                                <th>Numero Factura</th>
                                                <th>Acciones</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($archivos as $archivo)
                                                    <tr>
                                                        <td>{{ $archivo->paciente->MPTDoc ?? null }}</td>
                                                        <td>{{ $archivo->paciente->MPCEDU ?? null }}</td>
                                                        <td>{{ $archivo->paciente->MPNOMC ?? null }}</td>
                                                        <td>{{ $archivo->paciente->MENOMB ?? 'None' }}</td>
                                                        <td>{{ $archivo->paciente->IngFecAdm ?? null }}</td>
                                                        <td>{{ $archivo->nombre_Archivo ?? null }}</td>
                                                        <td class="td-actions text-right">
                                                            <div class="btn-group">
                                                                <a href="{{ route('carpetas.descargarFactura', $archivo) }}"
                                                                    class="btn btn-success"><i
                                                                        class="material-icons">visibility</i>Descargar</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    </div>
@endsection
