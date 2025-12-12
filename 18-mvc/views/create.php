<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-base-200 min-h-screen flex items-center justify-center py-10">
    <div class="card w-full max-w-lg bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold justify-center mb-6">Crear Nuevo Pokémon</h2>

            <form action="/pokemons/create" method="POST" class="space-y-4">
                <div class="form-control">
                    <label for="name" class="label">
                        <span class="label-text font-semibold">Nombre</span>
                    </label>
                    <input type="text" id="name" name="name" class="input input-bordered w-full" required />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-control">
                        <label for="type" class="label">
                            <span class="label-text font-semibold">Tipo</span>
                        </label>
                        <input type="text" id="type" name="type" class="input input-bordered w-full" required />
                    </div>

                    <div class="form-control">
                        <label for="strength" class="label">
                            <span class="label-text font-semibold">Fuerza</span>
                        </label>
                        <input type="number" id="strength" name="strength" class="input input-bordered w-full" required />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-control">
                        <label for="stamina" class="label">
                            <span class="label-text font-semibold">Resistencia</span>
                        </label>
                        <input type="number" id="stamina" name="stamina" class="input input-bordered w-full" required />
                    </div>

                    <div class="form-control">
                        <label for="speed" class="label">
                            <span class="label-text font-semibold">Velocidad</span>
                        </label>
                        <input type="number" id="speed" name="speed" class="input input-bordered w-full" required />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-control">
                        <label for="accuracy" class="label">
                            <span class="label-text font-semibold">Precisión</span>
                        </label>
                        <input type="number" id="accuracy" name="accuracy" class="input input-bordered w-full" required />
                    </div>

                    <div class="form-control">
                        <label for="trainer_id" class="label">
                            <span class="label-text font-semibold">Entrenador</span>
                        </label>
                        <select id="trainer_id" name="trainer_id" class="select select-bordered w-full" required>
                            <option value="">Seleccione un entrenador</option>
                            <?php foreach ($trainers as $trainer): ?>
                                <option value="<?= htmlspecialchars($trainer['id']) ?>">
                                    <?= htmlspecialchars($trainer['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="card-actions justify-end mt-6">
                    <a href="/pokemons" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Crear Pokémon</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>