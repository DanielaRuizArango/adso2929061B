<?php

class Model extends Database
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function listPokemons()
    {
        $stmt = $this->db->query("SELECT * FROM pokemons");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function viewPokemon($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM pokemons WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function createPokemon($name, $type, $strength, $stamina, $speed, $acurracy, $trainer_id)
{
    $stmt = $this->db->prepare("INSERT INTO pokemons (name, type, strength, stamina, speed, acurracy, trainer_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$name, $type, $strength,$stamina,$speed, $acurracy, $trainer_id]);
}


    public function updatePokemon($id, $name, $type)
    {
        $stmt = $this->db->prepare("UPDATE pokemons SET name = ?, type = ? WHERE id = ?");
        return $stmt->execute([$name, $type, $id]);
    }

    // ELIMINAR
    public function deletePokemon($id)
    {
        $stmt = $this->db->prepare("DELETE FROM pokemons WHERE id = ?");
        return $stmt->execute([$id]);
    }

}
