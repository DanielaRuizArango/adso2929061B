import { PET_IMAGE, PET_KIND_ALIASES, PET_KIND_OPTIONS } from './constants';

export function getAuthHeaders() {
  return {
    Authorization: `Bearer ${localStorage.getItem('larapets_token')}`,
  };
}

export function getPetImage(image) {
  if (!image) {
    return PET_IMAGE;
  }

  if (image.startsWith('http') || image.startsWith('/')) {
    return image;
  }

  return `http://127.0.0.1:8000/storage/${image}`;
}

export function getFlagValue(value, defaultValue) {
  if (value === undefined || value === null || value === '') {
    return String(defaultValue);
  }

  return value === true || value === 1 || value === '1' ? '1' : '0';
}

export function getPetStatus(pet) {
  if (getFlagValue(pet.adopted, 0) === '1') {
    return 'Adoptada';
  }

  if (getFlagValue(pet.active, 1) === '0') {
    return 'No disponible';
  }

  return 'Disponible';
}

export function getPetKindValue(kind) {
  return PET_KIND_ALIASES[kind] || kind || '';
}

export function getPetKindLabel(kind) {
  const normalizedKind = getPetKindValue(kind);
  return PET_KIND_OPTIONS.find((option) => option.value === normalizedKind)?.label || kind || '';
}

export function getApiErrorMessage(error, fallbackMessage) {
  const errors = error.response?.data?.errors;
  if (errors) {
    return Object.values(errors).flat().join('<br>');
  }

  return error.response?.data?.message || fallbackMessage;
}
