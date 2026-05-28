import BtnBack from '../components/BtnBack';

const url ='';

function Example2JSX() {
    return(
        <div className="container">
            <BtnBack />
        <h2>Example2: JSX</h2>
        <p></p>
        <img src={url} alt="" />
        </div>
    );
}

export default Example2JSX;