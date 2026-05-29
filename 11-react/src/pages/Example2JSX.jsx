import { useState } from 'react';
import Btnback from '../components/BtnBack';

const url =
    'https://i.pinimg.com/736x/8f/5d/1e/8f5d1ecd1b02e91c63906d0ddd452e80.jpg';

function Example2JSX() {
    const [color, setColor] = useState('purple');

    const changeColor = () => {
        const colors = ['purple', 'tomato', 'teal', 'orange', 'crimson'];
        const randomColor =
            colors[Math.floor(Math.random() * colors.length)];

        setColor(randomColor);
    };

    return (
        <div className="container">
            <Btnback />

            <h2 style={{ color }}>Example2JSX</h2>

            <p>
                Writing HTML-like within JavaScript using curly braces
                &#123; &#125;
            </p>

            <img
                src={url}
                alt="Maomao"
                style={{ width: '200px', borderRadius: '8px' }}
            />

            <h4>7+8+6/3*4 = {7 + 8 + (6 / 3) * 4}</h4>

            <button
                onClick={changeColor}
                style={{ marginLeft: '10px' }}
            >
                Change Color
            </button>
        </div>
    );
}

export default Example2JSX;