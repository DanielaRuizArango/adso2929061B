import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import { PETS_URL, PET_DELETE_URL, PET_IMAGE } from '../constants';
import { swal, showError } from '../alerts';
import { getAuthHeaders } from '../helpers';
import PetCard from '../components/PetCard';
import { LogoutIcon, PawIcon } from '../icons';

function PetsListPage({ onLogout }) {
  const navigate = useNavigate();
  const [pets, setPets] = useState([]);
  const [status, setStatus] = useState({ type: 'loading', message: 'Cargando mascotas...' });

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

  const handleDeletePet = async (pet) => {
    const result = await swal.fire({
      icon: 'warning',
      title: `Eliminar a ${pet.name}`,
      text: 'Esta acción no se puede deshacer.',
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

  return (
    <div className="pets-page">
      <main className="pets-shell">
        <header className="pets-header">
          <div className="pets-title">
            <img src="/images/logo1.png" alt="" />
            <div>
              <h1>Lista de Mascotas</h1>
            </div>
          </div>

          <button className="logout-button" type="button" onClick={onLogout} aria-label="Cerrar sesión">
            <LogoutIcon />
          </button>
        </header>

        <button className="add-pet-button" type="button" onClick={() => navigate('/challenge/pets/new')}>
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
                onView={(id) => navigate(`/challenge/pets/${id}`)}
                onEdit={(selectedPet) => navigate(`/challenge/pets/${selectedPet.id}/edit`)}
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

export default PetsListPage;
