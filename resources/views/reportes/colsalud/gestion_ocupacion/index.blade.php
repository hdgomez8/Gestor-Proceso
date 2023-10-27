@extends('layouts.main', ['activePage' => 'ReportesIndexColsaludGestionOcupacion', 'titlePage' => 'ReportesIndexColsaludGestionOcupacion'])
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>
<link href="{{ asset('css/estilos.css') }}" rel="stylesheet" />

<style>
    .clase-gris {
        display: inline-block;
        /* Ajusta el espacio entre el texto y el borde */
        color: gray;
        font-weight: bold;
    }

    .clase-morado {
        display: inline-block;
        /* Ajusta el espacio entre el texto y el borde */
        color: purple;
        font-weight: bold;
    }

    .clase-rojo {
        display: inline-block;
        /* Ajusta el espacio entre el texto y el borde */
        color: red;
        font-weight: bold;
    }

    .clase-rosado {
        display: inline-block;
        /* Aplica un radio del 50% para que sea ovalado */
        /* Ajusta el espacio entre el texto y el borde */
        color: #f02894;
        font-weight: bold;
    }

    .clase-azul {
        display: inline-block;
        /* Aplica un radio del 50% para que sea ovalado */
        /* Ajusta el espacio entre el texto y el borde */
        color: blue;
        font-weight: bold;
    }

    .clase-verde {
        display: inline-block;
        /* Aplica un radio del 50% para que sea ovalado */
        /* Ajusta el espacio entre el texto y el borde */
        color: green;
        font-weight: bold;
    }

    .clase-clinica {
        display: inline-block;
        /* Aplica un radio del 50% para que sea ovalado */
        /* Ajusta el espacio entre el texto y el borde */
        color: #373737;
    }

    table.dataTable>thead>tr>th:not(.sorting_disabled),
    table.dataTable>thead>tr>td:not(.sorting_disabled) {
        padding-right: 0px;
    }

    table.dataTable.compact thead th,
    table.dataTable.compact thead td {
        padding: 4px 0px;
    }

    .main-panel>.content {
        margin-top: 0;
        /* Elimina el margen superior */
        padding: 5px 15px;
    }

    /* Estilo para el texto en las celdas de la tabla */
    #interconsultas-table td,
    #interconsultas-table2 td,
    #interconsultas-table3 td,
    #interconsultas-table4 td,
    #interconsultas-table5 td,
    #interconsultas-table6 td {
        font-size: 10px;
        /* Ajusta el tamaño de fuente según tus preferencias */
    }

    /* Estilo para el texto en el encabezado de la tabla */
    #interconsultas-table th,
    #interconsultas-table2 th,
    #interconsultas-table3 th,
    #interconsultas-table4 th,
    #interconsultas-table5 th,
    #interconsultas-table6 th {
        font-size: 12px;
        /* Ajusta el tamaño de fuente según tus preferencias */
    }
</style>

<input type="hidden" id="nombreUsuario" value="{{ Auth::user()->username }}">


