<div class="card">
    <div class="card-header">
        {{ $busqueda }}
        <input wire:model="busqueda" type="text" class="form-control"
            placeholder="Ingrese el nombre de la publicacion a buscar">

    </div>

    <div class="card body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th colspan="2"class="d-flex justify-content-center">accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->name }}</td>
                        <td with="10px">
                            <a class="btn btn-primary btn-sm"href="{{ route('admin.posts.edit', $post) }}">Editar</a>
                        </td>
                        <td with="10px">
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
     <div class="card-footer">
        {{ $posts->links() }}
    </div>
</div>
