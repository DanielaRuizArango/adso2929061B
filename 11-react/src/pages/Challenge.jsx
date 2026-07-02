import { useEffect, useState } from 'react';
import axios from 'axios';
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import './Challenge.css';

const API_BASE_URL = 'http://127.0.0.1:8000/api';
const LOGIN_URL = `${API_BASE_URL}/login`;
const LOGOUT_URL = `${API_BASE_URL}/logout`;
const PETS_URL = `${API_BASE_URL}/pets/list`;
const PET_SHOW_URL = `${API_BASE_URL}/pets/show`;
const PET_STORE_URL = `${API_BASE_URL}/pets/store`;
const PET_EDIT_URL = `${API_BASE_URL}/pets/edit`;
const PET_DELETE_URL = `${API_BASE_URL}/pets/delete`;
const PET_IMAGE = '/images/image2.png';
const FORM_FOOTER_IMAGE = '/images/image3.png';
const PET_KIND_OPTIONS = [
  { value: 'Dog', label: 'Perro' },
  { value: 'Cat', label: 'Gato' },
  { value: 'Bird', label: 'Ave' },
  { value: 'Pig', label: 'Cerdo' },
  { value: 'Other', label: 'Otro' },
];
const PET_KIND_ALIASES = {
  Perro: 'Dog',
  Gato: 'Cat',
  Ave: 'Bird',
  Cerdo: 'Pig',
  Otro: 'Other',
};
const swal = Swal.mixin({
  background: '#FFFDF9',
  color: '#4B3425',
  confirmButtonColor: '#E98B42',
  cancelButtonColor: '#78885A',
  customClass: {
    popup: 'larapets-alert',
    title: 'larapets-alert-title',
    htmlContainer: 'larapets-alert-text',
    confirmButton: 'larapets-alert-confirm',
    cancelButton: 'larapets-alert-cancel',
  },
  buttonsStyling: false,
});

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

