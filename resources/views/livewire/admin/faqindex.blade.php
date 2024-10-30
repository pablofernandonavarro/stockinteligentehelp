<div>

    <div>

    </div>
    <div class="card">
        <div class="card-header">

            <input wire:model.live="search" type="search" class="form-control"
                placeholder="Ingrese el nombre de la publicacion a buscar" autofocus />

        </div>
        @if ($faqs->count())
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Pregunta</th>
                            <th>Respuesta</th>
                            <th>Categoria</th>
                            <th>Estado</th>

                            <th>Prioridad</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faqs as $faq)
                        <tr>
                            <td>{{ $faq->id }}</td>
                            <td>{{ $faq->question }}</td>
                            <td>{{ $faq->answer }}</td>
                            <td>{{ $faq->category->name }}</td>
                            <td class="{{$faq->is_active == 1 ? "badge bg-success  my-3 p-1" : "badge bg-secondary my-3 p-1" }}">{{ $faq->is_active == 1 ? "Activa" : "desactivada" }}</td>
                            <td>{{ $faq->priority }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">

                                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            {{ $faqs->links() }}
        </div>
        @else
        <div class="card-body">
            <strong class="alert alert-danger">no existe ninguna Publicacion con ese nombre .......</strong>
        </div>

        @endif

    </div>
</div>
