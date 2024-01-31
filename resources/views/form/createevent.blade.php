<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/css/bootstrap.min.css">
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
            font-family: Arial, sans-serif;
            background: linear-gradient(-45deg, #85e0e0, #82cef9, #88d3ce);
            background-size: 600% 600%;
            background-image: url('/images/imagenfondoweb.jfif');
            background-size: cover;
            animation: gradient 15s ease infinite;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #333;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            margin-top: 10px;
        }

        .form-container button:hover {
            background-color: #f5f5f5;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container form-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Crear Evento</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('createEvent') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" id="description" name="description" required
                                    unique>
                            </div>
                            <div class="form-group mb-3">
                                <label for="date" class="form-label">{{ __('Fecha y Hora') }}</label>
                                <input id="date" type="datetime-local" class="form-control" name="date" required
                                    autocomplete="datetime" autofocus>
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
                                                <option value="{{ $user->id }}">
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
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