<div class="content vista" id="vista1">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-2">
            <p class="clase-rosado">ONCOLOGÍA</p>
        </div>
        <div class="col-md-2">
            <p class="clase-rojo">HEMODIÁLISIS</p>
        </div>
        <div class="col-md-2">
            <p class="clase-azul">QUIRÚRGICO</p>
        </div>
        <div class="col-md-3">
            <p class="clase-morado">QUIMIOTERAPIA Y RADIOTERAPIA</p>
        </div>
        <div class="col-md-2">
            <p class="clase-clinica">OTROS</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" id="hemato">
            <div class="card" style="margin: 0;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="interconsultas-table" class="table display compact">
                            <thead class="text-primary">
                                <th>#C</th>
                                <th>Nombre Paciente</th>
                                <th>Interconsultas</th>
                                <th>Ordenamientos</th>
                            </thead>
                            <tbody>
                                @foreach ($gestiones1 as $gestion)
                                <tr @if (empty($gestion->INTERCONSULTAS) && empty($gestion->PROCEDIMIENTOS)) class="fila-roja" @endif>
                                    <td>{{ $gestion->CAMA }}</td>
                                    <td class="clase-clinica">{{ $gestion->nombre_paciente }}</td>
                                    <td data-interconsultas="{{ $gestion->INTERCONSULTAS }}">{{ $gestion->INTERCONSULTAS }}</td>
                                    <td data-procedimientos="{{ $gestion->PROCEDIMIENTOS }}">{{ $gestion->PROCEDIMIENTOS }}</td>
                                    <!-- <td>{{ $gestion->PROCEDIMIENTOS }}</td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" id="hemato2">
            <div class="card" style="margin: 0;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="interconsultas-table2" class="table display compact">
                            <thead class="text-primary">
                                <th>#C</th>
                                <th>Nombre Paciente</th>
                                <th>Interconsultas</th>
                                <th>Ordenamientos</th>
                            </thead>
                            <tbody>
                                @foreach ($gestiones2 as $gestion)
                                <tr @if (empty($gestion->INTERCONSULTAS) && empty($gestion->PROCEDIMIENTOS)) class="fila-roja" @endif>
                                    <td>{{ $gestion->CAMA }}</td>
                                    <td class="clase-clinica">{{ $gestion->nombre_paciente }}</td>
                                    <td data-interconsultas="{{ $gestion->INTERCONSULTAS }}">{{ $gestion->INTERCONSULTAS }}</td>
                                    <td data-procedimientos="{{ $gestion->PROCEDIMIENTOS }}">{{ $gestion->PROCEDIMIENTOS }}</td>
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

