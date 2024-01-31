<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/css/bootstrap.min.css" rel="stylesheet">
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
                        <h2>Crear Emocion</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('createEmotion') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div> 
                            <div class="mb-3">
                                <label for="image" class="form-label">Seleccionar imagen <span class="text-danger"></span></label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
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
