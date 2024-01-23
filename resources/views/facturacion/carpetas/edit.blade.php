@extends('layouts.main', ['activePage' => 'facturacionVerPacientes', 'titlePage' => 'Adjuntar Documentos'])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            Cargar Archivos
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('destroy'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('destroy') }}
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

                            <form action="{{ route('carpetas.guardar') }}" method="POST" enctype="multipart/form-data"
                                id="formularioAdjuntarArchivos">
                                <div class="form-row">
                                    <input type="hidden" class="form-control" name="id"
                                        @php $id=trim($carpeta->id); @endphp value="{{ $id ?? 'None' }}"
                                        placeholder="{{ $id ?? 'None' }}" readonly>

                                    <div class="form-group col-md-2">
                                        <label>Tipo Identificacion</label>
                                        <input type="text" class="form-control" name="TipoIdentificacion"
                                            @php
$tipoIdentificacion=trim($carpeta->MPTDoc); @endphp
                                            value="{{ $tipoIdentificacion ?? 'None' }}"
                                            placeholder="{{ $tipoIdentificacion ?? 'None' }}" readonly>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Numero Identificacion</label>
                                        <input type="text" class="form-control" name="NumeroIdentificacion"
                                            @php
$numeroIdentificacion=trim($carpeta->MPCEDU); @endphp
                                            value="{{ $numeroIdentificacion ?? 'None' }}"
                                            placeholder="{{ $numeroIdentificacion ?? 'None' }}" readonly>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Nombre Paciente</label>
                                        <input type="text" class="form-control" name="Nombre"
                                            @php
$nombre=trim($carpeta->MPNOMC); @endphp value="{{ $nombre ?? 'None' }}"
                                            placeholder="{{ $carpeta->MPNOMC ?? 'None' }}" readonly>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Fecha Admision</label>
                                        <input type="datetime" class="form-control" name="Fecha"
                                            @php
$fechaAdmision=\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                        $carpeta->IngFecAdm); @endphp
                                            value="{{ $fechaAdmision }}" readonly>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Numero Factura</label>
                                        <input type="text" class="form-control" name="NumeroFactura"
                                            @php
$factura=trim($carpeta->IngFac); @endphp value="{{ $factura ?? 'None' }}"
                                            placeholder="{{ $carpeta->IngFac ?? 'None' }}" readonly>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label>Codigo Contrato</label>
                                        <input type="text" class="form-control" name="ContratoId"
                                            @php
$contratoID=trim($carpeta->MENNIT); @endphp
                                            value="{{ $contratoID ?? 'None' }}" placeholder="{{ $carpeta->MENNIT }}"
                                            readonly>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label>Eps</label>
                                        <input type="text" class="form-control" name="Eps"
                                            @php $eps=trim($carpeta->MENOMB); @endphp value="{{ $eps ?? 'None' }}"
                                            placeholder="{{ $eps ?? 'None' }}" readonly>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Ingreso</label>
                                        <input type="text" class="form-control" name="ConsecutivoId"
                                            @php
