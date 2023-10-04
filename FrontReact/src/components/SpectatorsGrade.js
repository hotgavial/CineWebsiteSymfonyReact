import React from 'react';
import './assets/SpectatorsGrade.scss';

function SpectatorsGrade(props) {
    return (
        <div className='spectators-grade'>
            <div>Note Moyenne des spectateurs</div>
            <div className="spectators-grade__grade">{props.averageRating}</div>
        </div>
    );
}

export default SpectatorsGrade;