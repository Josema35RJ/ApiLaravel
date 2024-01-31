<x-app-layout>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    .table {
        width: 100%;
        margin: 1rem 0;
        border-collapse: collapse;
    }

    /* Estilos para la tabla */

    .table th,
    .table td {
        border: 1px solid #000000;
        padding: 0.75rem;
        text-align: left;
    }

    .table th {
        background-color: #4CAF50;
        color: rgb(2, 2, 2);
    }

    .table tr:nth-child(even) {
        background-color: #a1a1a1;
    }

    .table tr:hover {
        background-color: #5c5757;
    }
    </style>
    <div class="py-6 d-flex justify-content-center align-items-start">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <a href="{{ route('createEmotion') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Añadir Emotion
                    </a>

                    @php
                    $showTable = false; // Variable para indicar si se debe mostrar la tabla
                    foreach ($emotions as $emotion) {
                    if ($emotion->deleted === 0) {
                    $showTable = true; // Si encontramos al menos uno con deleted en 0, mostramos la tabla
                    break; // Terminamos el bucle ya que no necesitamos buscar más
                    }
                    }
                    @endphp

                    @if ($showTable)
                    <table class="table mt-4">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emotions as $emotion)
                            @if ($emotion->deleted === 0)
                            <tr>
                                <td>{{ $emotion->name }}</td>
                                <td>
                                    <img src="{{ asset('/images/emotionimages/' . $emotion->image) }}"
                                        alt="No tiene imagen" style="width: 5em; height: 5em; margin-right: 6px;">
                                </td>
                                <td>
                                    <form action="{{ route('emotion.deleteEmotion', $emotion->id) }}" method="POST"
                                        style="display: inline;">
                                        <button type="button" class="btn btn-sm btn-danger delete-button"
                                            data-emotion-id="{{ $emotion->id }}">
                                            <img src="{{ asset('images/delete.png') }}" alt="Eliminar"
                                                style="width:3em;height:3em;margin-right:4px">
                                        </button>
                                    </form>

                                    <script>
                                    document.querySelectorAll('.delete-button').forEach(function(button) {
                                        button.addEventListener('click', function() {
                                            var emotionId = this.dataset.emotionId;

                                            Swal.fire({
                                                title: '¿Estás seguro?',
                                                text: "¡No podrás revertir esto!",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: '¡Sí, bórralo!'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    var form = document.createElement('form');
                                                    form.method = 'POST';
                                                    form.action = "/emotion/" + emotionId;
                                                    form.style.display = 'none';

                                                    var csrf = document.createElement('input');
                                                    csrf.type = 'hidden';
                                                    csrf.name = '_token';
                                                    csrf.value = "{{ csrf_token() }}";
                                                    form.appendChild(csrf);

                                                    var method = document.createElement(
                                                        'input');
                                                    method.type = 'hidden';
                                                    method.name = '_method';
                                                    method.value = 'DELETE';
                                                    form.appendChild(method);

                                                    document.body.appendChild(form);
                                                    form.submit();
                                                }
                                            })
                                        });
                                    });
                                    </script>

                                    </form>
                                    <form action="{{ route('emotion.edEmotion', $emotion) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <img src="{{ asset('images/edit.png') }}" alt="Editar"
                                                style="width:3em;height:3em;margin-right:4px">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>No hay emociones disponibles.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
    async function showAlert(alertMessage, successMessage) {
        if (alertMessage) {
            await Swal.fire({
                title: 'Alerta',
                text: `${alertMessage}`,
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
                iconColor: '#3085d6'
            });
        }
        if (successMessage) {
            await Swal.fire({
                icon: 'success',
                title: `${successMessage}`,
                showConfirmButton: false,
                timer: 1500
            });
        }
    }

    showAlert('{{ session('
        alert ') }}', '{{ session('
        success ') }}');
    </script>
</x-app-layout>