<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta3/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background: url('/images/imagen2fondoweb.jfif') no-repeat center center fixed;
        background-size: cover;
        color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .update-form {
        width: 300px;
        padding: 30px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 10px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
    }

    /* Nuevos estilos */
    input[type="text"] {
        border: 2px solid #3085d6;
        border-radius: 5px;
        padding: 10px;
        box-shadow: none;
        transition: border-color 0.3s ease;
    }

    input[type="text"]:focus {
        border-color: #267ac8;
        box-shadow: none;
        outline: none;
    }

    button[type="submit"] {
        background-color: #3085d6;
        border: none;
        box-shadow: none;
        transition: background-color 0.3s ease;
        border-radius: 50px;
        padding: 10px 30px;
        color: #fff;
    }

    button[type="submit"]:hover {
        background-color: #267ac8;
    }
</style>
<body>
    <div class="update-form">
        <form method="POST" action="{{ route('user.update',  $user->id) }}">
            @csrf
            @method('PATCH')
            <!-- Name -->
            <div class="form-group">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus placeholder="{{ __('Nombre') }}">
                @error('name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('Guardar Cambios') }}
                </button>
            </div>
        </form>
    </div>
</body>
</html>
