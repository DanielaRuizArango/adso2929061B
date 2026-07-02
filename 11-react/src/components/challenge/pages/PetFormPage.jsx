import { useEffect, useState } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import axios from 'axios';
import { PET_EDIT_URL, PET_SHOW_URL, PET_STORE_URL } from '../constants';
import { swal, showError } from '../alerts';
import { getApiErrorMessage, getAuthHeaders } from '../helpers';
import PetForm from '../components/PetForm';

function PetFormPage() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [pet, setPet] = useState(null);
  const [status, setStatus] = useState(id ? { type: 'loading', message: 'Cargando mascota...' } : { type: '', message: '' });
  const isEditing = Boolean(id);

  useEffect(() => {
    if (!id) {
      return;
    }

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

  const handleSavePet = async (payload) => {
    const formData = new FormData();

    Object.entries(payload).forEach(([key, value]) => {
      if (value !== null && value !== undefined && value !== '') {
        formData.append(key, value);
      }
    });

    try {
      if (isEditing) {
        formData.append('_method', 'PUT');
        await axios.post(`${PET_EDIT_URL}/${id}`, formData, {
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

      navigate('/challenge/pets');
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

  return (
    <div className="pets-page">
      {status.message && (
        <main className="pets-shell">
          <p className={`pets-message ${status.type}`}>{status.message}</p>
        </main>
      )}

      {!status.message && (!isEditing || pet) && (
        <PetForm
          pet={pet}
          onBack={() => navigate('/challenge/pets')}
          onSubmit={handleSavePet}
        />
      )}
    </div>
  );
}

export default PetFormPage;
