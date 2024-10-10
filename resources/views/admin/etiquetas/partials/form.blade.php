<div class="mb-3">
        {{-- Campo de nombre de la categoría --}}
        {{ html()->label('Nombre de la Etiqueta', 'name')->class('form-label') }}
        {{ html()->text('name')
                ->class('form-control')
                ->placeholder('Ingrese el nombre de la etiqueta')
                ->value(old('name', $etiqueta->name)) }}
        {{ html()->label('Color de la Etiqueta', 'color')->class('form-label') }}
        {{ html()->text('color')
                ->class('form-control')
                ->placeholder('Ingrese el Color de la etiqueta')
                ->value(old('color', $etiqueta->color)) }}

        {{-- Mostrar mensajes de error --}}
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>