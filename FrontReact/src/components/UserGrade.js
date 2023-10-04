import React, { useState, useEffect } from 'react';
import './assets/UserGrade.scss'

function UserGrade(props) {

    const [isHovered, setIsHovered] = useState(false);
    const [hoveredIndex, setHoveredIndex] = useState(0);
    const [userGrade, setUserGrade] = useState(0);

    useEffect(() => {
        fetch(`http://localhost:8000/user-grade/${props.idMovie}/3`, {
            method: "GET",
        })
            .then((response) => response.json())
            .then((data) => {
                setUserGrade(data.grade);
            })
            .catch((error) => console.error("ICI" + error));
    }, [props.idMovie])

    function determinateClassForStar(index) {
        if (isHovered) {
            return index <= hoveredIndex ? 'fa fa-star hovered' : 'fa fa-star'
        }
        return index <= userGrade ? 'fa fa-star checked' : 'fa fa-star'
    }

    function onMouseOver(index) {
        setIsHovered(true)
        setHoveredIndex(index)
    }

    function onMouseLeave() {
        setIsHovered(false)
    }

    function changeUserGrade(index) {

    }

    return (
        <div className="user-grade">
            {Array.from({ length: 10 }, (_, index) => (
                <span
                    key={index}
                    className={determinateClassForStar(index + 1)}
                    onMouseOver={() => onMouseOver(index + 1)}
                    onMouseLeave={onMouseLeave}
                    onClick={() => changeUserGrade(index + 1)}
                />
            ))}
        </div>
    );

}

export default UserGrade;