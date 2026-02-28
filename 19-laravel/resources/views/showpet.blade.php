<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mascota</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gradient-to-br from-sky-700 to-sky-900 min-h-screen flex flex-col items-center p-10">
    <h1 class="text-sky-100 text-4xl font-bold text-center mb-10">
        Mascota
    </h1>

    <div class="card w-full max-w-md bg-base-100 shadow-2xl rounded-2xl overflow-hidden">
        
        <figure class="h-64 bg-gray-200">
            <img
                src="{{ asset('images/'.$pet->image) }}"
                alt="{{ $pet->name }}"
                class="max-h-full max-w-full object-contain" />
        </figure>

        <div class="card-body space-y-2">
            <h2 class="card-title text-2xl font-bold text-sky-700">
                {{ $pet->name }}
            </h2>

            <p class="text-gray-600 italic">
                {{ $pet->description }}
            </p>

            <div class="divider"></div>

            <div class="grid grid-cols-2 gap-2 text-sm">
                <p><span class="font-semibold">Edad:</span> {{ $pet->age }} años</p>
                <p><span class="font-semibold">Peso:</span> {{ $pet->weight }} kg</p>
                <p><span class="font-semibold">Especie:</span> {{ $pet->kind }}</p>
                <p><span class="font-semibold">Raza:</span> {{ $pet->breed }}</p>
                <p class="col-span-2">
                    <span class="font-semibold">Ubicación:</span> {{ $pet->location }}
                </p>
            </div>

            <div class="flex gap-2 mt-4">
                <span class="badge badge-success">
                    {{ $pet->active ? 'Activo' : 'Inactivo' }}
                </span>

                <span class="badge {{ $pet->adopted ? 'badge-error' : 'badge-info' }}">
                    {{ $pet->adopted ? 'Adoptado' : 'Disponible' }}
                </span>
            </div>

        </div>
    </div>

<div class="mt-8 text-center">
    <a href="{{ url('getall/pets') }}" 
       class="btn btn-outline btn-wide text-white border-white hover:bg-white hover:text-sky-700 transition-all duration-300">
        ← Volver
    </a>
</div>

</body>
</html>