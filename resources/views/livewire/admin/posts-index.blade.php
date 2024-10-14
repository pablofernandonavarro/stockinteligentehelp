

<div class="card">
    <div class="card-header">
      
        <input wire:model.live="search" type="search" class="form-control"
            placeholder="Ingrese el nombre de la publicacion a buscar" autofocus/>

    </div>
    @if ($posts->count())
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Estado</th>
                    <th>Nombre</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr> 
                    <td>{{ $post->id }}</td>
                    <td class="{{$post->status == 2 ? "badge bg-success  my-3 p-1" : "badge bg-secondary my-3 p-1" }}">{{ $post->status == 2 ? "Activo" : "Borrador" }}</td>
                    <td>{{ $post->name }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a class="btn btn-warning btn-sm" href="{{ route('admin.posts.show', $post) }}" title="Ver">
                                Ver
                            </a>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.posts.edit', $post) }}" title="Editar">
                                Editar
                            </a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="post" class="d-inline-block" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta publicación?');">
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
        {{ $posts->links() }}
    </div>
    @else
    <div class="card-body">
        <strong class="alert alert-danger">no existe ninguna Publicacion con ese nombre .......</strong>
    </div>

    @endif

</div>