function BackIcon() {
  return (
    <svg viewBox="0 0 24 24" role="img">
      <path d="M19 12H5" />
      <path d="M12 19l-7-7 7-7" />
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

function getAuthHeaders() {
  return {
    Authorization: `Bearer ${localStorage.getItem('larapets_token')}`,
  };
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
  if (getFlagValue(pet.adopted, 0) === '1') {
    return 'Adoptada';
  }

  if (getFlagValue(pet.active, 1) === '0') {
    return 'No disponible';
  }

  return 'Disponible';
}

function getPetKindValue(kind) {
  return PET_KIND_ALIASES[kind] || kind || '';
}

function getPetKindLabel(kind) {
  const normalizedKind = getPetKindValue(kind);
  return PET_KIND_OPTIONS.find((option) => option.value === normalizedKind)?.label || kind || '';
}

function getFlagValue(value, defaultValue) {
  if (value === undefined || value === null || value === '') {
    return String(defaultValue);
  }

  return value === true || value === 1 || value === '1' ? '1' : '0';
}

function getApiErrorMessage(error, fallbackMessage) {
  const errors = error.response?.data?.errors;
  if (errors) {
    return Object.values(errors).flat().join('<br>');
  }

  return error.response?.data?.message || fallbackMessage;
}

function showError(title, message) {
  return swal.fire({
    icon: 'error',
    title,
    html: message,
  });
}

function PetCard({ pet, onView, onEdit, onDelete }) {
  return (
    <article className="pet-card">
      <div className="pet-photo-wrap">
        <img
          className="pet-photo"
          src={getPetImage(pet.image)}
          alt={pet.name}
          onError={(event) => {
            event.currentTarget.src = PET_IMAGE;
          }}
        />
        <span className="pet-status">{getPetStatus(pet)}</span>
      </div>

      <div className="pet-info">
        <div className="pet-name-row">
          <span className="small-paw" aria-hidden="true">
            <PawIcon />
          </span>
          <h2>{pet.name}</h2>
        </div>
        <p>{pet.breed || getPetKindLabel(pet.kind) || 'Mascota'}</p>
        <p>{pet.age ? `${pet.age} años` : 'Edad no registrada'}</p>
      </div>

      <div className="pet-actions" aria-label={`Acciones para ${pet.name}`}>
        <button type="button" onClick={() => onView(pet.id)} aria-label="Ver mascota">
          <PawIcon />
        </button>
        <button type="button" onClick={() => onEdit(pet)} aria-label="Editar">
          <PencilIcon />
        </button>
        <button type="button" onClick={() => onDelete(pet)} aria-label="Eliminar">
          <TrashIcon />
        </button>
      </div>
    </article>
  );
}

function PetForm({ pet, onBack, onSubmit }) {
  const [form, setForm] = useState({
    name: pet?.name || '',
    kind: getPetKindValue(pet?.kind),
    breed: pet?.breed || '',
    age: pet?.age || '',
    weight: pet?.weight || '',
    location: pet?.location || '',
    description: pet?.description || '',
    active: getFlagValue(pet?.active, 1),
    adopted: getFlagValue(pet?.adopted, 0),
    image: null,
  });
  const [saving, setSaving] = useState(false);
  const isEditing = Boolean(pet);

  const handleChange = (event) => {
    const { files, name, type, value } = event.target;
    setForm((currentForm) => ({
      ...currentForm,
      [name]: type === 'file' ? files[0] || null : value,
    }));
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    setSaving(true);

    try {
      await onSubmit({
        ...form,
        age: Number(form.age),
        weight: Number(form.weight),
        active: Number(form.active),
        adopted: Number(form.adopted),
      });
    } finally {
      setSaving(false);
    }
  };

  return (
    <main className="pets-shell pet-form-shell">
      <button className="back-button" type="button" onClick={onBack} aria-label="Volver">
        <BackIcon />
      </button>

      <header className="pet-form-header">
        <span className="form-title-icon" aria-hidden="true">
          <PawIcon />
        </span>
        <div>
          <h1>{isEditing ? 'Editar mascota' : 'Agregar mascota'}</h1>
          <p>{isEditing ? 'Actualiza la información de la mascota.' : 'Completa la información para registrar una nueva mascota.'}</p>
        </div>
      </header>

      <form className="pet-form" onSubmit={handleSubmit}>
        <label>
          <span><PawIcon /> Foto</span>
          <input name="image" type="file" accept="image/png,image/jpeg,image/webp" onChange={handleChange} />
        </label>

        <label>
          <span><PawIcon /> Nombre *</span>
          <input name="name" value={form.name} onChange={handleChange} placeholder="Ej. Milo" required />
        </label>

        <label>
          <span><PawIcon /> Especie *</span>
          <select name="kind" value={form.kind} onChange={handleChange} required>
            <option value="">Selecciona la especie</option>
            {PET_KIND_OPTIONS.map((option) => (
              <option key={option.value} value={option.value}>
                {option.label}
              </option>
            ))}
          </select>
        </label>

        <label>
          <span><PawIcon /> Raza</span>
          <input name="breed" value={form.breed} onChange={handleChange} placeholder="Ej. Mestizo" />
        </label>

        <label>
          <span><PawIcon /> Edad *</span>
          <input name="age" type="number" min="0" step="1" value={form.age} onChange={handleChange} placeholder="Ej. 2" required />
        </label>

        <label>
          <span><PawIcon /> Peso *</span>
          <input name="weight" type="number" min="0" step="0.1" value={form.weight} onChange={handleChange} placeholder="Ej. 12" required />
        </label>

        <label>
          <span><PawIcon /> Ubicación *</span>
          <input name="location" value={form.location} onChange={handleChange} placeholder="Ej. Bogotá" required />
        </label>

        <label>
          <span><PawIcon /> Descripción *</span>
          <textarea
            name="description"
            value={form.description}
            onChange={handleChange}
            placeholder="Cuéntanos sobre su personalidad, hábitos, lo que le gusta..."
            maxLength="300"
            required
          />
        </label>

        <label>
          <span><PawIcon /> Status activo *</span>
          <select name="active" value={form.active} onChange={handleChange} required>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
        </label>

        <label>
          <span><PawIcon /> Adopción *</span>
          <select name="adopted" value={form.adopted} onChange={handleChange} required>
            <option value="0">No adoptada</option>
            <option value="1">Adoptada</option>
          </select>
        </label>

        <button className="save-pet-button" type="submit" disabled={saving}>
          <PawIcon />
          {saving ? 'Guardando...' : 'Guardar mascota'}
        </button>
      </form>

      <img className="pet-form-footer" src={FORM_FOOTER_IMAGE} alt="" />
    </main>
  );
}

function PetDetail({ pet, onBack, onEdit }) {
  return (
    <main className="pets-shell pet-detail-shell">
      <button className="back-button" type="button" onClick={onBack} aria-label="Volver">
        <BackIcon />
      </button>

      <section className="detail-hero">
        <div className="detail-photo-wrap">
          <img
            className="detail-photo"
            src={getPetImage(pet.image)}
            alt={pet.name}
            onError={(event) => {
              event.currentTarget.src = PET_IMAGE;
            }}
          />
          <span className="pet-status detail-status">
            <PawIcon />
            {getPetStatus(pet)}
          </span>
        </div>

        <div className="detail-summary">
          <div className="detail-title">
            <PawIcon />
            <h1>{pet.name}</h1>
          </div>
          <p>{pet.breed || getPetKindLabel(pet.kind) || 'Mascota'}</p>
        </div>
      </section>

      <ul className="detail-data-list">
        <li><span>Edad</span>{pet.age || 'No registrada'}</li>
        <li><span>Especie</span>{getPetKindLabel(pet.kind) || 'No registrada'}</li>
        <li><span>Peso</span>{pet.weight || 'No registrado'}</li>
        <li><span>Ubicación</span>{pet.location || 'No registrada'}</li>
      </ul>

      <section className="detail-panel">
        <h2><PawIcon /> Descripción</h2>
        <p>{pet.description || 'Esta mascota todavía no tiene descripción.'}</p>
      </section>

      <section className="detail-info-grid">
        <article className="detail-status-row">
          <h2><PawIcon /> Status activo</h2>
          <p>{getFlagValue(pet.active, 1) === '1' ? 'Activo' : 'Inactivo'}</p>
        </article>

        <article className="detail-status-row">
          <h2><PawIcon /> Adopción</h2>
          <p>{getFlagValue(pet.adopted, 0) === '1' ? 'Adoptada' : 'No adoptada'}</p>
        </article>
      </section>

      <button className="detail-edit-button" type="button" onClick={() => onEdit(pet)}>
        <PencilIcon />
        Editar mascota
      </button>

      <img className="pet-detail-footer" src="/images/image1.png" alt="" />
    </main>
  );
}

function PetsView({ onLogout }) {
  const [pets, setPets] = useState([]);
  const [status, setStatus] = useState({ type: 'loading', message: 'Cargando mascotas...' });
  const [view, setView] = useState('list');
  const [selectedPet, setSelectedPet] = useState(null);

  const loadPets = async () => {
    setStatus({ type: 'loading', message: 'Cargando mascotas...' });

    try {
      const { data } = await axios.get(PETS_URL, {
        headers: getAuthHeaders(),
      });

      setPets(data.data || []);
      setStatus({ type: 'success', message: '' });
    } catch (error) {
      const message = error.response?.data?.message || 'No se pudo cargar la lista de mascotas.';
      setStatus({ type: 'error', message });
    }
  };

  useEffect(() => {
    loadPets();
  }, []);

  const handleViewPet = async (id) => {
    try {
      const { data } = await axios.get(`${PET_SHOW_URL}/${id}`, {
        headers: getAuthHeaders(),
      });
      setSelectedPet(data.data);
      setView('detail');
    } catch (error) {
      showError('No se pudo consultar', error.response?.data?.message || 'No se pudo consultar la mascota.');
    }
  };

  const handleCreatePet = async () => {
    setSelectedPet(null);
    setView('form');
  };

  const handleEditPet = (pet) => {
    setSelectedPet(pet);
    setView('form');
  };

  const handleSavePet = async (payload) => {
    const formData = new FormData();

    Object.entries(payload).forEach(([key, value]) => {
      if (value !== null && value !== undefined && value !== '') {
        formData.append(key, value);
      }
    });

    try {
      const isEditing = Boolean(selectedPet);

      if (selectedPet) {
        formData.append('_method', 'PUT');
        await axios.post(`${PET_EDIT_URL}/${selectedPet.id}`, formData, {
          headers: {
            ...getAuthHeaders(),
            'Content-Type': 'multipart/form-data',
          },
        });
      } else {
        await axios.post(PET_STORE_URL, formData, {
          headers: {
            ...getAuthHeaders(),
            'Content-Type': 'multipart/form-data',
          },
        });
      }

      setView('list');
      setSelectedPet(null);
      await loadPets();
      await swal.fire({
        icon: 'success',
        title: isEditing ? 'Mascota actualizada' : 'Mascota creada',
        text: isEditing ? 'Los cambios quedaron guardados correctamente.' : 'La mascota fue registrada correctamente.',
      });
    } catch (error) {
      showError('No se pudo guardar', getApiErrorMessage(error, 'No se pudo guardar la mascota.'));
      throw error;
    }
  };

  const handleBackToList = () => {
    setView('list');
    setSelectedPet(null);
  };

  const handleDeletePet = async (pet) => {
    const result = await swal.fire({
      icon: 'warning',
      title: `Eliminar a ${pet.name}`,
      text: 'Esta accion no se puede deshacer.',
      showCancelButton: true,
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar',
      reverseButtons: true,
    });

    if (!result.isConfirmed) {
      return;
    }

    try {
      await axios.delete(`${PET_DELETE_URL}/${pet.id}`, {
        headers: getAuthHeaders(),
      });
      await loadPets();
      await swal.fire({
        icon: 'success',
        title: 'Mascota eliminada',
        text: `${pet.name} fue eliminada correctamente.`,
      });
    } catch (error) {
      showError('No se pudo eliminar', error.response?.data?.message || 'No se pudo eliminar la mascota.');
    }
  };

  if (view === 'form') {
    return (
      <div className="pets-page">
        <PetForm pet={selectedPet} onBack={handleBackToList} onSubmit={handleSavePet} />
      </div>
    );
  }

  if (view === 'detail' && selectedPet) {
    return (
      <div className="pets-page">
        <PetDetail pet={selectedPet} onBack={handleBackToList} onEdit={handleEditPet} />
      </div>
    );
  }

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

        <button className="add-pet-button" type="button" onClick={handleCreatePet}>
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
              <PetCard
                key={pet.id}
                pet={pet}
                onView={handleViewPet}
                onEdit={handleEditPet}
                onDelete={handleDeletePet}
              />
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
      swal.fire({
        icon: 'success',
        title: 'Bienvenida',
        text: 'Inicio de sesion exitoso.',
        timer: 1400,
        showConfirmButton: false,
      });
    } catch (error) {
      const message = error.response?.data?.message || 'No se pudo iniciar sesión. Revisa tus datos.';
      setStatus({ type: 'error', message });
      showError('No se pudo iniciar sesion', message);
    } finally {
      setLoading(false);
    }
  };

  const handleLogout = async () => {
    const token = localStorage.getItem('larapets_token');

    try {
      if (token) {
        await axios.post(LOGOUT_URL, null, {
          headers: getAuthHeaders(),
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