$CscId=trim($carpeta->IngCsc); @endphp value="{{ $CscId ?? 'None' }}"
                                            placeholder="{{ $CscId ?? 'None' }}" readonly>
                                    </div>
                                </div>
                                <br>
                                @can('facturacion_soportes_adjuntar_adjuntar')
                                    <div class="d-flex justify-content-around">
                                        <div>
                                            <label>Seleccione Nombre Documento:</label>

                                            <select class="form-control col-md-11" name="nombreDocumento1">
                                                <option value="NULLL" selected>Ingrese Nombre Documento</option>
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="ADRES">ADRES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="ADRES">ADRES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="ANEXO 2">ANEXO 2</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="ANEXO 3">ANEXO 3</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_autorizacionesHos')
                                                    <option value="AUTORIZACION DE HOSPITALIZACION">AUTORIZACION DE HOSPITALIZACION
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="AUTORIZACION DE HOSPITALIZACION">AUTORIZACION DE HOSPITALIZACION
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="AUTORIZACION AMBULATORIA">AUTORIZACION AMBULATORIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="AUTORIZACION DE URGENCIA">AUTORIZACION DE URGENCIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="AUTORIZACION NO PBS">AUTORIZACION NO PBS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion_practicante')
                                                    <option value="CERTIFICADO DE ATENCION">CERTIFICADO DE ATENCION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="CERTIFICADO DE ATENCION">CERTIFICADO DE ATENCION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="CERTIFICADO EPS">CERTIFICADO EPS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="COMPROBADOR DE DERECHO">COMPROBADOR DE DERECHO</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="CONCILIACION">CONCILIACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_autorizacionesHos')
                                                    <option value="COTIZACION">COTIZACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="DEVOLUCIONES">DEVOLUCIONES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="FACTURA">FACTURA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="GLOSAS">GLOSAS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="GLUCOMETRIA">GLUCOMETRIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="HISTORIA CLINICA">HISTORIA CLINICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion_practicante')
                                                    <option value="HISTORIA CLINICA">HISTORIA CLINICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="HISTORIA CLINICA">HISTORIA CLINICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="HOJA DE GASTOS">HOJA DE GASTOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="HOJA DE MEDICAMENTOS">HOJA DE MEDICAMENTOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="HOJA DE LIQUIDOS">HOJA DE LIQUIDOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="IDENTIFICACION">IDENTIFICACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="IDENTIFICACION">IDENTIFICACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="INFORME QX">INFORME QX</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="INSUMOS">INSUMOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="MIPRES">MIPRES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="NOTA DE ENFERMERIA">NOTA DE ENFERMERIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="ORDEN MEDICA">ORDEN MEDICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="OXIGENO">OXIGENO</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="PLANEACION RADIOTERAPIA">PLANEACION RADIOTERAPIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="RECORD DE ANESTESIA">RECORD DE ANESTESIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="RESPUESTA A DEVOLUCIONES">RESPUESTA A DEVOLUCIONES
                                                    </option>
                                                @endcan
                                                @can('auditoria')
                                                    <option value="RESPUESTA A GLOSAS">RESPUESTA A GLOSAS
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="RIESGO Y PREVENCION DE CAIDAS">RIESGO Y PREVENCION DE CAIDAS
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="SISBEN">SISBEN</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="SISMUESTRA">SISMUESTRA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_autorizacionesHos')
                                                    <option value="SOLICITUD">SOLICITUD</option>
                                                @endcan
                                                <option value="SOPORTE">SOPORTE</option>
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="SOPORTE A DEVOLUCION">SOPORTE A DEVOLUCION
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="VISADO">VISADO</option>
                                                @endcan
                                            </select>
                                            <input type="file" name="adjunto1" accept="application/pdf" id="adjunto1">
                                        </div>

                                        <div>
                                            <label>Seleccione Nombre Documento:</label>

                                            <select class="form-control col-md-11" name="nombreDocumento2">
                                                <option value="NULLL" selected>Ingrese Nombre Documento</option>
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="ADRES">ADRES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="ADRES">ADRES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="ANEXO 2">ANEXO 2</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="ANEXO 3">ANEXO 3</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_autorizacionesHos')
                                                    <option value="AUTORIZACION DE HOSPITALIZACION">AUTORIZACION DE HOSPITALIZACION
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="AUTORIZACION DE HOSPITALIZACION">AUTORIZACION DE HOSPITALIZACION
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="AUTORIZACION AMBULATORIA">AUTORIZACION AMBULATORIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="AUTORIZACION DE URGENCIA">AUTORIZACION DE URGENCIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="AUTORIZACION NO PBS">AUTORIZACION NO PBS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion_practicante')
                                                    <option value="CERTIFICADO DE ATENCION">CERTIFICADO DE ATENCION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="CERTIFICADO DE ATENCION">CERTIFICADO DE ATENCION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="CERTIFICADO EPS">CERTIFICADO EPS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="COMPROBADOR DE DERECHO">COMPROBADOR DE DERECHO</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="CONCILIACION">CONCILIACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_autorizacionesHos')
                                                    <option value="COTIZACION">COTIZACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="DEVOLUCIONES">DEVOLUCIONES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="FACTURA">FACTURA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="GLOSAS">GLOSAS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="GLUCOMETRIA">GLUCOMETRIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="HISTORIA CLINICA">HISTORIA CLINICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion_practicante')
                                                    <option value="HISTORIA CLINICA">HISTORIA CLINICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="HISTORIA CLINICA">HISTORIA CLINICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="HOJA DE GASTOS">HOJA DE GASTOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="HOJA DE MEDICAMENTOS">HOJA DE MEDICAMENTOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="HOJA DE LIQUIDOS">HOJA DE LIQUIDOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="IDENTIFICACION">IDENTIFICACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="IDENTIFICACION">IDENTIFICACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="INFORME QX">INFORME QX</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="INSUMOS">INSUMOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="MIPRES">MIPRES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="NOTA DE ENFERMERIA">NOTA DE ENFERMERIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="ORDEN MEDICA">ORDEN MEDICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="OXIGENO">OXIGENO</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="PLANEACION RADIOTERAPIA">PLANEACION RADIOTERAPIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="RECORD DE ANESTESIA">RECORD DE ANESTESIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="RESPUESTA A DEVOLUCIONES">RESPUESTA A DEVOLUCIONES
                                                    </option>
                                                @endcan
                                                @can('auditoria')
                                                    <option value="RESPUESTA A GLOSAS">RESPUESTA A GLOSAS
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="RIESGO Y PREVENCION DE CAIDAS">RIESGO Y PREVENCION DE CAIDAS
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="SISBEN">SISBEN</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="SISMUESTRA">SISMUESTRA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_autorizacionesHos')
                                                    <option value="SOLICITUD">SOLICITUD</option>
                                                @endcan
                                                <option value="SOPORTE">SOPORTE</option>
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="SOPORTE A DEVOLUCION">SOPORTE A DEVOLUCION
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="VISADO">VISADO</option>
                                                @endcan
                                            </select>
                                            <input type="file" name="adjunto2" accept="application/pdf" id="adjunto2">

                                        </div>
                                    </div>
                                    <br>


                                    <div class="d-flex justify-content-around">
                                        <div>
                                            <label>Seleccione Nombre Documento:</label>

                                            <select class="form-control col-md-11" name="nombreDocumento3">
                                                <option value="NULLL" selected>Ingrese Nombre Documento</option>
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="ADRES">ADRES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="ADRES">ADRES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="ANEXO 2">ANEXO 2</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="ANEXO 3">ANEXO 3</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_autorizacionesHos')
                                                    <option value="AUTORIZACION DE HOSPITALIZACION">AUTORIZACION DE HOSPITALIZACION
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="AUTORIZACION DE HOSPITALIZACION">AUTORIZACION DE HOSPITALIZACION
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="AUTORIZACION AMBULATORIA">AUTORIZACION AMBULATORIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="AUTORIZACION DE URGENCIA">AUTORIZACION DE URGENCIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="AUTORIZACION NO PBS">AUTORIZACION NO PBS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion_practicante')
                                                    <option value="CERTIFICADO DE ATENCION">CERTIFICADO DE ATENCION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="CERTIFICADO DE ATENCION">CERTIFICADO DE ATENCION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="CERTIFICADO EPS">CERTIFICADO EPS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="COMPROBADOR DE DERECHO">COMPROBADOR DE DERECHO</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="CONCILIACION">CONCILIACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_autorizacionesHos')
                                                    <option value="COTIZACION">COTIZACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="DEVOLUCIONES">DEVOLUCIONES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="FACTURA">FACTURA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="GLOSAS">GLOSAS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="GLUCOMETRIA">GLUCOMETRIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="HISTORIA CLINICA">HISTORIA CLINICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion_practicante')
                                                    <option value="HISTORIA CLINICA">HISTORIA CLINICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="HISTORIA CLINICA">HISTORIA CLINICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="HOJA DE GASTOS">HOJA DE GASTOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="HOJA DE MEDICAMENTOS">HOJA DE MEDICAMENTOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="HOJA DE LIQUIDOS">HOJA DE LIQUIDOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="IDENTIFICACION">IDENTIFICACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="IDENTIFICACION">IDENTIFICACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="INFORME QX">INFORME QX</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="INSUMOS">INSUMOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="MIPRES">MIPRES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="NOTA DE ENFERMERIA">NOTA DE ENFERMERIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="ORDEN MEDICA">ORDEN MEDICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="OXIGENO">OXIGENO</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="PLANEACION RADIOTERAPIA">PLANEACION RADIOTERAPIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="RECORD DE ANESTESIA">RECORD DE ANESTESIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="RESPUESTA A DEVOLUCIONES">RESPUESTA A DEVOLUCIONES
                                                    </option>
                                                @endcan
                                                @can('auditoria')
                                                    <option value="RESPUESTA A GLOSAS">RESPUESTA A GLOSAS
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="RIESGO Y PREVENCION DE CAIDAS">RIESGO Y PREVENCION DE CAIDAS
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="SISBEN">SISBEN</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="SISMUESTRA">SISMUESTRA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_autorizacionesHos')
                                                    <option value="SOLICITUD">SOLICITUD</option>
                                                @endcan
                                                <option value="SOPORTE">SOPORTE</option>
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="SOPORTE A DEVOLUCION">SOPORTE A DEVOLUCION
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="VISADO">VISADO</option>
                                                @endcan
                                            </select>
                                            <input type="file" name="adjunto3" accept="application/pdf" id="adjunto3">

                                        </div>

                                        <div>
                                            <label>Seleccione Nombre Documento:</label>

                                            <select class="form-control col-md-11" name="nombreDocumento4">
                                                <option value="NULLL" selected>Ingrese Nombre Documento</option>
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="ADRES">ADRES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="ADRES">ADRES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="ANEXO 2">ANEXO 2</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="ANEXO 3">ANEXO 3</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_autorizacionesHos')
                                                    <option value="AUTORIZACION DE HOSPITALIZACION">AUTORIZACION DE HOSPITALIZACION
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="AUTORIZACION DE HOSPITALIZACION">AUTORIZACION DE HOSPITALIZACION
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="AUTORIZACION AMBULATORIA">AUTORIZACION AMBULATORIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="AUTORIZACION DE URGENCIA">AUTORIZACION DE URGENCIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="AUTORIZACION NO PBS">AUTORIZACION NO PBS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="CERTIFICADO DE ATENCION">CERTIFICADO DE ATENCION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion_practicante')
                                                    <option value="CERTIFICADO DE ATENCION">CERTIFICADO DE ATENCION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="CERTIFICADO EPS">CERTIFICADO EPS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="COMPROBADOR DE DERECHO">COMPROBADOR DE DERECHO</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="CONCILIACION">CONCILIACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_autorizacionesHos')
                                                    <option value="COTIZACION">COTIZACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="DEVOLUCIONES">DEVOLUCIONES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="FACTURA">FACTURA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="GLOSAS">GLOSAS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="GLUCOMETRIA">GLUCOMETRIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="HISTORIA CLINICA">HISTORIA CLINICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion_practicante')
                                                    <option value="HISTORIA CLINICA">HISTORIA CLINICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="HISTORIA CLINICA">HISTORIA CLINICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="HOJA DE GASTOS">HOJA DE GASTOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="HOJA DE MEDICAMENTOS">HOJA DE MEDICAMENTOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="HOJA DE LIQUIDOS">HOJA DE LIQUIDOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="IDENTIFICACION">IDENTIFICACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="IDENTIFICACION">IDENTIFICACION</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="INFORME QX">INFORME QX</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="INSUMOS">INSUMOS</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="MIPRES">MIPRES</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="NOTA DE ENFERMERIA">NOTA DE ENFERMERIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="ORDEN MEDICA">ORDEN MEDICA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="OXIGENO">OXIGENO</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="PLANEACION RADIOTERAPIA">PLANEACION RADIOTERAPIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_ambulatorio')
                                                    <option value="RECORD DE ANESTESIA">RECORD DE ANESTESIA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="RESPUESTA A DEVOLUCIONES">RESPUESTA A DEVOLUCIONES
                                                    </option>
                                                @endcan
                                                @can('auditoria')
                                                    <option value="RESPUESTA A GLOSAS">RESPUESTA A GLOSAS
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="RIESGO Y PREVENCION DE CAIDAS">RIESGO Y PREVENCION DE CAIDAS
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_admisiones')
                                                    <option value="SISBEN">SISBEN</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="SISMUESTRA">SISMUESTRA</option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_autorizacionesHos')
                                                    <option value="SOLICITUD">SOLICITUD</option>
                                                @endcan
                                                <option value="SOPORTE">SOPORTE</option>
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="SOPORTE A DEVOLUCION">SOPORTE A DEVOLUCION
                                                    </option>
                                                @endcan
                                                @can('facturacion_nombreDocumento_facturacion')
                                                    <option value="VISADO">VISADO</option>
                                                @endcan
                                            </select>
                                            <input type="file" name="adjunto4" accept="application/pdf" id="adjunto4">

                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        @csrf
                                        <input type="submit" value="Enviar" class="btn btn-lg btn-success">
                                    </div>
                                @endcan
                            </form>

                            <form action="{{ route('carpetas.crearCorte') }}" method="POST"
                                enctype="multipart/form-data" id="formularioCrearCorte">
                                <div class="form-row">
                                    <input type="hidden" class="form-control" name="id"
                                        @php $id=trim($carpeta->id); @endphp value="{{ $id ?? 'None' }}"
                                        placeholder="{{ $id ?? 'None' }}" readonly>

                                    <div class="form-group col-md-2">

                                        <input type="hidden" class="form-control" name="TipoIdentificacion"
                                            @php
