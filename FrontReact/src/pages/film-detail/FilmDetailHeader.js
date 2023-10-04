import React from 'react';
import TechnicalInfo from '../../components/TechnicalInfo';
import SpectatorsGrade from '../../components/SpectatorsGrade';
import UserGrade from '../../components/UserGrade';
import './assets/FilmDetailHeader.scss';

function FilmDetailHeader(props) {

    const posterLink = require(`../../assets/img/${props.movie.idMovie}-poster.jpg`);

    return (
        <div className="film-detail-header">
            <h1 className="film-detail-header__title">{props.movie.title}</h1>
            <div className="film-detail-header__main">
                <div className="film-detail-header__general-grade">
                    <SpectatorsGrade averageRating={props.movie.averageRating} />
                    <UserGrade idMovie={props.movie.idMovie} />
                </div>
                <img alt="Poster" className="film-detail-header__poster" src={posterLink} />
                <div>
                    <TechnicalInfo movie={props.movie} />
                </div>
            </div>
        </div>
    );
}

export default FilmDetailHeader;
