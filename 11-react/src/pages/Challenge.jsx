import './Challenge.css';

function Challenge() {
  return (
    <div className="challenge-page">
      <div className="challenge-card">
        <div className="hero-illustration">
          <div className="hero-characters">
            <span className="hero-pet">🐶</span>
            <span className="hero-pet">🐱</span>
            <span className="hero-pet">🐷</span>
            <span className="hero-pet">🐦</span>
          </div>
          <h2>Bienvenido</h2>
          <p>Inicia sesión para cuidar de tu mascota desde cualquier lugar.</p>
        </div>

        <form className="challenge-form">
          <label>
            Correo
            <div className="input-group">
              <span className="input-icon">✉️</span>
              <input type="email" placeholder="correo@ejemplo.com" />
            </div>
          </label>

          <label>
            Contraseña
            <div className="input-group">
              <span className="input-icon">🔒</span>
              <input type="password" placeholder="Ingresa tu contraseña" />
            </div>
          </label>

          <button className="challenge-button" type="submit">
            Ingresar
          </button>

          <p className="challenge-note">
            ¿Olvidaste tu contraseña? <a href="#" className="challenge-link">Recupérala aquí</a>
          </p>
        </form>
      </div>
    </div>
  );
}

export default Challenge;
