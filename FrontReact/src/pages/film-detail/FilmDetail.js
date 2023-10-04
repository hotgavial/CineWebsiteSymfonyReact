import React, { useState, useEffect } from 'react';
import FilmDetailHeader from './FilmDetailHeader';
import { useParams } from 'react-router-dom';
import './assets/FilmDetail.scss';

function FilmDetail() {

    const [film, setFilm] = useState(null)

    let { id } = useParams();

    useEffect(() => {
        fetch(`http://localhost:8000/movie-info/${id}`, {
            method: "GET",
        })
            .then((response) => response.json())
            .then((data) => {
                const actors = data.cast.filter(actor => actor.job === 'actor');
                const directors = data.cast.filter(director => director.job === 'director');
                console.log(data);

                setFilm({
                    idMovie: id,
                    title: data.title,
                    originalTitle: data.originalTitle,
                    trailer: data.trailer,
                    year: data.year,
                    averageRating: data.averageRating,
                    cast: {
                        actors,
                        directors
                    }
                });
            })
            .catch((error) => console.error("ICI" + error));
    }, [id])

    return (
        <div className="film-detail">
            {film !== null && <FilmDetailHeader movie={film} />}
        </div>
    );
}



export default FilmDetail;
