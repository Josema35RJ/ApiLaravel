<x-app-layout>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .journal-entry {
            width: 80%;
            margin: 2rem auto;
            padding: 1.5rem;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-family: 'Times New Roman', Times, serif;
            border-radius: 15px;
        }

        .journal-entry img {
            width: 5em;
            height: 5em;
            float: left;
            margin-right: 1rem;
            border-radius: 50%;
        }

        .journal-entry h2 {
            margin: 0;
            font-size: 1.5rem;
            color: #333;
            font-weight: bold;
        }

        .journal-entry p {
            margin: 0.5rem 0 0;
            color: #666;
            font-style: italic;
            text-align: right;
        }

        .journal-entry::after {
            content: "";
            display: table;
            clear: both;
        }

        .btn-primary {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
    <div class="py-6 d-flex justify-content-center align-items-start">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    @if($events->isEmpty())
                        <p>No hay elementos disponibles</p>
                    @else
                        <a href="{{ route('generateEvents-pdf') }}" class="btn btn-primary">Generar Diaro Eventos</a>
                        @foreach ($events as $event)
                            @if ($event->deleted === 0)
                                <div class="journal-entry">
                                    <img src="{{ asset('images/eventdefault.png') }}" alt="No tiene imagen">
                                    <h2>{{ $event->description }}</h2>
                                    <p>{{ $event->date}}</p>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        var alertMessage = '{{ session('alert') }}';
        var successMessage = '{{ session('success') }}';
        if (alertMessage) {
            Swal.fire({
                title: 'Alerta',
                text: alertMessage,
                icon: 'success', 
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6', 
                iconColor: '#3085d6' 
            });
        }
        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: successMessage,
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>
</x-app-layout>
