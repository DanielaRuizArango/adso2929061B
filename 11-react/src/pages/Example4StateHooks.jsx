import { useEffect, useState } from 'react';
import Btnback from '../components/BtnBack';

const pokemons = [
    'mew',
    'dragonite',
    'riolu'
];

function Example4StateHooks() {
    const [pokemonActual, setPokemonActual] = useState('mew');
    const [pokemon, setPokemon] = useState(null);
    const [comida, setComida] = useState(0);
    const [saltando, setSaltando] = useState(false);
    const [mostrarMasUno, setMostrarMasUno] = useState(false);

    useEffect(() => {
        fetch(`https://pokeapi.co/api/v2/pokemon/${pokemonActual}`)
            .then(response => response.json())
            .then(data => {
                setPokemon({
                    name: data.name,
                    image: data.sprites.other['official-artwork'].front_default
                });
            });
    }, [pokemonActual]);

    function cambiarPokemon(event) {
        setPokemonActual(event.target.value);
        setComida(0);
    }

    function alimentarPokemon() {
        setComida(comida + 1);
        setSaltando(true);
        setMostrarMasUno(true);

        setTimeout(() => {
            setSaltando(false);
            setMostrarMasUno(false);
        }, 500);
    }

    return (
        <div className="container">
            <Btnback />
            <h2>Example4StateHooks</h2>

            <div className="pokemon-feed-card">
                <h3>{pokemon ? pokemon.name : 'Cargando...'}</h3>

                <select onChange={cambiarPokemon} value={pokemonActual}>
                    {pokemons.map(pokemon => (
                        <option key={pokemon} value={pokemon}>
                            {pokemon}
                        </option>
                    ))}
                </select>

                <div className="pokemon-area">
                    {mostrarMasUno && <span className="plus-one">+1</span>}
                    {pokemon && (
                        <img
                            className={saltando ? 'pokemon-jump' : ''}
                            src={pokemon.image}
                            alt={pokemon.name}
                        />
                    )}
                </div>

                <p>Comida: {comida}</p>
                <button onClick={alimentarPokemon}>Alimentar</button>
            </div>
        </div>
    );
}    

export default Example4StateHooks;