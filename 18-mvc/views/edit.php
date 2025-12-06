<?php if (!isset($pokemon)) { header("Location: /pokemons"); exit; } ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <h1>Editar Pokémon</h1>
    
    <form method="POST" action="/pokemons/edit/<?= $pokemon['id'] ?>">
        <div>
            <label for="name" class="label">Nombre:</label>
            <input type="text" class="input" id="name" name="name" value="<?= htmlspecialchars($pokemon['name']) ?>" required>
        </div>
        
        <div>
            <label for="type" class="label">Tipo:</label>
            <input type="text" class="input" id="type" name="type" value="<?= htmlspecialchars($pokemon['type']) ?>" required>
        </div>
        
        <div>
            <label for="strength" class="label">Fuerza:</label>
            <input type="number" class="input" id="strength" name="strength" value="<?= htmlspecialchars($pokemon['strength']) ?>" required>
        </div>
        
        <div>
            <label for="stamina" class="label">Resistencia:</label>
            <input type="number" class="input" id="stamina" name="stamina" value="<?= htmlspecialchars($pokemon['stamina']) ?>" required>
        </div>
        
        <div>
            <label for="speed" class="label">Velocidad:</label>
            <input type="number" class="input" id="speed" name="speed" value="<?= htmlspecialchars($pokemon['speed']) ?>" required>
        </div>
        
        <div>
            <label for="accuracy" class="label">Precisión:</label>
            <input type="number" class="input" id="accuracy" name="accuracy" value="<?= htmlspecialchars($pokemon['accuracy']) ?>" required>
        </div>
        
        <div>
            <label for="trainer_id" class="label">ID Entrenador:</label>
            <input type="number" class="input" id="trainer_id" name="trainer_id" value="<?= htmlspecialchars($pokemon['trainer_id']) ?>" required>
        </div>

        <button class="btn btn-active btn-accent"type="submit">Actualizar</button>
        
        <a href="/pokemons">Cancelar</a>
    </form>
</body>
</html>