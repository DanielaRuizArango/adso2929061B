import { useEffect, useState } from 'react';
import axios from 'axios';
import './Challenge.css';

const API_BASE_URL = 'http://127.0.0.1:8000/api';
const LOGIN_URL = `${API_BASE_URL}/login`;
const PETS_URL = `${API_BASE_URL}/pets/list`;
const LOGOUT_URL = `${API_BASE_URL}/logout`;
const PET_IMAGE = '/images/image2.png';

function PawIcon() {
  return (
    <svg viewBox="0 0 24 24" role="img">
      <circle cx="5.8" cy="9" r="2.3" />
      <circle cx="10" cy="5.8" r="2.3" />
      <circle cx="14" cy="5.8" r="2.3" />
      <circle cx="18.2" cy="9" r="2.3" />
      <path d="M6.8 17.2c0-3.3 2.5-6 5.2-6s5.2 2.7 5.2 6c0 2.2-1.5 3.1-3 2.2-1.4-.8-3-.8-4.4 0-1.5.9-3-.1-3-2.2Z" />
    </svg>
  );
}

function MailIcon() {
  return (
    <svg viewBox="0 0 24 24" role="img">
      <path d="M4 6h16v12H4z" />
      <path d="m4 7 8 6 8-6" />
    </svg>
  );
}

function LockIcon() {
  return (
    <svg viewBox="0 0 24 24" role="img">
      <rect x="5" y="10" width="14" height="10" rx="2" />
      <path d="M8 10V7a4 4 0 0 1 8 0v3" />
      <path d="M12 14v2" />
    </svg>
  );
}

function LogoutIcon() {
  return (
    <svg viewBox="0 0 24 24" role="img">
      <path d="M9 21H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h4" />
      <path d="M16 17l5-5-5-5" />
      <path d="M21 12H9" />
    </svg>
  );
}

function HeartIcon() {
  return (
    <svg viewBox="0 0 24 24" role="img">
      <path d="M20.8 4.6a5.4 5.4 0 0 0-7.6 0L12 5.8l-1.2-1.2a5.4 5.4 0 1 0-7.6 7.6L12 21l8.8-8.8a5.4 5.4 0 0 0 0-7.6Z" />
    </svg>
  );
}

function PencilIcon() {
  return (
    <svg viewBox="0 0 24 24" role="img">
      <path d="M12 20h9" />
      <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" />
    </svg>
  );
}

function TrashIcon() {
  return (
    <svg viewBox="0 0 24 24" role="img">
      <path d="M3 6h18" />
      <path d="M8 6V4h8v2" />
      <path d="M19 6l-1 14H6L5 6" />
      <path d="M10 11v6" />
      <path d="M14 11v6" />
    </svg>
  );
}

function getPetImage(image) {
  if (!image) {
    return PET_IMAGE;
  }

  if (image.startsWith('http') || image.startsWith('/')) {
    return image;
  }

  return `http://127.0.0.1:8000/storage/${image}`;
}

function getPetStatus(pet) {
  if (pet.adopted) {
    return 'Adoptada';
  }

  if (pet.active === false || pet.active === 0) {
    return 'No disponible';
  }

  return 'Disponible';
}

function PetCard({ pet }) {
  return (
    <article className="pet-card">
      <div className="pet-photo-wrap">
        <img className="pet-photo" src={getPetImage(pet.image)} alt={pet.name} />
        <span className="pet-status">{getPetStatus(pet)}</span>
      </div>

      <div className="pet-info">
        <div className="pet-name-row">
          <span className="small-paw" aria-hidden="true">
            <PawIcon />
          </span>
          <h2>{pet.name}</h2>
        </div>
        <p>{pet.breed || pet.kind || 'Mascota'}</p>
        <p>{pet.age ? `${pet.age} años` : 'Edad no registrada'}</p>
      </div>

      <div className="pet-actions" aria-label={`Acciones para ${pet.name}`}>
        <button type="button" aria-label="Favorito">
          <HeartIcon />
        </button>
        <button type="button" aria-label="Editar">
          <PencilIcon />
        </button>
        <button type="button" aria-label="Eliminar">
          <TrashIcon />
        </button>
      </div>
    </article>
  );
}

