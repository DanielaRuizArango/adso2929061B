import BtnBack from '../components/BtnBack';

function Bulbasaur () {
    return (
        <div style ={{ border: '4px solid lightblue', padding: '1.4rem', borderRadius: '0.4rem', background:'green', width:'360px'}}>
            <h2>Bulbasur</h2>
            <p>Type: Grass</p>
            <p>Ability: Razor Leaf</p>
        </div>
    )
}

function Charmander () {
    return (
        <div style ={{ border: '4px solid lightblue', padding: '1.4rem', borderRadius: '0.4rem', background:'orange', width:'360px'}}>
            <h2>Charmander</h2>
            <p>Type: Fire</p>
            <p>Ability: Blaze</p>
        </div>
    )
}


function Squirtle () {
    return (
        <div style ={{ border: '4px solid lightblue', padding: '1.4rem', borderRadius: '0.4rem', background:'blue', width:'360px'}}>
            <h2>Squirtle</h2>
            <p>Type: Water</p>
            <p>Ability: Torrent</p>
        </div>
    )
}

function Example1Components() {
    return(
        <div className="container">
            <BtnBack />
        <h2>Example1: Components</h2>
        <p>Create indepent a reusable UI pieces.</p>
        <div style={{display: 'flex', flexwrap: 'wrap', gap: '1rem', marginTop: '2rem', justifyContent: 'center', alignItems: 'center', marginBottom: '2rem'}}>
                <Bulbasaur />
                <Charmander />
                <Squirtle />
        </div>
        </div>
    );
}

export default Example1Components;