<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pokémon</title>
</head>

<body>
    <h1>Crear Nuevo Pokémon</h1>

    <form action="/pokemons/create" method="POST">
        <div>
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="type">Tipo:</label>
            <input type="text" id="type" name="type" required>
        </div>

        <div>
            <label for="strength">Fuerza:</label>
            <input type="number" id="strength" name="strength" required>
        </div>

        <div>
            <label for="stamina">Resistencia:</label>
            <input type="number" id="stamina" name="stamina" required>
        </div>

        <div>
            <label for="speed">Velocidad:</label>
            <input type="number" id="speed" name="speed" required>
        </div>

        <div>
            <label for="acurracy">Precisión:</label>
            <input type="number" id="acurracy" name="acurracy" required>
        </div>

        <div>
            <label for="trainer_id">ID del Entrenador:</label>
            <input type="number" id="trainer_id" name="trainer_id" required>
        </div>

        <div>
            <button type="submit">Crear Pokémon</button>
            <a href="/pokemons">Cancelar</a>
        </div>
    </form>
</body>

</html>