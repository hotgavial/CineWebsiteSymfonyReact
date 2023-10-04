import React from 'react';


function TechnicalInfo(props) {

    console.log(props.movie.cast.directors)

    const directors = props.movie?.cast?.directors?.length > 0 ? props.movie.cast.directors.map(director => `${director.actor.firstName} ${director.actor.lastName}`).join(', ') : 'Aucun';
    const actors = props.movie?.cast?.actors?.length > 0 ? props.movie.cast.actors.map(actor => `${actor.actor.firstName} ${actor.actor.lastName}`).join(', ') : 'Aucun';

    return (
        <div v-if="movie" className="technical-info">
            <p>Année: {props.movie.year}</p>
            <p>Réalisé par : {directors}</p>
            <p>Acteurs : {actors}</p>
        </div>
    );
}

export default TechnicalInfo;
