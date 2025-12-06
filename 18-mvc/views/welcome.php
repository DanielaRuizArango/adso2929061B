<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <div class="hero bg-base-200 min-h-screen">
  <div class="hero-content text-center">
    <div class="max-w-md">
      <h1 class="text-5xl font-bold">MVC</h1>
      <h3 class="mb-10">Model View Controller</h3>

      <a href="/pokemons/create" class="btn btn-success my-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentcolor" viewBox="0 0 256 256"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H136v32a8,8,0,0,1-16,0V136H88a8,8,0,0,1,0-16h32V88a8,8,0,0,1,16,0v32h32A8,8,0,0,1,176,128Z"></path></svg>
        Add Pokemon
      </a>
      <!-- Table -->
      <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
  <table class="table">
    <!-- head -->
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Type</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $pokemon): ?>
      <tr>
        <th><?=htmlspecialchars($pokemon['id'])?></th>
        <td><?=htmlspecialchars($pokemon['name'])?></td>
        <td>
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
        </td>
        <td>
          <a href="/pokemons/view/<?=$pokemon['id']?>" class="btn btn-xs btn-neutral">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="Currentcolor" viewBox="0 0 256 256"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path></svg>
          </a>
          <a href="/pokemons/edit/<?=$pokemon['id']?>" class="btn btn-xs btn-neutral">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="Currentcolor" viewBox="0 0 256 256"><path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"></path></svg>
          </a>
          <a href="/pokemons/delete/<?=$pokemon['id']?>" class="btn btn-xs btn-error" onclick="return confirm('¿Estás seguro de que deseas eliminar este Pokémon?');">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="Currentcolor" viewBox="0 0 256 256"><path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path></svg>
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>  
    </div>
  </div>
</div>
</body>
</html>