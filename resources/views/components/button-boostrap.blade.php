@props(['id'])

<button type="button" class="btn btn-primary p-5" data-bs-toggle="modal" data-bs-target="#{{ $id }}">
    {{ $slot }}
</button>
