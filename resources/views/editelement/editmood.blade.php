<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <!-- CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <div class="card-header bg-primary text-white">Actualizar Estado De Emocion</div>
                    <div class="card-body">
                        <form method="POST " action="{{ route('mood.update',  $mood->id) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">{{ __('Descripción') }}</label>
                                <textarea id="description" class="form-control" name="description" required autocomplete="description" autofocus>{{ old('description', $mood->description) }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="image" class="form-label">{{ __('Imagen') }}</label>
                                <input id="image" type="file" class="form-control" name="image" required>
                                @error('image')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
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
