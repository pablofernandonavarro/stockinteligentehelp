<x-app-layout>
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-4xl font-extrabold text-gray-800 text-center mb-12">
                Novedades Recientes
            </h1>

            <!-- Contenedor de novedades -->
            <div class="space-y-12">
                @foreach ($news as $new)
                    <div class="relative bg-cover bg-center rounded-lg shadow-lg h-96"
                    style="background-image: url('{{ $new->image ? Storage::url($new->image) : asset('storage/CoreImages/SinPhoto.jpeg') }}')">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-75 rounded-lg"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-8 text-black">
                            <h2 class="text-3xl font-bold mb-4">
                                {{ $new->title }}
                            </h2>
                            
                            <a href="{{ route('news.show', $new) }}"
                               class="inline-block px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-black font-medium rounded-lg">
                                Leer más
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
           
        </div>
    </div>
</x-app-layout>