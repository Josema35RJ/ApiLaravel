<x-app-layout>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .journal-entry {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            gap: 1rem;
            align-items: center;
            margin-bottom: 2rem;
        }

        .journal-entry img {
            width: 15em; /* Ajusta el ancho como desees */
            height: 15em; /* Ajusta la altura como desees */
            border-radius: 50%;
        }
    </style>
    <div class="py-6 d-flex justify-content-center align-items-start">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <a href="{{ route('generateAllPDF') }}" class="btn btn-primary" style="background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 5px;">Generar PDF</a>
                    <!-- Elements -->
                    @if($elements->isEmpty())
                        <p>No hay elementos disponibles</p>
                    @else
                        @foreach ($elements as $element)
                            <div class="journal-entry">
                                @if ($element->type === 'mood')
                                    <img src="{{ asset('/images/moodimages/' . $element->image) }}" alt="No tiene imagen">
                                @elseif ($element->type === 'event')
                                    <img src="{{ asset('images/eventdefault.png') }}" alt="No tiene imagen">
                                @else
                                    <img src="{{ asset('/images/emotionimages/' . $element->image) }}" alt="No tiene imagen">
                                @endif
                                <div class="description">
                                    @if ($element->type === 'emotion')
                                        <h2>{{ $element->name }}</h2>
                                    @else
                                        <h2>{{ $element->description }}</h2>
                                    @endif
                                </div>
                                <div class="date">
                                    <p>{{ $element->created_at }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
