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
    <div class="card w-96 bg-base-100 shadow-xl">
        <figure class="px-10 pt-10">
            <!-- Placeholder for Pokemon Image if you had one, using a generic icon for now -->
            <div class="avatar placeholder">
                <div class="bg-neutral text-neutral-content rounded-full w-24">
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
                    <span class="badge badge-outline"><?= htmlspecialchars($pokemon['type']) ?></span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold">Fuerza:</span>
                    <span class="progress-wrapper w-1/2 text-right"><?= htmlspecialchars($pokemon['strength']) ?></span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold">Resistencia:</span>
                    <span><?= htmlspecialchars($pokemon['stamina']) ?></span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold">Velocidad:</span>
                    <span><?= htmlspecialchars($pokemon['speed']) ?></span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold">Precisión:</span>
                    <span><?= htmlspecialchars($pokemon['accuracy']) ?></span>
                </div>
                 <div class="flex justify-between pt-1">
                    <span class="font-semibold">Entrenador:</span>
                    <span><?= htmlspecialchars($pokemon['trainer_name'] ?? 'Sin asignar') ?></span>
                </div>
            </div>

            <div class="card-actions justify-end w-full mt-6">
                 <a href="/pokemons" class="btn btn-ghost btn-sm">Volver</a>
                <a href="/pokemons/edit/<?= $pokemon['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
            </div>
        </div>
    </div>
</body>
</html>
