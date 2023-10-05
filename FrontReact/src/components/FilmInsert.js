import React from 'react';
import SpectatorsGrade from './SpectatorsGrade';
import PosterImg from './PosterImg';
import './assets/FilmInsert.scss'
import { Link } from 'react-router-dom';

function FilmInsert(props) {

    return (
        <div className='film-insert'>
            <div className='film-insert__poster'>
                <PosterImg idMovie={props.movie.idMovie} insert={true} />
            </div>
            <Link to={`/film-detail/${props.movie.id}`}><div className='film-insert__title'>{props.movie.title} ({props.movie.year})</div></Link>
            <div className='film-insert__spectators-grade'>
                <SpectatorsGrade averageRating={props.movie.averageRating} insert={true} />
            </div>
        </div>
    );
}

export default FilmInsert;