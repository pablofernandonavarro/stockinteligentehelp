<x-app-layout>
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-8">
        <section class="py-4 bg-gray-50 sm:py-16 lg:py-8">
            <div class="px-2 mx-auto sm:px-6 lg:px-8 max-w-7xl">
                <div class="max-w-2xl mx-auto text-center">
                    <h2 class="text-2xl font-bold leading-tight text-black sm:text-2xl lg:text-3xl">
                        Explore las preguntas frecuentes
                    </h2>
                </div>
                <div class="max-w-3xl mx-auto mt-8 space-y-4 md:mt-8">
                    @foreach ($faqs as $faq)
                        <div class="transition-all duration-200 bg-white border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50 mb-4">
                            <button type="button" id="question{{ $loop->index }}" data-state="closed" class="flex items-center justify-between w-full px-4 py-5 sm:p-6">
                                <span class="flex text-lg font-semibold text-black">{{ $faq->question }}</span>
                                <svg id="arrow{{ $loop->index }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="answer{{ $loop->index }}" style="display: none" class="px-4 pb-5 sm:px-6 sm:pb-6">
                                <p>{{ $faq->answer }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <p class="text-center text-gray-600 text-base mt-9">
                    ¿Aún tienes preguntas?
                    <a href="https://stockinteligente.com/"  class="text-blue-500 hover:underline">
                    <span class="cursor-pointer font-medium text-tertiary transition-all duration-200 hover:text-tertiary focus:text-tertiary hover-underline">Contacta con nosotros</span>
                    </a>
                </p>
            </div>
            <script>
                // JavaScript para alternar las respuestas y rotar las flechas
                document.querySelectorAll('[id^="question"]').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var index = button.id.replace('question', '');
                        var answer = document.getElementById('answer' + index);
                        var arrow = document.getElementById('arrow' + index);

                        if (answer.style.display === 'none' || answer.style.display === '') {
                            answer.style.display = 'block';
                            arrow.style.transform = 'rotate(0deg)';
                        } else {
                            answer.style.display = 'none';
                            arrow.style.transform = 'rotate(-180deg)';
                        }
                    });
                });
            </script>
        </section>
    </div>
</x-app-layout>
