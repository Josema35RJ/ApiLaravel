<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Evento</title>
    <!-- CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<style>
      body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(-45deg, #85e0e0, #82cef9, #88d3ce);
            background-image: url('/images/imagen2fondoweb.jfif');
            background-size: cover;
            animation: gradient 15s ease infinite;
            color: #333;
        }
</style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">Actualizar Evento</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('event.update',  $event->id) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $event->name) }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">{{ __('Descripción') }}</label>
                                <textarea id="description" class="form-control" name="description" required autocomplete="description" autofocus>{{ old('description', $event->description) }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="date" class="form-label">{{ __('Fecha y Hora') }}</label>
                                <input id="date" type="datetime-local" class="form-control" name="date" value="{{ old('date', $event->date) }}" required autocomplete="datetime" autofocus>
                                @error('date')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="users" class="form-label">Usuario: </label>
                                @if (count($users) > 0)
                                    <select class="form-control" id="users" name="users[]" required>
                                        @foreach ($users as $user)
                                            @if ($user->actived === 1 && $user->deleted === 0)
                                                <option value="{{ $user->id }}" {{ old('user_id', $event->user_id) == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                @else
                                    <p class="text-danger">No hay usuarios activos disponibles.</p>
                                @endif
                            </div>
                            
                            <script>
                            $(document).ready(function() {
                                $('#users').select2({
                                    closeOnSelect: true
                                });
                            });
                            </script> 
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar Cambios') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
