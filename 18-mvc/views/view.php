<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Pokémon</title>
</head>
<body>
    <h1>Detalles del Pokémon</h1>
    
    <div>
        <p><strong>ID:</strong> <?php echo htmlspecialchars($pokemon['id']); ?></p>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($pokemon['name']); ?></p>
        <p><strong>Tipo:</strong> <?php echo htmlspecialchars($pokemon['type']); ?></p>
        <p><strong>Fuerza:</strong> <?php echo htmlspecialchars($pokemon['strength']); ?></p>
        <p><strong>Resistencia:</strong> <?php echo htmlspecialchars($pokemon['stamina']); ?></p>
        <p><strong>Velocidad:</strong> <?php echo htmlspecialchars($pokemon['speed']); ?></p>
        <p><strong>Precisión:</strong> <?php echo htmlspecialchars($pokemon['acurracy']); ?></p>
        <p><strong>ID del Entrenador:</strong> <?php echo htmlspecialchars($pokemon['trainer_id']); ?></p>
    </div>
    
    <div>
        <a href="/pokemons/edit/<?php echo $pokemon['id']; ?>">Editar</a>
        <a href="/pokemons">Volver al listado</a>
    </div>
</body>
</html>
