import './CardPokemon.css';

function CardPokemon({name, type, power, image, legendary=false}) {
    const typeColors = {
        Electric: '#f7d02c',
        Grass: '#7ac74c',
        Fire: '#ee8130',
        Water: '#6390f0',
        Psychic: '#f95587'
    };

    const colorType = typeColors[type] || '#29b1de';

    return (
        <div className="card-pokemon" style={{ background: `linear-gradient(135deg, #000000, ${colorType})` }}>
            {legendary && <span className="legendary-icon">★Legendary★</span>}

            <img src={image} alt={name} />
            <h3>{name}</h3>
            <p>Tipo: {type}</p>
            <p>Poder: {power}</p>
        </div>
    );
}

export default CardPokemon;