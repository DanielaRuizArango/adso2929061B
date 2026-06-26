import { useState } from 'react';
import BtnBack from '../components/BtnBack';

// --- STYLES ---
const eventContainer = {
  border: '1px solid #ddd',
  borderRadius: 8,
  padding: 20,
  marginTop: 16,
  background: '#fff'
};

const titleH3 = {
  marginTop: 18,
  marginBottom: 8
};

const btnsClick = {
  display: 'flex',
  gap: 12,
  flexWrap: 'wrap',
  justifyContent: 'center'
};

const buttonStyle = {
  padding: '8px 12px',
  borderRadius: 6,
  border: '1px solid #ccc',
  background: '#f7f7f7',
  cursor: 'pointer',
  display: 'flex',
  flexDirection: 'column',
  alignItems: 'center',
  gap: 8
};

const chosePokemon = {
  marginTop: 12,
  padding: 10,
  background: '#333',
  color: '#fff',
  borderRadius: 6,
  textAlign: 'center'
};

const hoverStyle = {
  padding: '12px 16px',
  borderRadius: 8,
  border: '1px dashed #bbb',
  background: '#fff',
  cursor: 'pointer',
  display: 'flex',
  flexDirection: 'column',
  alignItems: 'center',
  gap: 8
};

const rangeStyle = {
  width: '100%',
  marginTop: 8
};

const outPut = {
  marginTop: 10,
  padding: 8,
  background: '#222',
  color: '#fff',
  borderRadius: 6,
  textAlign: 'center'
};

// --- COMPONENTS ---
function PokemonClickButton({ name, imageUrl, onClick }) {
  return (
    <button onClick={() => onClick(name)} style={buttonStyle}>
      <img src={imageUrl} alt={name} style={{ width: 100, height: 100, objectFit: 'contain' }} />
      {name}
    </button>
  );
}

function PokemonHoverButton({ name, imageUrl, onMouseEnter, onMouseLeave }) {
  return (
    <button
      onMouseEnter={() => onMouseEnter(name)}
      onMouseLeave={onMouseLeave}
      style={hoverStyle}
    >
      <img src={imageUrl} alt={name} style={{ width: 100, height: 100, objectFit: 'contain' }} />
      Hover here!
    </button>
  );
}

function Example5Eventos() {
  const [chosenPokemon, setChosenPokemon] = useState(null);
  const [hoveredPokemon, setHoveredPokemon] = useState(null);
  const [inputRange, setInputRange] = useState(50);

  // Event Handlers
  const handleChoice = (name) => setChosenPokemon(name);
  const handleMouseEnter = (name) => setHoveredPokemon(name);
  const handleMouseLeave = () => setHoveredPokemon(null);
  const handleInput = (e) => setInputRange(e.target.value);

  return (
    <div className='container'>
      <BtnBack />

      <h2>Example 5: Event Handling</h2>
      <p>Respond to user interactions (click, hover, input, submit).</p>

      <div style={eventContainer}>
        {/* Click */}
        <h3 style={titleH3}>Click Event:</h3>
        <div style={btnsClick}>
          <PokemonClickButton
            name='Bulbasaur'
            imageUrl='https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png'
            onClick={handleChoice}
          />
          <PokemonClickButton
            name='Charmander'
            imageUrl='https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/4.png'
            onClick={handleChoice}
          />
          <PokemonClickButton
            name='Squirtle'
            imageUrl='https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/7.png'
            onClick={handleChoice}
          />
        </div>

        <div style={chosePokemon}>
          {chosenPokemon ? `You choose ${chosenPokemon}!` : 'Please choose a pokemon!'}
        </div>

        {/* MouseEnter/MouseLeave */}
        <h3 style={titleH3}>MouseEnter/MouseLeave Event:</h3>
        <div style={btnsClick}>
          <PokemonHoverButton
            name='Pikachu'
            imageUrl='https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png'
            onMouseEnter={handleMouseEnter}
            onMouseLeave={handleMouseLeave}
          />
          <PokemonHoverButton
            name='Eevee'
            imageUrl='https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/133.png'
            onMouseEnter={handleMouseEnter}
            onMouseLeave={handleMouseLeave}
          />
        </div>

        {hoveredPokemon && (
          <div style={chosePokemon}>
            You are viewing: {hoveredPokemon}!
          </div>
        )}

        {/* Input */}
        <h3 style={titleH3}>Input Event:</h3>
        <input
          style={rangeStyle}
          onChange={handleInput}
          value={inputRange}
          type='range'
          min='0'
          max='100'
        />

        <span style={{ display: 'block', textAlign: 'center', color: '#000000' }}>
          power:
        </span>

        {inputRange && (
          <div style={outPut}>
            {inputRange}
          </div>
        )}
      </div>
    </div>
  );
}

export default Example5Eventos;