import { useState, useEffect } from 'react';
import Btnback from '../components/BtnBack';

function Example8DataFetching() {
    const [users, setUsers] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetch('https://jsonplaceholder.typicode.com/users')
            .then(response => response.json())
            .then(data => {
                setUsers(data);
                setLoading(false);
            })
            .catch(error => {
                console.error('Error:', error);
                setLoading(false);
            });
    }, []);

    return (
        <div className="container">
            <Btnback />
            <h2>Example8DataFetching</h2>

            {loading ? (
                <p>Cargando usuarios...</p>
            ) : (
                <ul>
                    {users.map(user => (
                        <li key={user.id}>
                            <strong>{user.name}</strong> - {user.email}
                        </li>
                    ))}
                </ul>
            )}
        </div>
    );
}

export default Example8DataFetching;