import Btnback from '../components/BtnBack';
import CardPokemon from '../components/CardPokemon';

const pokemons = [
    {
        id: 1,
        name: 'Pikachu',
        type: 'Electric',
        power: 'Thunderbolt',
        Image: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png'
    },
    {
        id: 2,
        name: 'Bulbasaur',
        type: 'Grass',
        power: 'Vine Whip',
        Image: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png'
    },
    {
        id: 3,
        name: 'Charmander',
        type: 'Fire',
        power: 'Ember',
        Image: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'
    },
    {
        id: 4,
        name: 'Lugia',
        type: 'Psychic',
        power: 'Future Sight',
        Image: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/249.png',
        legendary: true
    }
];

function Example3Props() {
    return (
        <div className="container">
            <Btnback />
            <h2>Example3Props</h2>
            <p>Pass data from parent to child components</p>
            <div className="pokemon-grid">
                {pokemons.map(pokemon => (
                    <CardPokemon 
                        key       =        {pokemon.id}
                        id        =        {pokemon.id} 
                        name      =      {pokemon.name}
                        type      =      {pokemon.type}
                        power     =     {pokemon.power}
                        image     =     {pokemon.Image}
                        legendary = {pokemon.legendary}
                    />
                ))}
            </div>
        </div>
    );
}      

export default Example3Props;