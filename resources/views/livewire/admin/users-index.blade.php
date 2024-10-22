<div>
    @if(session('message'))
<div class="alert alert-success">
    <strong>{{session('message')}}</strong>
</div>
@endif
    <div class="card">
        <div class="card-header">
            <input wire:model.live="search" class="form-control" placeholder="Ingrese el nombre de un Usuario" autofocus />
        </div>
        @if ($users->count())


        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($users as $user )
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td with="10px">
                            <a href="{{route('admin.users.edit',$user)}}" class="btn btn-primary btn-sm">Editar</a>
                        </td>
                        <td with="10px">
                            <form action="{{route('admin.users.destroy', $user)}}" method="POST">
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
            {{ $users->links() }}
        </div>
        @else
        <div class="card-body">
            <strong>No hay Registros!!</strong>
        </div>
        @endif

    </div>
</div>
