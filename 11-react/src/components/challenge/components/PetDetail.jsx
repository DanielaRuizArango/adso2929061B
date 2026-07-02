import { PET_IMAGE } from '../constants';
import { getFlagValue, getPetImage, getPetKindLabel, getPetStatus } from '../helpers';
import { BackIcon, PawIcon, PencilIcon } from '../icons';

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
          <h2><PawIcon /> Status</h2>
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

export default PetDetail;
