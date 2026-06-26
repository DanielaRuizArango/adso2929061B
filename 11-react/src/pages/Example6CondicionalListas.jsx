import { useState } from 'react';
import BtnBack from '../components/BtnBack';

function Example6ConditionalLists() {
    const [pcBox, setPcBox] = useState([
        { id: 1, name: 'Pidgey', level: 3, type: 'Normal/Flying' },
        { id: 2, name: 'Rattata', level: 2, type: 'Normal' },
        { id: 3, name: 'Zubat', level: 4, type: 'Poison/Flying' },
        { id: 4, name: 'Geodude', level: 5, type: 'Rock/Ground' },
    ]);

    const [typeFilter, setTypeFilter] = useState('all');
    const [showOnlyHighLevel, setShowOnlyHighLevel] = useState(false);

    // Release Pokemon (remove from list)
    const releasePokemon = (id) => {
        setPcBox(pcBox.filter((pokemon) => pokemon.id !== id));
    };

    // Add a random Pokemon
    const addPokemon = () => {
        const newPokemon = [
            { id: Date.now(), name: 'Caterpie', level: 2, type: 'Bug' },
            { id: Date.now() + 1, name: 'Weedle', level: 2, type: 'Bug/Poison' },
            { id: Date.now() + 2, name: 'Pidgeotto', level: 8, type: 'Normal/Flying' },
        ];

        const random =
            newPokemon[Math.floor(Math.random() * newPokemon.length)];

        setPcBox([...pcBox, { ...random, id: Date.now() }]);
    };

    // Filter Pokemon according to criteria
    const filteredPokemon = pcBox.filter((pokemon) => {
        // Filter by type
        if (
            typeFilter !== 'all' &&
            !pokemon.type.toLowerCase().includes(typeFilter)
        ) {
            return false;
        }

        // Filter by level
        if (showOnlyHighLevel && pokemon.level < 4) {
            return false;
        }

        return true;
    });

    const boxStyle = {
        border: '1px solid #ddd',
        borderRadius: '10px',
        padding: '15px',
        margin: '10px',
        width: '180px',
        backgroundColor: '#00000052',
        boxShadow: '0 4px 8px rgba(0,0,0,0.1)',
        textAlign: 'center'
    };

    const releaseButton = {
        backgroundColor: '#ff4d4d',
        color: 'white',
        border: 'none',
        padding: '8px 10px',
        cursor: 'pointer',
        borderRadius: '5px',
        width: '100%',
        marginTop: '10px',
        fontWeight: 'bold'
    };

    const buttonStyle = {
        padding: '10px 15px',
        borderRadius: '5px',
        border: 'none',
        backgroundColor: '#4CAF50',
        color: 'white',
        cursor: 'pointer',
        marginTop: '15px',
        fontWeight: 'bold',
        fontSize: '14px'
    };

    return (
        <div className="container">
            <BtnBack />

            <h2>Example 6: Conditional Rendering</h2>
            <p>Show or hide UI elements based on state.</p>

            <div style={{ backgroundColor: '#00000052', padding: '20px', borderRadius: '8px', marginBottom: '20px' }}>
                <h3 style={{ marginTop: 0 }}>Filters:</h3>

                <div style={{ display: 'flex', gap: '20px', flexWrap: 'wrap', alignItems: 'center' }}>
                    <select
                        value={typeFilter}
                        onChange={(e) => setTypeFilter(e.target.value)}
                        style={{ padding: '8px', borderRadius: '5px', border: '1px solid #ccc' }}
                    >
                        <option value="all">All types</option>
                        <option value="normal">Normal</option>
                        <option value="flying">Flying</option>
                        <option value="poison">Poison</option>
                        <option value="bug">Bug</option>
                    </select>

                    <label style={{ display: 'flex', alignItems: 'center', cursor: 'pointer' }}>
                        <input
                            style={{ accentColor: '#4CAF50', width: '18px', height: '18px' }}
                            type="checkbox"
                            checked={showOnlyHighLevel}
                            onChange={(e) => setShowOnlyHighLevel(e.target.checked)}
                        />
                        <span style={{ marginLeft: '8px' }}>Show only level 4+</span>
                    </label>
                </div>

                <button onClick={addPokemon} style={buttonStyle}>
                    + Random Pokemon
                </button>
            </div>

            {/* Conditional Rendering: if the list is empty */}
            {filteredPokemon.length === 0 ? (
                <div style={boxStyle}>
                    <h3>The box is empty</h3>
                    <p>No Pokemon match the selected filters.</p>
                </div>
            ) : (
                <div>
                    <p>
                        <strong>
                            Showing {filteredPokemon.length} of {pcBox.length} Pokemon
                        </strong>
                    </p>

                    <div
                        style={{
                            display: 'flex',
                            flexWrap: 'wrap',
                            gap: '10px',
                        }}
                    >
                        {filteredPokemon.map((pokemon) => (
                            <div key={pokemon.id} style={boxStyle}>
                                <h4 style={{ margin: '0 0 10px 0', color: '#ffffffff' }}>{pokemon.name}</h4>
                                <p style={{ margin: '5px 0', fontSize: '14px', color: '#c1c5b5ff' }}>Level: {pokemon.level}</p>
                                <p style={{ margin: '5px 0', fontSize: '14px', color: '#adc1c5ff', fontWeight: 'bold' }}>Type: {pokemon.type}</p>

                                <button
                                    onClick={() => releasePokemon(pokemon.id)}
                                    style={releaseButton}
                                >
                                    Release
                                </button>
                            </div>
                        ))}
                    </div>
                </div>
            )}
        </div>
    );
}

export default Example6ConditionalLists;