$tipoIdentificacion=trim($carpeta->MPTDoc); @endphp
                                            value="{{ $tipoIdentificacion ?? 'None' }}"
                                            placeholder="{{ $tipoIdentificacion ?? 'None' }}" readonly>
                                    </div>

                                    <div class="form-group col-md-2">

                                        <input type="hidden" class="form-control" name="NumeroIdentificacion"
                                            @php
$numeroIdentificacion=trim($carpeta->MPCEDU); @endphp
                                            value="{{ $numeroIdentificacion ?? 'None' }}"
                                            placeholder="{{ $numeroIdentificacion ?? 'None' }}" readonly>
                                    </div>

                                    <div class="form-group col-md-4">

                                        <input type="hidden" class="form-control" name="Nombre"
                                            @php
$nombre=trim($carpeta->MPNOMC); @endphp value="{{ $nombre ?? 'None' }}"
                                            placeholder="{{ $carpeta->MPNOMC ?? 'None' }}" readonly>
                                    </div>

                                    <div class="form-group col-md-2">

                                        <input type="hidden" class="form-control" name="Fecha"
                                            @php
$fechaAdmision=\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                        $carpeta->IngFecAdm); @endphp
                                            value="{{ $fechaAdmision }}" readonly>
                                    </div>

                                    <div class="form-group col-md-2">

                                        <input type="hidden" class="form-control" name="NumeroFactura"
                                            @php
