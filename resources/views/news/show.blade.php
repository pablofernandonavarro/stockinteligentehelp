<x-app-layout>
   
    <div class="flex justify-center items-center min-h-screen bg-gray-100 ">
        <div class="max-w-3xl w-full bg-white shadow-md rounded-lg overflow-hidden border border-gray-300">
            <!-- Imagen de la noticia -->
            <img src="https://picsum.photos/800/400" alt="Imagen de la noticia" class="w-full h-64 object-cover">

            <!-- Contenido de la noticia -->
            <div class="p-6">
                <!-- Detalles del autor y fecha -->
                <div class="text-gray-500 text-sm mb-4 text-center">
                    Publicado por <div class="font-medium">{{$user->name ?? 'Autor desconocido'}}</div>
                    <span> {{ $news->created_at->format('d/m/Y') }} </span>
                </div>

                <!-- Título -->
                <h1 class="text-3xl font-bold text-gray-800 mb-3 text-center">
                    {{ $news->title }}
                </h1>

                <!-- Subtítulo -->
                <h2 class="text-xl font-semibold text-gray-600 mb-4 text-center">
                    Este es el subtítulo de la noticia, breve pero impactante
                </h2>

                <!-- Contenido -->
                <p class="text-gray-700 text-lg leading-relaxed mb-4 text-justify">
               {!!$news->content!!}
                </p>

                <!-- Botón de acción -->
                <div class="mt-6 text-center">
                    <a href="{{route('news.index')}}"
                        class="inline-block px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                        Leer más Novedades
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
