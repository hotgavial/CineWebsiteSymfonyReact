import React, { useState } from 'react';

function HomePage() {

    const [films, setFilm] = useState([
        { title: 'Les 3 frères' },
        { title: 'Les rois mages' },
        { title: 'Le pari' }
    ])

    return (
        <div className="home">
            {films.map(({ title }) => (
                <p>{title}</p>
            ))}
        </div>
    );
}

export default HomePage;