$factura=trim($carpeta->IngFac); @endphp
                                            value="{{ $factura ?? 'None' }}"
                                            placeholder="{{ $carpeta->IngFac ?? 'None' }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">

                                        <input type="hidden" class="form-control" name="ContratoId"
                                            @php
$contratoID=trim($carpeta->MENNIT); @endphp
                                            value="{{ $contratoID ?? 'None' }}" placeholder="{{ $carpeta->MENNIT }}"
                                            readonly>
                                    </div>

                                    <div class="form-group col-md-8">

                                        <input type="hidden" class="form-control" name="Eps"
                                            @php $eps=trim($carpeta->MENOMB); @endphp value="{{ $eps ?? 'None' }}"
                                            placeholder="{{ $eps ?? 'None' }}" readonly>
                                    </div>

                                    <div class="form-group col-md-2">

                                        <input type="hidden" class="form-control" name="ConsecutivoId"
                                            @php
$CscId=trim($carpeta->IngCsc); @endphp value="{{ $CscId ?? 'None' }}"
                                            placeholder="{{ $CscId ?? 'None' }}" readonly>
                                    </div>
                                </div>
                                @can('facturacion_coordinacion')
                                    <div class="d-flex justify-content-center">
                                        @csrf
                                        <input type="submit" value="Crear Corte" class="btn btn-lg btn-success">
                                    </div>
                                @endcan
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-primary">
                            Soportes Adjuntos
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table display compact" id="listadoArchivos" style="width:100%">
                                    <thead class="text-primary">
                                        <th>Nombre Archivo</th>
                                        <th>Guardado Por</th>
                                        <th>Fecha Guardado</th>
                                        <th class="text-right">Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($archivos as $archivo)
                                            <tr>
                                                <td><a href="../../Archivos/{{ $ruta2 }}/{{ $archivo->nombre_Archivo }}"
                                                        target="_blank">{{ $archivo->nombre_Archivo }}</a></td>
                                                <td>{{ $archivo->usuario }}</td>
                                                <td>{{ \Carbon\Carbon::parse($archivo->fecha_Guardado)->format('d/m/Y') }}
                                                </td>
                                                <td class="td-actions text-right">
                                                    @can('facturacion_digitalizacion')
                                                        <a href="{{ route('carpetas.descargarFactura', $archivo) }}"
                                                            class="btn btn-success"><i
                                                                class="material-icons">visibility</i>Descargar</a>
                                                    @endcan

                                                    @can('facturacion_coordinacion')
                                                        <a href="#" class="btn btn-info" data-toggle="modal"
                                                            data-target="#seleccionarCarpetaModal"
                                                            onclick="cargarCarpetas('{{ $archivo->id }}')">
                                                            <i class="material-icons">visibility</i>Mover
                                                        </a>
                                                    @endcan

                                                    <form action="{{ route('destroyArchivo.delete', $archivo->id) }}"
                                                        method="POST" style="display: inline-block;"
                                                        onsubmit="return confirm('¿Seguro Que Quieres Eliminar El Documento?')">

                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" class="form-control" name="idPaciente"
                                                            @php
