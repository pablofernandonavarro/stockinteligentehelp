<x-app-layout>

    <div class="max-w-screen-xl mx-auto p-6">
        @if (session('message'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                {{ session('message') }}
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach ($posts as $post)
                {{-- Mostrar los posts excepto los de la categoría "Stock_interna" para usuarios no autenticados o sin el rol Admin --}}
                @if (auth()->check())
                    @if (auth()->user()->hasRole('Admin'))
                        {{-- Si es Admin, muestra todos los posts --}}
                        <article
                            class="relative w-full h-80 bg-gradient-to-b from-gray-300 to-gray-200 rounded-lg overflow-hidden shadow-xl transition-transform duration-300 ease-in-out hover:scale-105 flex flex-col justify-between">
                            <div class="absolute inset-0 bg-cover bg-center"
                                style="background-image: url('{{ Storage::url('CoreImages/logo_SI.jpeg') }}'); opacity: 0.1;">
                            </div>
                            <div class="relative z-10 p-6 flex flex-col justify-center flex-grow">
                                <div class="mb-2 flex flex-wrap gap-2">
                                    @foreach ($post->etiquetas as $etiqueta)
                                        <a href="{{ route('posts.etiqueta', $etiqueta) }}"
                                            class="inline-block px-3 h-6 text-white rounded-full hover:text-gray-300 transition duration-200"
                                            style="background-color: {{ $etiqueta->color }};">
                                            {{ $etiqueta->name }}
                                        </a>
                                    @endforeach
                                </div>
                                <h1
                                    class="text-xl md:text-2xl lg:text-3xl text-gray-800 leading-8 font-bold hover:text-gray-900 transition duration-200">
                                    <a href="{{ route('posts.show', $post) }}">
                                        {{ $post->name }}
                                    </a>
                                </h1>
                            </div>
                        </article>
                    @else
                        {{-- Si no es Admin, oculta los posts de la categoría "Stock_interna" --}}
                        @if ($post->category->name != 'Stock_interna')
                            <article
                                class="relative w-full h-80 bg-gradient-to-b from-gray-300 to-gray-200 rounded-lg overflow-hidden shadow-xl transition-transform duration-300 ease-in-out hover:scale-105 flex flex-col justify-between">
                                <div class="absolute inset-0 bg-cover bg-center"
                                    style="background-image: url('{{ Storage::url('CoreImages/logo_SI.jpeg') }}'); opacity: 0.1;">
                                </div>
                                <div class="relative z-10 p-6 flex flex-col justify-center flex-grow">
                                    <div class="mb-2 flex flex-wrap gap-2">
                                        @foreach ($post->etiquetas as $etiqueta)
                                            <a href="{{ route('posts.etiqueta', $etiqueta) }}"
                                                class="inline-block px-3 h-6 text-white rounded-full hover:text-gray-300 transition duration-200"
                                                style="background-color: {{ $etiqueta->color }};">
                                                {{ $etiqueta->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                    <h1
                                        class="text-xl md:text-2xl lg:text-3xl text-gray-800 leading-8 font-bold hover:text-gray-900 transition duration-200">
                                        <a href="{{ route('posts.show', $post) }}">
                                            {{ $post->name }}
                                        </a>
                                    </h1>
                                </div>
                            </article>
                        @endif
                    @endif
                @else
                    {{-- Usuarios no autenticados: Oculta los posts de la categoría "Stock_interna" --}}
                    @if ($post->category->name != 'Stock_interna')
                        <article
                            class="relative w-full h-80 bg-gradient-to-b from-gray-300 to-gray-200 rounded-lg overflow-hidden shadow-xl transition-transform duration-300 ease-in-out hover:scale-105 flex flex-col justify-between">
                            <div class="absolute inset-0 bg-cover bg-center"
                                style="background-image: url('{{ Storage::url('CoreImages/logo_SI.jpeg') }}'); opacity: 0.1;">
                            </div>
                            <div class="relative z-10 p-6 flex flex-col justify-center flex-grow">
                                <div class="mb-2 flex flex-wrap gap-2">
                                    @foreach ($post->etiquetas as $etiqueta)
                                        <a href="{{ route('posts.etiqueta', $etiqueta) }}"
                                            class="inline-block px-3 h-6 text-white rounded-full hover:text-gray-300 transition duration-200"
                                            style="background-color: {{ $etiqueta->color }};">
                                            {{ $etiqueta->name }}
                                        </a>
                                    @endforeach
                                </div>
                                <h1
                                    class="text-xl md:text-2xl lg:text-3xl text-gray-800 leading-8 font-bold hover:text-gray-900 transition duration-200">
                                    <a href="{{ route('posts.show', $post) }}">
                                        {{ $post->name }}
                                    </a>
                                </h1>
                            </div>
                        </article>
                    @endif
                @endif
            @endforeach
        </div>

        <div class="mt-6 py-4 flex items-center justify-between">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
