<div>
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne"
                    data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Sucursales
                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse ">
                <div class="accordion-body">
                    <div>
                        <button class='btn btn-success btn-sm mb-3'>Crear Sucursal</button>
                    </div>

                    <table class="table table-fixed">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Conexión</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($branches as $branch)
                                <tr>
                                    <td>{{ $branch->branch_name }}</td>
                                    <td>{{ $branch->any_desk }}</td>
                                    <td>
                                        <a href=""class="btn btn-secondary btn-sm">ver</a>
                                        <a href=""class="btn btn-secondary btn-sm">edit</a>
                                        <a href=""class="btn btn-secondary btn-sm">elimi</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">No hay sucursales para este cliente.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@stop
