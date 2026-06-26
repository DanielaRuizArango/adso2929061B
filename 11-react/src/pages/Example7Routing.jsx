import { Routes, Route, Link, useNavigate } from 'react-router-dom';

function BtnBack() {
    const navigate = useNavigate();

    return (
        <button onClick={() => navigate(-1)}>
            ← Volver
        </button>
    );
}

function Home() {
    return (
        <>
            <h3>Home</h3>
            <Link to="/about">Ir a About</Link>
        </>
    );
}

function About() {
    return (
        <>
            <h3>About</h3>
            <Link to="/">Volver al Home</Link>
        </>
    );
}

function Example7Routing() {
    return (
        <div className="container">
            <h2>Example7Routing</h2>

            <BtnBack />

            <nav>
                <Link to="/">Home</Link> |{" "}
                <Link to="/about">About</Link>
            </nav>

            <Routes>
                <Route path="/" element={<Home />} />
                <Route path="/about" element={<About />} />
            </Routes>
        </div>
    );
}

export default Example7Routing;