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
                    <a href="{{ route('createEvent') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Añadir Event
                    </a>

                    @php
                    $showTable = false; // Variable para indicar si se debe mostrar la tabla
                    foreach ($events as $event) {
                    if ($event->deleted === 0) {
                    $showTable = true; // Si encontramos al menos uno con deleted en 0, mostramos la tabla
                    break; // Terminamos el bucle ya que no necesitamos buscar más
                    }
                    }
                    @endphp

                    @if ($showTable)
                    <table class="table mt-4">
                        <!-- Agregamos margen arriba para separar el botón de la tabla -->
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Fecha Evento</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                            @if ($event->deleted === 0)
                            <tr>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->description }}</td>
                                <td>{{ $event->date }}</td>
                                <td>
                                    @foreach ($users as $user)
                                    @if ($event->user_id === $user->id)
                                    {{ $user->name }}
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{ route('event.deleteEvent', $event->id) }}" method="POST"
                                        style="display: inline;">
                                        <button type="button" class="btn btn-sm btn-danger delete-button"
                                            data-event-id="{{ $event->id }}">
                                            <img src="{{ asset('images/delete.png') }}" alt="Eliminar"
                                                style="width:3em;height:3em;margin-right:4px">
                                        </button>
                                    </form>

                                    <script>
                                    document.querySelectorAll('.delete-button').forEach(function(button) {
                                        button.addEventListener('click', function() {
                                            var eventId = this.dataset.eventId;

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
                                                    form.action = "/event/" + eventId;
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
                                    <form action="{{ route('event.edEvent', $event) }}" method="POST"
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
                    <p>No hay eventos disponibles.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
    var alertMessage = '{{ session('
    alert ') }}';
    var successMessage = '{{ session('
    success ') }}';
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