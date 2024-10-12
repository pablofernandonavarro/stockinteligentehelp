<x-app-layout>
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <h1 class="text-4xl font-bold text-gray-600">{{$post->name}}</h1>
        <div class="text-lg text-gray-500 mb-2">
            {!!$post->extract!!}
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- // * ---------- contenido Principal ---------------------------------------------------------------------------------- -->
            <div class="lg:col-span-2">
                <figure>
                    @if ($post->image)
                    <img class="w-full h-80 object-cover object-center" src="{{Storage::url($post->image->url)}}" alt="">
                    @else
                    <img  class="w-full h-72 object-over object-center" src="https://images.stockcake.com/public/f/6/c/f6cbc382-a45b-4385-8b56-84cddc4f0e99_large/stock-market-analysis-stockcake.jpg"> 
              
                    @endif
                </figure>
                <div class="text-base text-gray-500 mt-4">
                    {!!$post->body!!}
                </div>

            </div>



            <!-- // * ---------- contenido Relacionado ---------------------------------------------------------------------------------- -->
            <aside>
                <h1 class="text-2xl fond-bold test-gray-600 mb-2">
                    Más en {{$post->category->name}}
                </h1>
                <ul>
                    @foreach ($similares as $similar)
                          <li class="mb-4">
                            <a class= "flex" href="{{route('posts.show',$similar)}}">
                                @if ($similar->image)
                                <img class ="w-35 h-20 object-cover object-center"src="{{Storage::url($similar->image->url)}}" alt="">
                                @else
                                <img  class="w-full h-72 object-over object-center" src="https://images.stockcake.com/public/f/6/c/f6cbc382-a45b-4385-8b56-84cddc4f0e99_large/stock-market-analysis-stockcake.jpg"> 
              
                                @endif
                                <span class="ml-2 text-gray-600">{{$similar->name}}</span>
                            </a>
                          </li>
                    @endforeach
                </ul>

            </aside>


        </div>
    </div>

</x-app-layout>
