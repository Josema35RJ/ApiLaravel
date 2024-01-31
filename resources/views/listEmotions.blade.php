<style>
    .table {
        width: 100%;
        margin: 1rem 0;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        transition: all 0.2s ease-in-out;
    }

    .table:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 1rem; /* Aumenta el padding para dar más espacio */
        text-align: left;
    }

    .table th {
        background-color: #4CAF50;
        color: white;
        text-transform: uppercase;
    }

    .table tr {
        background-color: #f8f8f8;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tr:hover {
        background-color: #ddd;
        transform: scale(1.02);
        transition: all 0.2s ease-in-out;
    }

    .table img {
        border-radius: 50%;
        transition: all 0.2s ease-in-out;
        width: 6em; /* Aumenta el tamaño de las imágenes */
        height: 6em;
    }

    .table img:hover {
        transform: scale(1.1);
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        max-width: 100%; /* Aumenta el ancho máximo */
        margin: auto;
        padding: 20px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
</style>


<div class="container">
    <h1>Emociones</h1>
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">Type</th>
                <th scope="col">Name</th>
                <th scope="col">User_id</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($emotions as $emotion)
            @if ($emotion->deleted === 0)
            <tr>
                <td>{{ $emotion->type }}</td>
                <td>{{ $emotion->name }}</td>
                <td>{{ $emotion->user_id }}</td>
                <td>{{ $emotion->description }}</td>
                <td>
                    <img src="{{ asset($emotion->image) }}"
                        alt="No tiene imagen" style="width: 5em; height: 5em;">
                </td>
                <td>{{ $emotion->created_at }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
