import { PET_IMAGE } from '../constants';
import { getPetImage, getPetKindLabel, getPetStatus } from '../helpers';
import { PawIcon, PencilIcon, TrashIcon } from '../icons';

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

export default PetCard;
