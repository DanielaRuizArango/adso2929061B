<?php
$tittle = '09- Class Abstract';
$descripcion = "A class that cannot be instantiated, only extended from.";

include_once 'template/header.php';

echo "<section>";

abstract class DataBase
{
    protected $host = 'localhost';
    protected $user = 'root';
    protected $pass = '';
    protected $dbname = 'pokeadso';
    protected $conx = 'localhost';

    protected function connect()
    {
        try {
            $this->conx = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->user,
                $this->pass
            );
            $this->conx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conx;
        } catch (PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
    }
}


class PokemonList extends DataBase
{
    public function getPokemons()
    {
        $db = $this->connect();
        $sql = sprintf("SELECT  id, name, type FROM pokemons");
        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


$pokemon = new PokemonList();
$pokemons = $pokemon->getPokemons();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemons</title>
    <style>
        div {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        table {
            border: 1px solid #0006;
            border-collapse: collapse;
            font-size: 0.8rem;
            width: 90%;
        }

        th {
            border: 1px solid #636ED1;
            background-color: #535EBA;
            color: white;
            padding: 0.4rem;
            font-weight: bold;
        }

        td {
            border: 1px solid #8690F1;
            background-color: #AEB4FF;
            color: #232060;
            padding: 0.8rem 0.4rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <div>
        <h2> Lista De Pokemons</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
            </tr>
            <?php foreach ($pokemons as $p): ?>
                <tr>
                    <td><?= $p['id']; ?></td>
                    <td><?= $p['name']; ?></td>
                    <td><?= $p['type']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php include_once 'template/footer.php'; ?>
</body>

</html>