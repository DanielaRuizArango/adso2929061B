import { useEffect, useState } from 'react';
import { FORM_FOOTER_IMAGE, PET_IMAGE, PET_KIND_OPTIONS } from '../constants';
import { getFlagValue, getPetImage, getPetKindValue } from '../helpers';
import {
  BackIcon,
  BadgeIcon,
  CalendarIcon,
  CameraIcon,
  DescriptionIcon,
  HeartIcon,
  LocationIcon,
  PawIcon,
  ScaleIcon,
  SpeciesIcon,
  StatusIcon,
  TagIcon,
} from '../icons';

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
  const [imagePreview, setImagePreview] = useState(() => getPetImage(pet?.image));
  const isEditing = Boolean(pet);

  useEffect(() => {
    setForm({
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
  }, [pet]);

  useEffect(() => {
    if (!form.image) {
      setImagePreview(getPetImage(pet?.image));
      return undefined;
    }

    const previewUrl = URL.createObjectURL(form.image);
    setImagePreview(previewUrl);

    return () => {
      URL.revokeObjectURL(previewUrl);
    };
  }, [form.image, pet?.image]);

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
        <img className="form-title-logo" src="/images/logo1.png" alt="" />
        <div>
          <h1>{isEditing ? 'Editar mascota' : 'Agregar mascota'}</h1>
          <p>{isEditing ? 'Actualiza la información de la mascota.' : 'Completa la información para registrar una nueva mascota.'}</p>
        </div>
      </header>

      <form className="pet-form" onSubmit={handleSubmit}>
        <label>
          <span><CameraIcon /> Foto</span>
          <input name="image" type="file" accept="image/png,image/jpeg,image/webp" onChange={handleChange} />
        </label>

        <div className="pet-image-preview">
          <img
            src={imagePreview}
            alt="Vista previa de la mascota"
            onError={(event) => {
              event.currentTarget.src = PET_IMAGE;
            }}
          />
        </div>

        <label>
          <span><BadgeIcon /> Nombre *</span>
          <input name="name" value={form.name} onChange={handleChange} placeholder="Ej. Milo" required />
        </label>

        <label>
          <span><SpeciesIcon /> Especie *</span>
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
          <span><TagIcon /> Raza</span>
          <input name="breed" value={form.breed} onChange={handleChange} placeholder="Ej. Mestizo" />
        </label>

        <label>
          <span><CalendarIcon /> Edad *</span>
          <input name="age" type="number" min="0" step="1" value={form.age} onChange={handleChange} placeholder="Ej. 2" required />
        </label>

        <label>
          <span><ScaleIcon /> Peso *</span>
          <input name="weight" type="number" min="0" step="0.1" value={form.weight} onChange={handleChange} placeholder="Ej. 12" required />
        </label>

        <label>
          <span><LocationIcon /> Ubicación *</span>
          <input name="location" value={form.location} onChange={handleChange} placeholder="Ej. Bogotá" required />
        </label>

        <label>
          <span><DescriptionIcon /> Descripción *</span>
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
          <span><StatusIcon /> Status *</span>
          <select name="active" value={form.active} onChange={handleChange} required>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
        </label>

        <label>
          <span><HeartIcon /> Adopción *</span>
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

export default PetForm;
