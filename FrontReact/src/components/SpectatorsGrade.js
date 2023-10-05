import React from 'react';
import './assets/SpectatorsGrade.scss';

function SpectatorsGrade(props) {

    function colorGrade() {
        if (props.averageRating) {
            if (props.averageRating >= 7) {
                return 'greenyellow';
            } if (props.averageRating >= 6) {
                return 'yellow';
            } if (props.averageRating >= 5.0) {
                return 'orange';
            }
            return 'red';
        }
        return 'grey';
    }

    function gradeBorder() {
        if (props.averageRating) {
            if (props.averageRating >= 7) {
                return 'green 0.4rem solid';
            } if (props.averageRating >= 6) {
                return 'ykhaki 0.4rem solid';
            } if (props.averageRating >= 5.0) {
                return 'coral 0.4rem solid';
            }
            return 'firebrick 0.4rem solid';
        }
        return 'grey 0.4rem solid';
    }

    return (
        <div className='spectators-grade'>
            <div className={props.insert ? 'spectators-grade__grade--insert' : 'spectators-grade__grade'} style={{ color: colorGrade(), border: gradeBorder() }}>{props.averageRating !== null ? props.averageRating : '-'}</div>
        </div>
    );
}

export default SpectatorsGrade;