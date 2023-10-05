import React from 'react';

import './assets/PosterImg.scss'

function PosterImg(props) {

    let posterLink;

    try {
        posterLink = require(`../assets/img/${props.movie.idMovie}-poster.jpg`);
    } catch (error) {
        // Si une erreur se produit (l'image n'existe pas), utilisez une image générique
        posterLink = require('../assets/img/generic-poster.jpg');
    }

    return (
        <div className='poster-img'>
            <img className={props.insert ? 'poster-img__img--insert' : 'poster-img__img'} src={posterLink} alt='poster'></img>
        </div>
    );
}

export default PosterImg;