$idPaciente=trim($carpeta->id); @endphp
                                                            value="{{ $idPaciente ?? 'None' }}"
                                                            placeholder="{{ $idPaciente ?? 'None' }}" readonly>
                                                        <input type="hidden" class="form-control" name="idArchivo"
                                                            @php
$idArchivo=trim($archivo->id); @endphp
                                                            value="{{ $idArchivo ?? 'None' }}"
                                                            placeholder="{{ $idArchivo ?? 'None' }}" readonly>
                                                        <input type="hidden" class="form-control" name="rutaArchivo"
                                                            @php
$rutaArchivo=trim($archivo->ruta);
                                                $rutaArchivoSin = substr($rutaArchivo, 2, -1);
                                                $rutaArchivoSin = str_replace('\\', '\\\\', $rutaArchivoSin); @endphp
                                                            value="{{ $archivo->ruta }}{{ $archivo->nombre_Archivo }}"
                                                            placeholder="{{ $rutaArchivo ?? 'None' }}" readonly>

                                                        @if (trim(auth()->user()->username) == trim($archivo->usuario) or
                                                                trim(auth()->user()->username) == trim('DANBOL') or
                                                                trim(auth()->user()->username) == trim('FLAREVO') or
                                                                trim(auth()->user()->username) == trim('JACPERE'))
                                                            <input type="submit" value="Eliminar"
                                                                class="btn btn-danger">
                                                        @endif
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    @can('facturacion_alistamiento')
                        <div class="card">
                            <div class="card-header card-header-primary">
                                Alistar Soportes Adjuntos
                            </div>
                            <div class="container">
                                <div class="row mt-3">
                                    <div class="col-5 my-4">
                                        <h2>Alistar</h2>
                                        <div class="list-group" id="listado_Archivos">
                                            @foreach ($archivos as $archivo)
                                                <div class="list-group-item mb-0" data-id="{{ $archivo->id }}">
                                                    <li style="list-style-type: none;">
                                                        <i class="fass material-icons mr-2">swap_vert</i>
                                                        <a href="{{ $archivo->ruta }}{{ $archivo->nombre_Archivo }}"
                                                            target="_blank">{{ $archivo->nombre_Archivo }}</a>
                                                    </li>
                                                </div>
                                            @endforeach
                                        </div>

                                        <form id="formularioUnirPdf">
                                            @csrf
                                            <div><label for="numeroFactura">Numero De Factura</label>

                                                <input type="text" id="numeroFactura" name="numeroFactura" required
                                                    minlength="4" maxlength="50" size="50">
                                            </div>
                                            <button class="btn btn-sm btn-primary" type="submit">Unir PDF</button>
                                        </form>
                                    </div>
                                    <div class="col-5 my-4">
                                        <h2>No Alistar</h2>
                                        <div class="list-group" id="listado_Archivos_SinConcatenar">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan

                    @can('facturacion_coordinacion')
                        <div class="card">
                            <div class="card-header card-header-primary">
                                Cortes
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table display compact" id="listadoCarpetasArchivos" style="width:100%">
                                        <thead class="text-primary">
                                            <th>Nombre Carpeta</th>
                                            <th class="text-right">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($carpetas as $carpeta)
                                                <tr>
                                                    <td>{{ $carpeta }}</td>
                                                    <td class="td-actions text-right">
                                                        @can('facturacion_digitalizacion')
                                                            <a href="#" class="btn btn-info" data-toggle="modal"
                                                                data-target="#verContenidoModal"
                                                                onclick="cargarArchivosCarpetas('{{ request()->segment(2) }}','{{ $carpeta }}')">
                                                                <i class="material-icons">visibility</i>Ver Contenido Carpeta
                                                            </a>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endcan

                </div>
            </div>
        </div>
    </div>
    <!-- Agrega esto a tu vista Blade para el modal -->
    <form action="{{ route('moverArchivoCortes') }}" method="GET" id="moverArchivosForm">
        @csrf
        <!-- ... tu código para el campo de selección y el botón Mover ... -->
        <!-- Modal para seleccionar la carpeta de destino -->
        <div class="modal fade" id="seleccionarCarpetaModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Seleccionar Carpeta de Destino</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se cargarán dinámicamente las carpetas disponibles -->
                        <label for="carpetaDestino">Selecciona la Carpeta de Destino:</label>
                        <select name="carpetaDestino" id="carpetaDestino" class="form-control">
                            <!-- Las carpetas se cargarán aquí mediante JavaScript -->
                        </select>
                        <input type="hidden" name="rutaCarpetaDestino" id="rutaCarpetaDestino">
                        <input type="hidden" name="idArchivo" id="idArchivo">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Mover Archivos</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal para ver contenido de la carpeta -->
    <div class="modal fade" id="verContenidoModal" tabindex="-1" role="dialog"
        aria-labelledby="verContenidoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verContenidoModalLabel">Contenido de la Carpeta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contenidoCarpeta">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Archivo</th>
                                    <th class="text-right">Acciones</th>
                                    <!-- Puedes agregar más columnas según tus necesidades -->
                                </tr>
                            </thead>
                            <tbody id="contenidoCarpetaTabla">
                                <!-- Aquí se agregarán las filas de la tabla dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                    <div id="rutaCarpeta"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Función para inicializar las listas ordenables
        function inicializarOrdenArchivos() {
            // Variables para el id y la ruta del archivo
            var id = {!! $id !!};
            var ruta = "{!! $rutaArchivoSin !!}";
            let ordenArchivos;

            // Obtener referencias a las listas
            var listado_Archivos = document.getElementById('listado_Archivos');
            var listado_Archivos_SinConcatenar = document.getElementById('listado_Archivos_SinConcatenar');

            // Crear lista ordenable para listado_Archivos
            var listado_Archivos_Informacion = Sortable.create(listado_Archivos, {
                // Configuraciones de la lista ordenable
                group: {
                    name: "Listado_Archivos",
                },
                animation: 300,
                easing: "cubic-bezier(0.7, 0, 0.84, 0)",
                handle: ".fass",
                ghostClass: "active",
                // Configuración del almacenamiento local para mantener el orden
                store: {
                    set: function(sortable) {
                        // Actualizar el orden en el almacenamiento local
                        ordenArchivos = [];
                        var orden = sortable.toArray();
                        localStorage.setItem("lista-archivos", orden.join("|"));
                        orden.forEach(element => {
                            // Obtener la ruta del archivo y agregarla a ordenArchivos
                            var elemento = document.querySelector('[data-id="' + element + '"]');
                            if (elemento) {
                                const li = elemento.children[0];
                                const a = li.children[1];
                                const path = a.getAttribute("href");
                                ordenArchivos.push(path);
                            }
                        });
                        localStorage.setItem("archivosOrdenados", JSON.stringify(ordenArchivos));
                    },
                    get: function(sortable) {
                        // Obtener el orden almacenado en el almacenamiento local
                        var orden = localStorage.getItem("lista-archivos");
                        return orden ? orden.split("|") : [];
                    }
                }
            });

            // Crear lista ordenable para listado_Archivos_SinConcatenar
            Sortable.create(listado_Archivos_SinConcatenar, {
                group: {
                    name: "Listado_Archivos",
                },
                animation: 300,
                easing: "cubic-bezier(0.7, 0, 0.84, 0)",
                handle: ".fass",
                ghostClass: "active",
            });
        }

        // Función para mover archivos sin orden
        function moverArchivosSinOrden() {
            document.getElementById('moverArchivosBtn').addEventListener('click', function() {
                const archivosOrdenados = localStorage.getItem('archivosOrdenados');

                if (archivosOrdenados) {
                    const archivos = JSON.parse(archivosOrdenados);

                    archivos.forEach(archivo => {
                        const elemento = document.querySelector('[data-id="' + archivo + '"]');
                        if (elemento) {
                            listado_Archivos_SinConcatenar.appendChild(elemento);
                        }
                    });

                    listado_Archivos.innerHTML = '';
                }
            });
        }

        // Manejar la submisión del formulario de unión de PDF
        $('#formularioUnirPdf').on('submit', function(e) {
            e.preventDefault();
            const ordenNuevo = localStorage.getItem('archivosOrdenados');
            var numeroFactura = document.getElementById("numeroFactura").value;
            $.ajax({
                url: "/clinicamc/public/unirPdf",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    orden: JSON.parse(ordenNuevo),
                    id: id,
                    ruta: ruta,
                    factura: numeroFactura,
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(response) {
                    console.log(response);
                },
            });
        });
    </script>

    {{-- Validar que solo se puedan cargar archivos en formato PDF --}}
    <script>
        // Función para validar los tipos de archivos
        function validarArchivos() {
            const allowedTypes = ['application/pdf'];
            const inputs = ['adjunto1', 'adjunto2', 'adjunto3', 'adjunto4'];
            let error = false; // Variable para indicar si hay algún error

            for (let i = 0; i < inputs.length; i++) {
                const fileInput = document.getElementById(inputs[i]);
                const file = fileInput.files[0];

                // Si el archivo existe y su tipo no está permitido, muestra una alerta y resetea el input
                if (file && !allowedTypes.includes(file.type)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tipo de archivo no permitido',
                        text: `Solo se permiten archivos en formato PDF para ${fileInput.id}.`,
                        confirmButtonText: 'OK'
                    });
                    fileInput.value = ''; // Resetear el input de archivo
                    error = true; // Indicar que hay un error
                }
            }
            return !error; // Retorna verdadero si no hay errores, falso si hay algún error
        }

        // Agregar un evento de escucha para la submisión del formulario de adjuntar archivos
        document.getElementById('formularioAdjuntarArchivos').addEventListener('submit', (event) => {
            event.preventDefault();
            // Continuar con el envío del formulario si no hay errores de validación
            if (validarArchivos()) {
                event.target.submit(); // Envía el formulario si no hay errores
            } else {
                // Espera a que se corrijan los errores
            }
        });
    </script>

    <script>
        // Función para cargar las carpetas disponibles
        function cargarCarpetas(rutaArchivo) {
            console.log(rutaArchivo);

            // Llamada AJAX para obtener las carpetas disponibles
            $.ajax({
                url: '{{ route('obtenerCarpetasCortes') }}',
                type: 'GET',
                data: {
                    rutaArchivo: rutaArchivo
                },
                success: function(data) {
                    console.log("la respuesta", data);

                    // Verificar si data.carpetas es un objeto y convertirlo a un arreglo
                    var carpetasArray = Array.isArray(data.carpetas) ?
                        data.carpetas :
                        Object.values(data.carpetas);

                    var archivosArray = Array.isArray(data.rutaCarpetas) ?
                        data.rutaCarpetas :
                        Object.values(data.rutaCarpetas);

                    // Establecer valores en los campos de formulario
                    $('#rutaCarpetaDestino').val(data.rutaCarpetas);
                    $('#idArchivo').val(data.rutaArchivos);

                    // Limpiar el contenido actual del select
                    $('#carpetaDestino').empty();

                    // Agregar las opciones al select
                    $.each(carpetasArray, function(index, carpeta) {
                        var archivo = archivosArray[index];
                        // Asignar un valor único basado en la posición del elemento en el array
                        $('#carpetaDestino').append('<option value="' + carpeta + '">' + carpeta +
                            '</option>');
                    });
                },
                error: function(error) {
                    console.error('Error al cargar las carpetas:', error);
                }
            });
        }
    </script>

    <script>
        function cargarArchivosCarpetas(rutaArchivo, carpeta) {
            $.ajax({
                url: '{{ route('obtenerContenidoCarpeta') }}',
                type: 'GET',
                data: {
                    rutaArchivo: rutaArchivo,
                    carpeta: carpeta
                },
                success: function(data) {
                    console.log(data.idPaciente);
                    var contenidoLista = $('#contenidoCarpetaTabla');
                    contenidoLista.empty();

                    $.each(data.contenido, function(index, elemento) {
                        // Eliminar C:/laragon/www/clinicamc/public/ de data.rutaCarpeta si está presente
                        var rutaCarpetaSinInicio = data.rutaCarpeta.replace(/^.*public\//, '');

                        var rutaCompleta = data.rutaCarpeta + carpeta + '/' + elemento;
                        // Construir la fila de la tabla
                        var filaHTML = '<tr>';
                        filaHTML += '<td>' + elemento +
                            '</td>';
                        filaHTML += '<td class="text-right">';

                        // Agrega el botón de descarga para cada archivo
                        filaHTML += '<button class="btn btn-success" onclick = "descargarArchivo(\'' +
                            elemento + '\', \'' + data.idPaciente + '\')" > Descargar </button>';

                        filaHTML += '</td>';
                        filaHTML += '</tr>';
                        // Agregar la fila a la tabla
                        $('#contenidoCarpetaTabla').append(filaHTML);
                    });

                    // Abrir el modal
                    $('#verContenidoModal').modal('show');
                },
                error: function(error) {
                    console.error('Error al cargar los archivos de la carpeta:', error);
                }
            });
        }
    </script>

    <script>
        function descargarArchivo(nombreArchivo, idPaciente) {
            // Construir la URL de descarga
            var urlDescarga = '{{ route('descargarFacturaCortes') }}' +
                '?nombreArchivo=' + encodeURIComponent(nombreArchivo) +
                '&idPaciente=' + encodeURIComponent(idPaciente);

            // Cambiar la ubicación del navegador para iniciar la descarga
            window.location.href = urlDescarga;
        }
    </script>

    // Notificación SweetAlert en caso de que la sesión tenga un mensaje específico
    @if (session('adjuntar') == 'Debes adjuntar Algo')
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'No has adjuntado ningún documento',
                text: 'Debes adjuntar al menos un documento...!'
            })
        </script>
    @endif
@endsection
