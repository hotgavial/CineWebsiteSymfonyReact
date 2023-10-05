import React from 'react';
import TechnicalInfo from '../../components/TechnicalInfo';
import SpectatorsGrade from '../../components/SpectatorsGrade';
import UserGrade from '../../components/UserGrade';
import PosterImg from '../../components/PosterImg';
import './assets/FilmDetailHeader.scss';

function FilmDetailHeader(props) {

    return (
        <div className="film-detail-header">
            <h1 className="film-detail-header__title">{props.movie.title}</h1>
            <div className="film-detail-header__main">
                <div className="film-detail-header__general-grade">
                    <SpectatorsGrade averageRating={props.movie.averageRating} />
                    <UserGrade idMovie={props.movie.idMovie} />
                </div>
                <PosterImg idMovie={props.movie.idMovie} />
                <div>
                    <TechnicalInfo movie={props.movie} />
                </div>
            </div>
        </div>
    );
}

export default FilmDetailHeader;
