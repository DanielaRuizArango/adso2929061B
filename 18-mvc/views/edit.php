<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pokémon</title>
</head>
<body>
    <h1>Editar Pokémon</h1>
    
    <form action="/pokemons/edit/<?php echo $pokemon['id']; ?>" method="POST">
        <div>
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($pokemon['name']); ?>" required>
        </div>
        
        <div>
            <label for="type">Tipo:</label>
            <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($pokemon['type']); ?>" required>
        </div>
        
        <div>
            <label for="strength">Fuerza:</label>
            <input type="number" id="strength" name="strength" value="<?php echo htmlspecialchars($pokemon['strength']); ?>" required>
        </div>
        
        <div>
            <label for="stamina">Resistencia:</label>
            <input type="number" id="stamina" name="stamina" value="<?php echo htmlspecialchars($pokemon['stamina']); ?>" required>
        </div>
        
        <div>
            <label for="speed">Velocidad:</label>
            <input type="number" id="speed" name="speed" value="<?php echo htmlspecialchars($pokemon['speed']); ?>" required>
        </div>
        
        <div>
            <label for="acurracy">Precisión:</label>
            <input type="number" id="acurracy" name="acurracy" value="<?php echo htmlspecialchars($pokemon['acurracy']); ?>" required>
        </div>
        
        <div>
            <label for="trainer_id">ID del Entrenador:</label>
            <input type="number" id="trainer_id" name="trainer_id" value="<?php echo htmlspecialchars($pokemon['trainer_id']); ?>" required>
        </div>
        
        <div>
            <button type="submit">Actualizar Pokémon</button>
            <a href="/pokemons">Cancelar</a>
        </div>
    </form>
</body>
</html>