<div class="content vista" id="vista2">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-2">
            <p class="clase-rosado">ONCOLOGÍA</p>
        </div>
        <div class="col-md-2">
            <p class="clase-rojo">HEMODIÁLISIS</p>
        </div>
        <div class="col-md-2">
            <p class="clase-azul">QUIRÚRGICO</p>
        </div>
        <div class="col-md-3">
            <p class="clase-morado">QUIMIOTERAPIA Y RADIOTERAPIA</p>
        </div>
        <div class="col-md-2">
            <p class="clase-clinica">OTROS</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card" style="margin: 0;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="interconsultas-table3" class="table display compact">
                            <thead class="text-primary">
                                <th>#C</th>
                                <th>Nombre Paciente</th>
                                <th>Interconsultas</th>
                                <th>Ordenamientos</th>
                            </thead>
                            <tbody>
                                @foreach ($gestiones3 as $gestion)
                                <tr @if (empty($gestion->INTERCONSULTAS) && empty($gestion->PROCEDIMIENTOS)) class="fila-roja" @endif>
                                    <td>{{ $gestion->CAMA }}</td>
                                    <td class="clase-clinica">{{ $gestion->nombre_paciente }}</td>
                                    <td data-interconsultas="{{ $gestion->INTERCONSULTAS }}">{{ $gestion->INTERCONSULTAS }}</td>
                                    <td data-procedimientos="{{ $gestion->PROCEDIMIENTOS }}">{{ $gestion->PROCEDIMIENTOS }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card" style="margin: 0;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="interconsultas-table4" class="table display compact">
                            <thead class="text-primary">
                                <th>#C</th>
                                <th>Nombre Paciente</th>
                                <th>Interconsultas</th>
                                <th>Ordenamientos</th>
                            </thead>
                            <tbody>
                                @foreach ($gestiones4 as $gestion)
                                <tr @if (empty($gestion->INTERCONSULTAS) && empty($gestion->PROCEDIMIENTOS)) class="fila-roja" @endif>
                                    <td>{{ $gestion->CAMA }}</td>
                                    <td class="clase-clinica">{{ $gestion->nombre_paciente }}</td>
                                    <td data-interconsultas="{{ $gestion->INTERCONSULTAS }}">{{ $gestion->INTERCONSULTAS }}</td>
                                    <td data-procedimientos="{{ $gestion->PROCEDIMIENTOS }}">{{ $gestion->PROCEDIMIENTOS }}</td>
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

<div class="content vista" id="vista3">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-2">
            <p class="clase-rosado">ONCOLOGÍA</p>
        </div>
        <div class="col-md-2">
            <p class="clase-rojo">HEMODIÁLISIS</p>
        </div>
        <div class="col-md-2">
            <p class="clase-azul">QUIRÚRGICO</p>
        </div>
        <div class="col-md-3">
            <p class="clase-morado">QUIMIOTERAPIA Y RADIOTERAPIA</p>
        </div>
        <div class="col-md-2">
            <p class="clase-clinica">OTROS</p>
        </div>
    </div>
    <div class="row" id="cuarto_y_quinto">
        <div class="col-md-6">
            <div class="card" style="margin: 0;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="interconsultas-table5" class="table display compact">
                            <thead class="text-primary">
                                <th>#C</th>
                                <th>Nombre Paciente</th>
                                <th>Interconsultas</th>
                                <th>Ordenamientos</th>
                            </thead>
                            <tbody>
                                @if ($nombreUsuario === '5TO_PISO' || $nombreUsuario === '4TO_PISO')
                                @foreach ($gestiones5 as $gestion)
                                <tr @if (empty($gestion->INTERCONSULTAS) && empty($gestion->PROCEDIMIENTOS)) class="fila-roja" @endif>
                                    <td>{{ $gestion->CAMA }}</td>
                                    <td class="clase-clinica">{{ $gestion->nombre_paciente }}</td>
                                    <td data-interconsultas="{{ $gestion->INTERCONSULTAS }}">{{ $gestion->INTERCONSULTAS }}</td>
                                    <td data-procedimientos="{{ $gestion->PROCEDIMIENTOS }}">{{ $gestion->PROCEDIMIENTOS }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card" style="margin: 0;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="interconsultas-table6" class="table display compact">
                            <thead class="text-primary">
                                <th>#C</th>
                                <th>Nombre Paciente</th>
                                <th>Interconsultas</th>
                                <th>Ordenamientos</th>
                            </thead>
                            <tbody>
                                @if ($nombreUsuario === '5TO_PISO' || $nombreUsuario === '4TO_PISO')
                                @foreach ($gestiones6 as $gestion)
                                <tr @if (empty($gestion->INTERCONSULTAS) && empty($gestion->PROCEDIMIENTOS)) class="fila-roja" @endif>
                                    <td>{{ $gestion->CAMA }}</td>
                                    <td class="clase-clinica">{{ $gestion->nombre_paciente }}</td>
                                    <td data-interconsultas="{{ $gestion->INTERCONSULTAS }}">{{ $gestion->INTERCONSULTAS }}</td>
                                    <td data-procedimientos="{{ $gestion->PROCEDIMIENTOS }}">{{ $gestion->PROCEDIMIENTOS }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script>
    // Obtén las referencias a tus vistas por sus IDs
    var vista1 = document.getElementById("vista1");
    var vista2 = document.getElementById("vista2");
    var vista3 = document.getElementById("vista3");

    // Un arreglo con las vistas para facilitar la alternancia
    var vistas = document.querySelectorAll(".vista");
    var currentIndex = 0;

    document.addEventListener("keydown", function(event) {
        if (event.key === "ArrowLeft") {
            currentIndex = (currentIndex - 1 + vistas.length) % vistas.length;
            mostrarVistaActual();
        } else if (event.key === "ArrowRight") {
            currentIndex = (currentIndex + 1) % vistas.length;
            mostrarVistaActual();
        }
    });

    // Variable para controlar si el cambio de vista es manual o automático
    var cambioManual = false;

    // Función para mostrar la vista actual y ocultar la otra
    function mostrarVistaActual() {
        vistas.forEach(function(vista, index) {
            if (index === currentIndex) {
                vista.style.display = "block";
            } else {
                vista.style.display = "none";
            }
        });

    }

    // Mostrar la primera vista al cargar la página
    mostrarVistaActual();

    // Accede al campo de entrada oculto por su id
    var nombreUsuario = document.getElementById("nombreUsuario").value;

    // Ahora, la variable nombreUsuario contiene el valor del nombre de usuario en JavaScript

    // Accede al elemento con el id "hemato"
    var hematoElement = document.getElementById("hemato");
    var hemato2Element = document.getElementById("hemato2");
    var cuartoyquinto = document.getElementById("cuarto_y_quinto");

    if (nombreUsuario === '3ER_PISO_PAB_II') {
        cuartoyquinto.style.display = "none";
    } else if (nombreUsuario === '3ER_PISO_PAB_I') {
        cuartoyquinto.style.display = "none";
        // Cambiar automáticamente la vista cada 30 segundos
        setInterval(function() {
            if (!cambioManual) {
                currentIndex = (currentIndex + 1) % vistas.length;
                mostrarVistaActual();
            }
            cambioManual = false; // Restablecer a false para el cambio automático
        }, 30000);
    } else if (nombreUsuario === '3ER_PISO_HEMATO') {
        hematoElement.classList.remove("col-md-6");
        hematoElement.classList.add("col-md-12");
        hemato2Element.style.display = "none";
        cuartoyquinto.style.display = "none";
    } else if (nombreUsuario === '4TO_PISO') {
        // Cambiar automáticamente la vista cada 30 segundos
        setInterval(function() {
            if (!cambioManual) {
                currentIndex = (currentIndex + 1) % vistas.length;
                mostrarVistaActual();
            }
            cambioManual = false; // Restablecer a false para el cambio automático
        }, 30000);
    } else if (nombreUsuario === '5TO_PISO') {
        // Cambiar automáticamente la vista cada 30 segundos
        setInterval(function() {
            if (!cambioManual) {
                currentIndex = (currentIndex + 1) % vistas.length;
                mostrarVistaActual();
            }
            cambioManual = false; // Restablecer a false para el cambio automático
        }, 30000);
    }
</script>

<script>
    $(document).ready(function() {
        $('#interconsultas-table').DataTable({
            "createdRow": function(row, data, index) {
                // Aplicar estilo a la primera columna (índice 0)
                $('td:eq(0)', row).css({
                    'font-weight': 'bold', // Establecer negrita para la primera columna
                    'color': '#373737'
                });
                if ((data[2] == "" || data[2] == " ") && data[3] == "") {
                    $('td', row).css({
                        'background-color': '#f6e683',
                        'color': '#373737',
                        'border-style': '',
                        'border-color': '#aaa196'
                    })
                }
            },
            "searching": false,
            "info": false, // Deshabilita la información de registros
            "pageLength": 25,
            "lengthChange": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todos"]
            ],
            "paging": false,
            "ordering": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            }
        });

        $('#interconsultas-table2').DataTable({
            "createdRow": function(row, data, index) {
                // Aplicar estilo a la primera columna (índice 0)
                $('td:eq(0)', row).css({
                    'font-weight': 'bold', // Establecer negrita para la primera columna
                    'color': '#373737'
                });
                if (data[2] == "" && data[3] == "") {
                    $('td', row).css({
                        'background-color': '#f6e683',
                        'color': '#373737',
                        'border-style': '',
                        'border-color': '#aaa196'
                    })
                }
            },
            "searching": false,
            "info": false, // Deshabilita la información de registros
            "pageLength": 25,
            "lengthChange": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todos"]
            ],
            "paging": false,
            "ordering": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            }
        });

        $('#interconsultas-table3').DataTable({
            "createdRow": function(row, data, index) {
                // Aplicar estilo a la primera columna (índice 0)
                $('td:eq(0)', row).css({
                    'font-weight': 'bold', // Establecer negrita para la primera columna
                    'color': '#373737'
                });
                if (data[2] == "" && data[3] == "") {
                    $('td', row).css({
                        'background-color': '#f6e683',
                        'color': '#373737',
                        'border-style': '',
                        'border-color': '#aaa196'
                    })
                }
            },
            "searching": false,
            "info": false, // Deshabilita la información de registros
            "pageLength": 25,
            "lengthChange": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todos"]
            ],
            "paging": false,
            "ordering": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            }
        });

        $('#interconsultas-table4').DataTable({
            "createdRow": function(row, data, index) {
                // Aplicar estilo a la primera columna (índice 0)
                $('td:eq(0)', row).css({
                    'font-weight': 'bold', // Establecer negrita para la primera columna
                    'color': '#373737'
                });
                if (data[2] == "" && data[3] == "") {
                    $('td', row).css({
                        'background-color': '#f6e683',
                        'color': '#373737',
                        'border-style': '',
                        'border-color': '#aaa196'
                    })
                }
            },
            "searching": false,
            "info": false, // Deshabilita la información de registros
            "pageLength": 25,
            "lengthChange": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todos"]
            ],
            "paging": false,
            "ordering": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            }
        });

        $('#interconsultas-table5').DataTable({
            "createdRow": function(row, data, index) {
                // Aplicar estilo a la primera columna (índice 0)
                $('td:eq(0)', row).css({
                    'font-weight': 'bold', // Establecer negrita para la primera columna
                    'color': '#373737'
                });
                if (data[2] == "" && data[3] == "") {
                    $('td', row).css({
                        'background-color': '#f6e683',
                        'color': '#373737',
                        'border-style': '',
                        'border-color': '#aaa196'
                    })
                }
            },
            "searching": false,
            "info": false, // Deshabilita la información de registros
            "pageLength": 25,
            "lengthChange": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todos"]
            ],
            "paging": false,
            "ordering": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            }
        });

        $('#interconsultas-table6').DataTable({
            "createdRow": function(row, data, index) {
                // Aplicar estilo a la primera columna (índice 0)
                $('td:eq(0)', row).css({
                    'font-weight': 'bold', // Establecer negrita para la primera columna
                    'color': '#373737'
                });
                if (data[2] == "" && data[3] == "") {
                    $('td', row).css({
                        'background-color': '#f6e683',
                        'color': '#373737',
                        'border-style': '',
                        'border-color': '#aaa196'
                    })
                }
            },
            "searching": false,
            "info": false, // Deshabilita la información de registros
            "pageLength": 25,
            "lengthChange": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todos"]
            ],
            "paging": false,
            "ordering": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        // Obtén todas las celdas que tienen datos separados por comas
        var cells = document.querySelectorAll('td[data-interconsultas]');

        // Itera sobre cada celda
        cells.forEach(function(cell) {
            var interconsultas = cell.getAttribute('data-interconsultas');
            if (interconsultas) {
                var items = interconsultas.split(','); // Separa los elementos por comas

                // Crea un elemento contenedor para aplicar el fondo gris
                var container = document.createElement('div');
                container.classList.add('gris-fondo');

                // Variable para controlar si ya se agregó el primer elemento
                var primerElementoAgregado = false;

                // Itera sobre los elementos y aplícales el fondo gris y clases adicionales
                items.forEach(function(item, index) {
                    var span = document.createElement('span');
                    span.textContent = item.trim(); // Elimina espacios en blanco

                    // Si no es el último elemento, agrega una coma después
                    if (index < items.length - 1) {
                        var commaSpan = document.createElement('span');
                        commaSpan.textContent = ', ';

                        // Agrega la coma solo si ya se ha agregado el primer elemento
                        if (primerElementoAgregado) {
                            container.appendChild(commaSpan);
                        }
                    }

                    container.appendChild(span);

                    // Agregar una clase adicional según el contenido
                    if (item.trim() === 'ONCOLOGIA CLINICA' ||
                        item.trim() === 'ONCOLOGIA RADIOTERAPEUTICA' ||
                        item.trim() === 'CIRUGIA ONCOLOGICA' ||
                        item.trim() === 'GINECOLOGIA ONCOLOGICA' ||
                        item.trim() === 'MASTOLOGIA' ||
                        item.trim() === 'ONCOLOGIA PEDIATRICA' ||
                        item.trim() === 'ONCOHEMATOLOGIA PEDIATRICA') {
                        span.classList.add('clase-rosado');
                    } else {
                        span.classList.add('clase-clinica');
                    }

                    // Marcar que se ha agregado el primer elemento
                    if (!primerElementoAgregado) {
                        primerElementoAgregado = true;
                    }
                });

                // Reemplaza el contenido de la celda con el contenedor
                cell.textContent = '';
                cell.appendChild(container);
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        // Obtén todas las celdas que tienen datos separados por comas
        var cells = document.querySelectorAll('td[data-procedimientos]');

        // Itera sobre cada celda
        cells.forEach(function(cell) {
            var procedimientos = cell.getAttribute('data-procedimientos');
            if (procedimientos) {
                var itemsProcedimientos = procedimientos.split(','); // Separa los elementos por comas

                // Crea un elemento contenedor para aplicar el fondo gris
                var container = document.createElement('div');
                container.classList.add('gris-fondo');

                // Variable para controlar si ya se agregó el primer elemento
                var primerElementoAgregado = false;

                // Itera sobre los elementos
                itemsProcedimientos.forEach(function(item, index) {
                    var originalItem = item.trim(); // Conserva el elemento original
                    var firstChar = originalItem.charAt(0); // Obtén el primer carácter

                    // Obtén una subcadena de originalItem a partir del segundo carácter
                    var subcadena = originalItem.substring(1);

                    // Crear un nuevo elemento sin el primer carácter
                    var itemSinPrimerCaracter = originalItem.substring(1);

                    var span = document.createElement('span');
                    span.textContent = itemSinPrimerCaracter;

                    // Si no es el último elemento, agrega una coma después
                    if (index < itemsProcedimientos.length - 1) {
                        var commaSpan = document.createElement('span');
                        commaSpan.textContent = ', ';

                        // Agrega la coma solo si ya se ha agregado el primer elemento
                        if (primerElementoAgregado) {
                            container.appendChild(commaSpan);
                        }
                    }

                    // Agregar clases según el contenido
                    if (subcadena === 'POLITERAPIA ANTINEOPLÁSIC' ||
                        subcadena === 'POLIQUIMIOTERAPIA DE BAJO' ||
                        subcadena === 'CICLO COMPLETO DE TRATAMI' ||
                        subcadena === 'MONOTERAPIA ANTINEOPLASIC' ||
                        subcadena === 'QUIMIOTERAPIA DE INDUCCIO' ||
                        subcadena === 'TELETERAPIA CON ACELERADO' ||
                        subcadena === 'TELETERAPIA CON ELECTRONE' ||
                        subcadena === 'RADIOCIRUGÍA INTRACRANEAL' ||
                        subcadena === 'RADIOCIRUGÍA EXTRACRANEAL' ||
                        subcadena === 'QUIMIOTERAPIA INTRATECAL') {
                        span.classList.add('clase-morado');
                    } else if (subcadena === 'HEMODIALISIS CON BICARBON') {
                        span.classList.add('clase-rojo');
                    } else if (firstChar === '5') {
                        span.classList.add('clase-azul');
                    } else {
                        span.classList.add('clase-clinica');
                    }

                    // Agregar el span al container
                    container.appendChild(span);

                    // Marcar que se ha agregado el primer elemento
                    if (!primerElementoAgregado) {
                        primerElementoAgregado = true;
                    }
                });

                // Reemplaza el contenido de la celda con el contenedor
                cell.textContent = '';
                cell.appendChild(container);
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        var sidebar = document.getElementById("mySidebar");
        var navbar = document.getElementById("myNavbar");
        var footer = document.getElementById("myFooter");

        if (sidebar) {
            navbar.style.display = 'none';
            sidebar.style.display = 'none';
            footer.style.display = 'none';
            content.style.width = '100%';
        }
    });
</script>


@endsection