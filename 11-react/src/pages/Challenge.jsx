import { useState } from 'react';
import { Navigate, Route, Routes, useNavigate } from 'react-router-dom';
import axios from 'axios';
import './Challenge.css';
import { LOGIN_URL, LOGOUT_URL } from '../components/challenge/constants';
import { swal, showError } from '../components/challenge/alerts';
import { getAuthHeaders } from '../components/challenge/helpers';
import LoginView from '../components/challenge/components/LoginView';
import PetsListPage from '../components/challenge/pages/PetsListPage';
import PetDetailPage from '../components/challenge/pages/PetDetailPage';
import PetFormPage from '../components/challenge/pages/PetFormPage';

function ProtectedRoute({ isLoggedIn, children }) {
  if (!isLoggedIn) {
    return <Navigate to="/challenge" replace />;
  }

  return children;
}

function Challenge() {
  const navigate = useNavigate();
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
      navigate('/challenge/pets');
      swal.fire({
        icon: 'success',
        title: 'Bienvenida',
        text: 'Inicio de sesión exitoso.',
        timer: 1400,
        showConfirmButton: false,
      });
    } catch (error) {
      const message = error.response?.data?.message || 'No se pudo iniciar sesión. Revisa tus datos.';
      setStatus({ type: 'error', message });
      showError('No se pudo iniciar sesión', message);
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
    navigate('/challenge');
  };

  return (
    <Routes>
      <Route
        index
        element={
          isLoggedIn ? (
            <Navigate to="pets" replace />
          ) : (
            <LoginView
              form={form}
              loading={loading}
              status={status}
              onChange={handleChange}
              onSubmit={handleSubmit}
            />
          )
        }
      />
      <Route
        path="pets"
        element={
          <ProtectedRoute isLoggedIn={isLoggedIn}>
            <PetsListPage onLogout={handleLogout} />
          </ProtectedRoute>
        }
      />
      <Route
        path="pets/new"
        element={
          <ProtectedRoute isLoggedIn={isLoggedIn}>
            <PetFormPage />
          </ProtectedRoute>
        }
      />
      <Route
        path="pets/:id"
        element={
          <ProtectedRoute isLoggedIn={isLoggedIn}>
            <PetDetailPage />
          </ProtectedRoute>
        }
      />
      <Route
        path="pets/:id/edit"
        element={
          <ProtectedRoute isLoggedIn={isLoggedIn}>
            <PetFormPage />
          </ProtectedRoute>
        }
      />
      <Route path="*" element={<Navigate to={isLoggedIn ? 'pets' : '/challenge'} replace />} />
    </Routes>
  );
}

export default Challenge;
