<x-app-layout>
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-8 ">
        <h1 class="uppercase text-center text-3xl font-bold mb-2">Categoría : {{ $category->name }}</h1>

        @foreach ($posts as $post)
        <article class="mb-2 bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Ajusta la imagen para que se vea bien -->
            <img class="w-full h-auto object-contain object-center" 
                src="{{ $post->image ? Storage::url($post->image->url) : asset('storage\CoreImages\SinPhoto.jpeg') }}" 
                alt="{{ $post->name }}">
            <div class="px-6 py-4">
                <h1 class="font-bold text-xl mb-2">
                    <a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a>
                </h1>
                <div class="text-gray-700 text-base">
                    {!! $post->extract !!}
                </div>
            </div>

            <div class="py-3">
                @foreach ($post->etiquetas as $etiqueta)
                <a href="{{ route('posts.etiqueta', $etiqueta) }}" class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-white mr-3" style="background-color: {{ $etiqueta->color }};">
                    {{ $etiqueta->name }}
                </a>
                @endforeach
            </div>
        </article>
        @endforeach

        <div class="mb-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
