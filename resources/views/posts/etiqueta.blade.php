<x-app-layout>
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-8">

        <h1 class="uppercase text-center text-3xl font-bold mb-4">Etiqueta: {{ $etiqueta->name }}</h1>

        @foreach ($posts as $post)
        <article class="mb-2 bg-white shadow-lg rounded-lg overflow-hidden">
            @if ($post->image)
            <img class="w-full h-72 object-cover object-center" src="{{ Storage::url($post->image->url) }}" alt="">
            @else
            <img class="w-full h-72 object-cover object-center" src="{{asset('storage/CoreImages/SinPhoto.jpeg')}}" alt="Imagen predeterminada">
            @endif

            <div class="px-6 py-4">
                <h1 class="font-bold text-xl mb-2">
                    <a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a>
                </h1>
                <div class="text-gray-700 text-base">
                    {!! $post->extract !!}
                </div>
            </div>

            <div class="px-6 py-3">
                @foreach ($post->etiquetas as $etiqueta)
                <a href="{{ route('posts.etiqueta', $etiqueta) }}" class="inline-block rounded-full px-3 py-1 text-sm text-black mr-3"  style="background-color: {{ $etiqueta->color }};">
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