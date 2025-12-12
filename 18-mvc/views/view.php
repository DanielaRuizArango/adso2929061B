<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-base-200 min-h-screen flex items-center justify-center py-10">
    <?php
    $colorClass = 'neutral';
    switch ($pokemon['type']) {
        case 'Water': $colorClass = 'info'; break;
        case 'Grass': $colorClass = 'success'; break;
        case 'Fire': $colorClass = 'error'; break;
        case 'Electric': $colorClass = 'warning'; break;
        case 'Poison': 
        case 'Ghost': $colorClass = 'primary'; break;
        case 'Dragon': $colorClass = 'secondary'; break;
        case 'Rock': 
        case 'Normal': 
        default: $colorClass = 'neutral'; break;
    }
    ?>
    <div class="card w-96 bg-base-100 shadow-xl">
        <figure class="px-10 pt-10">
            <!-- Placeholder for Pokemon Image if you had one, using a generic icon for now -->
            <div class="avatar placeholder">
                <div class="bg-<?= $colorClass ?> text-<?= $colorClass ?>-content rounded-full w-24">
                    <span class="text-3xl"><?= strtoupper(substr($pokemon['name'], 0, 1)) ?></span>
                </div>
            </div>
        </figure>
        <div class="card-body items-center text-center">
            <h2 class="card-title text-2xl font-bold mb-4"><?= htmlspecialchars($pokemon['name']) ?></h2>
            
            <div class="w-full text-left space-y-2">
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold">ID:</span>
                    <span><?= htmlspecialchars($pokemon['id']) ?></span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold">Tipo:</span>
                    <?php if($pokemon['type'] === 'Water'):?>
            <span class="badge badge-outline badge-info">Water</span>
          <?php elseif($pokemon['type'] === 'Grass'):?>
            <span class="badge badge-outline badge-success">Grass</span>
            <?php elseif($pokemon['type'] === 'Fire'):?>
            <span class="badge badge-outline badge-error">Fire</span>
            <?php elseif($pokemon['type'] === 'Electric'):?>
            <span class="badge badge-outline badge-warning">Electric</span>
            <?php elseif($pokemon['type'] === 'Normal'):?>
            <span class="badge badge-outline badge-neutral">Normal</span>
            <?php elseif($pokemon['type'] === 'Poison'):?>
            <span class="badge badge-outline badge-primary">Poison</span>
            <?php elseif($pokemon['type'] === 'Ghost'):?>
            <span class="badge badge-outline badge-primary">Ghost</span>
            <?php elseif($pokemon['type'] === 'Dragon'):?>
            <span class="badge badge-outline badge-secondary">Dragon</span>
            <?php elseif($pokemon['type'] === 'Rock'):?>
            <span class="badge badge-outline badge-neutral">Rock</span>
            <?php endif?>
                </div>
                <div class="flex flex-col border-b pb-1">
                    <div class="flex justify-between">
                         <span class="font-semibold">Fuerza:</span>
                         <span class="text-xs"><?= htmlspecialchars($pokemon['strength']) ?>/250</span>
                    </div>
                    <progress class="progress progress-<?= $colorClass ?> w-full" value="<?= htmlspecialchars($pokemon['strength']) ?>" max="250"></progress>
                </div>
                <div class="flex flex-col border-b pb-1">
                    <div class="flex justify-between">
                         <span class="font-semibold">Resistencia:</span>
                         <span class="text-xs"><?= htmlspecialchars($pokemon['stamina']) ?>/250</span>
                    </div>
                    <progress class="progress progress-<?= $colorClass ?> w-full" value="<?= htmlspecialchars($pokemon['stamina']) ?>" max="250"></progress>
                </div>
                <div class="flex flex-col border-b pb-1">
                    <div class="flex justify-between">
                         <span class="font-semibold">Velocidad:</span>
                         <span class="text-xs"><?= htmlspecialchars($pokemon['speed']) ?>/250</span>
                    </div>
                    <progress class="progress progress-<?= $colorClass ?> w-full" value="<?= htmlspecialchars($pokemon['speed']) ?>" max="250"></progress>
                </div>
                <div class="flex flex-col border-b pb-1">
                    <div class="flex justify-between">
                         <span class="font-semibold">Precisión:</span>
                         <span class="text-xs"><?= htmlspecialchars($pokemon['accuracy']) ?>/250</span>
                    </div>
                    <progress class="progress progress-<?= $colorClass ?> w-full" value="<?= htmlspecialchars($pokemon['accuracy']) ?>" max="250"></progress>
                </div>
                 <div class="flex justify-between pt-1">
                    <span class="font-semibold">Entrenador:</span>
                    <span><?= htmlspecialchars($pokemon['trainer_name'] ?? 'Sin asignar') ?></span>
                </div>
            </div>

            <div class="card-actions justify-end w-full mt-6">
                 <a href="/pokemons" class="btn btn-ghost btn-sm">Volver</a>
                <a href="/pokemons/edit/<?= $pokemon['id'] ?>" class="btn btn-<?= $colorClass ?> btn-sm">Editar</a>
            </div>
        </div>
    </div>
</body>
</html>
