<div class="mb-3">
    {{-- Campo de nombre de la categoría --}}
    {{ html()->label('Nombre de la Etiqueta', 'name')->class('form-label') }}
    {{ html()->text('name')
            ->class('form-control')
            ->placeholder('Ingrese el nombre de la etiqueta')
            ->value(old('name', $etiqueta->name)) }}

    {{-- Select simple para el color --}}
    {{ html()->label('Seleccionar color', 'color')->class('form-label') }}
    <input type="color" class="form-control" name="color" value="{{ old('color', $etiqueta->color ?? '#ffffff') }}">  
      
     <!-- <select name="color" id="color" class="form-control">

        @foreach($coloresTailwind as $key => $color)
            <option value="{{ $key }}" {{ old('color', $etiqueta->color) == $key ? 'selected' : '' }}>
                {{ $color }}
            </option>
        @endforeach
    </select>  -->

    {{-- Mostrar mensajes de error --}}
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