function PetsView({ onLogout }) {
  const [pets, setPets] = useState([]);
  const [status, setStatus] = useState({ type: 'loading', message: 'Cargando mascotas...' });

  useEffect(() => {
    const loadPets = async () => {
      const token = localStorage.getItem('larapets_token');

      try {
        const { data } = await axios.get(PETS_URL, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        setPets(data.data || []);
        setStatus({ type: 'success', message: '' });
      } catch (error) {
        const message = error.response?.data?.message || 'No se pudo cargar la lista de mascotas.';
        setStatus({ type: 'error', message });
      }
    };

    loadPets();
  }, []);

  return (
    <div className="pets-page">
      <main className="pets-shell">
        <header className="pets-header">
          <div className="pets-title">
            <img src="/images/logo1.png" alt="" />
            <div>
              <h1>Mis mascotas</h1>
              <p>Gestiona las mascotas disponibles para adopción.</p>
            </div>
          </div>

          <button className="logout-button" type="button" onClick={onLogout} aria-label="Cerrar sesión">
            <LogoutIcon />
          </button>
        </header>

        <button className="add-pet-button" type="button">
          <PawIcon />
          Agregar mascota
        </button>

        {status.message && (
          <p className={`pets-message ${status.type}`}>{status.message}</p>
        )}

        {!status.message && pets.length === 0 && (
          <p className="pets-message">No hay mascotas registradas.</p>
        )}

        {pets.length > 0 && (
          <section className="pets-grid" aria-label="Lista de mascotas">
            {pets.map((pet) => (
              <PetCard key={pet.id} pet={pet} />
            ))}
          </section>
        )}

        <img className="pets-scene" src={PET_IMAGE} alt="" />

      </main>
    </div>
  );
}

function Challenge() {
  const [form, setForm] = useState({ email: '', password: '' });
  const [status, setStatus] = useState({ type: '', message: '' });
  const [loading, setLoading] = useState(false);
  const [isLoggedIn, setIsLoggedIn] = useState(() => Boolean(localStorage.getItem('larapets_token')));

  const handleChange = (event) => {
    const { name, value } = event.target;
    setForm((currentForm) => ({
      ...currentForm,
      [name]: value,
    }));
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    setLoading(true);
    setStatus({ type: '', message: '' });

    try {
      const { data } = await axios.post(LOGIN_URL, form);

      localStorage.setItem('larapets_token', data.token);
      localStorage.setItem('larapets_user', JSON.stringify(data.user));
      setStatus({ type: 'success', message: 'Inicio de sesión exitoso.' });
      setIsLoggedIn(true);
    } catch (error) {
      const message = error.response?.data?.message || 'No se pudo iniciar sesión. Revisa tus datos.';
      setStatus({ type: 'error', message });
    } finally {
      setLoading(false);
    }
  };

  const handleLogout = async () => {
    const token = localStorage.getItem('larapets_token');

    try {
      if (token) {
        await axios.post(LOGOUT_URL, null, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
      }
    } catch (error) {
      console.error('No se pudo cerrar sesión en el servidor.', error);
    }

    localStorage.removeItem('larapets_token');
    localStorage.removeItem('larapets_user');
    setIsLoggedIn(false);
    setForm({ email: '', password: '' });
    setStatus({ type: '', message: '' });
  };

  if (isLoggedIn) {
    return <PetsView onLogout={handleLogout} />;
  }

  return (
    <div className="challenge-page">
      <div className="challenge-card">
        <div className="brand">
          <img className="brand-logo" src="/images/logo1.png" alt="" />
          <h1>Larapets</h1>
        </div>

        <img className="hero-image" src="/images/image1.png" alt="Mascotas" />

        <form className="challenge-form" onSubmit={handleSubmit}>
          <label className="input-group">
            <span className="input-icon" aria-hidden="true">
              <MailIcon />
            </span>
            <input
              type="email"
              name="email"
              placeholder="correo"
              value={form.email}
              onChange={handleChange}
              autoComplete="email"
              required
            />
          </label>

          <label className="input-group">
            <span className="input-icon" aria-hidden="true">
              <LockIcon />
            </span>
            <input
              type="password"
              name="password"
              placeholder="contraseña"
              value={form.password}
              onChange={handleChange}
              autoComplete="current-password"
              required
            />
          </label>

          <button className="challenge-button" type="submit" disabled={loading}>
            <span className="button-icon" aria-hidden="true">
              <PawIcon />
            </span>
            {loading ? 'Iniciando...' : 'Iniciar sesión'}
          </button>

          {status.message && (
            <p className={`login-message ${status.type}`}>
              {status.message}
            </p>
          )}
        </form>
      </div>
    </div>
  );
}

export default Challenge;
