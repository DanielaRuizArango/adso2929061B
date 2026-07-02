export const API_BASE_URL = 'http://127.0.0.1:8000/api';
export const LOGIN_URL = `${API_BASE_URL}/login`;
export const LOGOUT_URL = `${API_BASE_URL}/logout`;
export const PETS_URL = `${API_BASE_URL}/pets/list`;
export const PET_SHOW_URL = `${API_BASE_URL}/pets/show`;
export const PET_STORE_URL = `${API_BASE_URL}/pets/store`;
export const PET_EDIT_URL = `${API_BASE_URL}/pets/edit`;
export const PET_DELETE_URL = `${API_BASE_URL}/pets/delete`;

export const PET_IMAGE = '/images/image2.png';
export const FORM_FOOTER_IMAGE = '/images/image3.png';

export const PET_KIND_OPTIONS = [
  { value: 'Dog', label: 'Perro' },
  { value: 'Cat', label: 'Gato' },
  { value: 'Bird', label: 'Ave' },
  { value: 'Pig', label: 'Cerdo' },
  { value: 'Other', label: 'Otro' },
];

export const PET_KIND_ALIASES = {
  Perro: 'Dog',
  Gato: 'Cat',
  Ave: 'Bird',
  Cerdo: 'Pig',
  Otro: 'Other',
};
