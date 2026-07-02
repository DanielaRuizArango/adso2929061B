import { useEffect, useState } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import axios from 'axios';
import { PET_SHOW_URL } from '../constants';
import { showError } from '../alerts';
import { getAuthHeaders } from '../helpers';
import PetDetail from '../components/PetDetail';

function PetDetailPage() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [pet, setPet] = useState(null);
  const [status, setStatus] = useState({ type: 'loading', message: 'Cargando mascota...' });

  useEffect(() => {
    const loadPet = async () => {
      try {
        const { data } = await axios.get(`${PET_SHOW_URL}/${id}`, {
          headers: getAuthHeaders(),
        });
        setPet(data.data);
        setStatus({ type: 'success', message: '' });
      } catch (error) {
        const message = error.response?.data?.message || 'No se pudo consultar la mascota.';
        setStatus({ type: 'error', message });
        showError('No se pudo consultar', message);
      }
    };

    loadPet();
  }, [id]);

  return (
    <div className="pets-page">
      {status.message && (
        <main className="pets-shell">
          <p className={`pets-message ${status.type}`}>{status.message}</p>
        </main>
      )}

      {!status.message && pet && (
        <PetDetail
          pet={pet}
          onBack={() => navigate('/challenge/pets')}
          onEdit={() => navigate(`/challenge/pets/${pet.id}/edit`)}
        />
      )}
    </div>
  );
}

export default PetDetailPage;
