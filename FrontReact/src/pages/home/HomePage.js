import React, { useState, useEffect } from 'react';
import FilmInsert from '../../components/FilmInsert';
import './assets/HomePage.scss'

function HomePage() {

    const [movies, setMovies] = useState([])

    useEffect(() => {
        fetch(`http://localhost:8000/home-page-movies`, {
            method: "GET",
        })
            .then((response) => response.json())
            .then((data) => {
                setMovies(data);
            })
            .catch((error) => console.error("ICI" + error));
    }, [])

    return (
        <div className="home">
            <h2>Notez des films</h2>
            <div className="home__film-list">
                {movies.map((movie) => (
                    <FilmInsert key={movie.id} movie={movie} />
                ))}
            </div>
        </div>
    );
}

export default HomePage;