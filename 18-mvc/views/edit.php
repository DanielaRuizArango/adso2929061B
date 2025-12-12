<?php if (!isset($pokemon)) { header("Location: /pokemons"); exit; } ?>
<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-base-200 min-h-screen flex items-center justify-center py-10">
    <div class="card w-full max-w-lg bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold justify-center mb-6">Editar Pokémon</h2>
            
            <form method="POST" action="/pokemons/edit/<?= $pokemon['id'] ?>" class="space-y-4">
                <div class="form-control">
                    <label for="name" class="label">
                        <span class="label-text font-semibold">Nombre</span>
                    </label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($pokemon['name']) ?>" class="input input-bordered w-full" required />
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-control">
                        <label for="type" class="label">
                            <span class="label-text font-semibold">Tipo</span>
                            <span id="type-badge" class="badge badge-outline"></span>
                        </label>
                        <select id="type" name="type" class="select select-bordered w-full" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="Water" <?= $pokemon['type'] === 'Water' ? 'selected' : '' ?>>Water</option>
                            <option value="Grass" <?= $pokemon['type'] === 'Grass' ? 'selected' : '' ?>>Grass</option>
                            <option value="Fire" <?= $pokemon['type'] === 'Fire' ? 'selected' : '' ?>>Fire</option>
                            <option value="Electric" <?= $pokemon['type'] === 'Electric' ? 'selected' : '' ?>>Electric</option>
                            <option value="Normal" <?= $pokemon['type'] === 'Normal' ? 'selected' : '' ?>>Normal</option>
                            <option value="Poison" <?= $pokemon['type'] === 'Poison' ? 'selected' : '' ?>>Poison</option>
                            <option value="Ghost" <?= $pokemon['type'] === 'Ghost' ? 'selected' : '' ?>>Ghost</option>
                            <option value="Dragon" <?= $pokemon['type'] === 'Dragon' ? 'selected' : '' ?>>Dragon</option>
                            <option value="Rock" <?= $pokemon['type'] === 'Rock' ? 'selected' : '' ?>>Rock</option>
                        </select>
                    </div>
                    
                    <div class="form-control">
                        <label for="strength" class="label">
                            <span class="label-text font-semibold">Fuerza</span>
                            <span class="label-text-alt" id="strength-val"><?= htmlspecialchars($pokemon['strength']) ?></span>
                        </label>
                        <input type="range" min="0" max="250" value="<?= htmlspecialchars($pokemon['strength']) ?>" id="strength" name="strength" class="range range-error" oninput="document.getElementById('strength-val').innerText = this.value" required />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-control">
                        <label for="stamina" class="label">
                            <span class="label-text font-semibold">Resistencia</span>
                             <span class="label-text-alt" id="stamina-val"><?= htmlspecialchars($pokemon['stamina']) ?></span>
                        </label>
                         <input type="range" min="0" max="250" value="<?= htmlspecialchars($pokemon['stamina']) ?>" id="stamina" name="stamina" class="range range-success" oninput="document.getElementById('stamina-val').innerText = this.value" required />
                    </div>
                    
                    <div class="form-control">
                         <label for="speed" class="label">
                            <span class="label-text font-semibold">Velocidad</span>
                             <span class="label-text-alt" id="speed-val"><?= htmlspecialchars($pokemon['speed']) ?></span>
                        </label>
                        <input type="range" min="0" max="250" value="<?= htmlspecialchars($pokemon['speed']) ?>" id="speed" name="speed" class="range range-warning" oninput="document.getElementById('speed-val').innerText = this.value" required />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-control">
                        <label for="accuracy" class="label">
                            <span class="label-text font-semibold">Precisión</span>
                            <span class="label-text-alt" id="accuracy-val"><?= htmlspecialchars($pokemon['accuracy']) ?></span>
                        </label>
                        <input type="range" min="0" max="250" value="<?= htmlspecialchars($pokemon['accuracy']) ?>" id="accuracy" name="accuracy" class="range range-info" oninput="document.getElementById('accuracy-val').innerText = this.value" required />
                    </div>
                     <div class="form-control">
                        <label for="trainer_id" class="label">
                            <span class="label-text font-semibold">Entrenador</span>
                        </label>
                        <select id="trainer_id" name="trainer_id" class="select select-bordered w-full" required>
                            <option value="">Seleccione un entrenador</option>
                            <?php foreach ($trainers as $trainer): ?>
                                <option value="<?= htmlspecialchars($trainer['id']) ?>" <?= $pokemon['trainer_id'] == $trainer['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($trainer['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="card-actions justify-end mt-6">
                    <a href="/pokemons" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Pokémon</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const typeSelect = document.getElementById('type');
        const typeBadge = document.getElementById('type-badge');
        const rangeInputs = document.querySelectorAll('input[type="range"]');

        
        const typeColors = {
            'Water': 'info',
            'Grass': 'success',
            'Fire': 'error',
            'Electric': 'warning',
            'Normal': 'neutral',
            'Poison': 'primary',
            'Ghost': 'primary',
            'Dragon': 'secondary',
            'Rock': 'neutral'
        };

        function updateUI() {
            const selectedType = typeSelect.value;
            typeBadge.innerText = selectedType || 'None';
            const colorName = typeColors[selectedType] || 'neutral';
            
            
            typeBadge.className = 'badge badge-outline'; 
            
            typeBadge.classList.add('badge-' + colorName);

            
            rangeInputs.forEach(input => {
                
                input.classList.remove('range-info', 'range-success', 'range-error', 'range-warning', 'range-neutral', 'range-primary', 'range-secondary', 'range-accent');
                
                input.classList.add('range-' + colorName);
            });

            
            const submitBtn = document.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.classList.remove('btn-info', 'btn-success', 'btn-error', 'btn-warning', 'btn-neutral', 'btn-primary', 'btn-secondary', 'btn-accent');
                submitBtn.classList.add('btn-' + colorName);
            }
        }

        typeSelect.addEventListener('change', updateUI);
        
        updateUI();
    </script>
</body>
</html>