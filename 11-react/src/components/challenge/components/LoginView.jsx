import { LockIcon, MailIcon, PawIcon } from '../icons';

function LoginView({ form, loading, status, onChange, onSubmit }) {
  return (
    <div className="challenge-page">
      <div className="challenge-card">
        <div className="brand">
          <img className="brand-logo" src="/images/logo1.png" alt="" />
          <h1>Larapets</h1>
        </div>

        <img className="hero-image" src="/images/image1.png" alt="Mascotas" />

        <form className="challenge-form" onSubmit={onSubmit}>
          <label className="input-group">
            <span className="input-icon" aria-hidden="true">
              <MailIcon />
            </span>
            <input
              type="email"
              name="email"
              placeholder="correo"
              value={form.email}
              onChange={onChange}
              autoComplete="email"
              required
            />
          </label>

          <label className="input-group">
            <span className="input-icon" aria-hidden="true">
              <LockIcon />
            </span>
            <input
              type="password"
              name="password"
              placeholder="contraseña"
              value={form.password}
              onChange={onChange}
              autoComplete="current-password"
              required
            />
          </label>

          <button className="challenge-button" type="submit" disabled={loading}>
            <span className="button-icon" aria-hidden="true">
              <PawIcon />
            </span>
            {loading ? 'Iniciando...' : 'Iniciar sesión'}
          </button>

          {status.message && (
            <p className={`login-message ${status.type}`}>
              {status.message}
            </p>
          )}
        </form>
      </div>
    </div>
  );
}

export default LoginView;
