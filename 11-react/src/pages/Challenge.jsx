import './Challenge.css';

function PawIcon() {
  return (
    <svg viewBox="0 0 24 24" role="img">
      <circle cx="5.8" cy="9" r="2.3" />
      <circle cx="10" cy="5.8" r="2.3" />
      <circle cx="14" cy="5.8" r="2.3" />
      <circle cx="18.2" cy="9" r="2.3" />
      <path d="M6.8 17.2c0-3.3 2.5-6 5.2-6s5.2 2.7 5.2 6c0 2.2-1.5 3.1-3 2.2-1.4-.8-3-.8-4.4 0-1.5.9-3-.1-3-2.2Z" />
    </svg>
  );
}

function MailIcon() {
  return (
    <svg viewBox="0 0 24 24" role="img">
      <path d="M4 6h16v12H4z" />
      <path d="m4 7 8 6 8-6" />
    </svg>
  );
}

function LockIcon() {
  return (
    <svg viewBox="0 0 24 24" role="img">
      <rect x="5" y="10" width="14" height="10" rx="2" />
      <path d="M8 10V7a4 4 0 0 1 8 0v3" />
      <path d="M12 14v2" />
    </svg>
  );
}

function Challenge() {
  return (
    <div className="challenge-page">
      <div className="challenge-card">
        <div className="brand">
          <img className="brand-logo" src="/images/logo1.png" alt="" />
          <h1>Larapets</h1>
        </div>

        <img className="hero-image" src="/images/image1.png" alt="Mascotas" />

        <form className="challenge-form">
          <label className="input-group">
            <span className="input-icon" aria-hidden="true">
              <MailIcon />
            </span>
            <input type="email" placeholder="correo" />
          </label>

          <label className="input-group">
            <span className="input-icon" aria-hidden="true">
              <LockIcon />
            </span>
            <input type="password" placeholder="contraseña" />
          </label>

          <button className="challenge-button" type="submit">
            <span className="button-icon" aria-hidden="true">
              <PawIcon />
            </span>
            Iniciar sesión
          </button>
        </form>
      </div>
    </div>
  );
}

export default Challenge;
