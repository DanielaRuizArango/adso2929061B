import { Link } from 'react-router-dom';
import './Menu.css';

function Menu() {

const examples = [
    { id: 1, title: '01- Components',          path: '/example1', emoji: '🧩', desc: 'Independent components' },
    { id: 2, title: '02- JSX',                 path: '/example2', emoji: '✏️', desc: 'HTML in JavaScript' },
    { id: 3, title: '03- Props',               path: '/example3', emoji: '📦', desc: 'Passing data' },
    { id: 4, title: '04- State and Hooks',     path: '/example4', emoji: '⚡',  desc: 'Dynamic state' },
    { id: 5, title: '05- Event Handling',      path: '/example5', emoji: '🖱️', desc: 'Interactions' },
    { id: 6, title: '06- Conditional & Lists', path: '/example6', emoji: '📋', desc: 'Conditional rendering' },
    { id: 7, title: '07- Routing',             path: '/example7', emoji: '🗺️', desc: 'Navigation' },
    { id: 8, title: '08- Data Fetching',       path: '/example8', emoji: '🌐', desc: 'API calls' },
];

  return (
    <div className="menu">
      <h1> React JS </h1>
      <p className="menu-subtitle">JavaScript library for building UI</p>
      <div className="menu-grid">
        {examples.map((example) => (
          <Link to={example.path} key={example.id} className="menu-card">
            <span className="menu-emoji">{example.emoji}</span>
            <h3>{example.title}</h3>
            <p>{example.desc}</p>
          </Link>
        ))}
      </div>
    </div>
  );
}

export default Menu;