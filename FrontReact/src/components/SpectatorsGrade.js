import React from 'react';
import './assets/SpectatorsGrade.scss';

function SpectatorsGrade(props) {
    return (
        <div className='spectators-grade'>
            <div className={props.insert ? 'spectators-grade__grade--insert' : 'spectators-grade__grade'}>{props.averageRating !== null ? props.averageRating : '-'}</div>
        </div>
    );
}

export default SpectatorsGrade;