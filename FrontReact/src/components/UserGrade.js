import React, { useState, useEffect } from 'react';
import './assets/UserGrade.scss'

function UserGrade(props) {

    const [isHovered, setIsHovered] = useState(false);
    const [hoveredIndex, setHoveredIndex] = useState(0);
    const [userGrade, setUserGrade] = useState(0);
    const [idReview, setIdReview] = useState(null);

    useEffect(() => {
        fetch(`http://localhost:8000/user-grade/${props.idMovie}/5`, {
            method: "GET",
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`Réponse HTTP avec code ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                setUserGrade(data.grade);
                setIdReview(data.id);
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
        const token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2OTc0Njg1NzksImV4cCI6MTY5NzQ3MjE3OSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInBzZXVkbyI6IkNsXHUwMGU5bWVudCJ9.loE4xggsjCUqvH3_XTDFSJ3YmXZ5IPxfQJKoUA3suROD5beLlTjI5eWqsweAADV-Xf-4lqwpCLU1YG-AX6l472EQaU0s91Avp2gt-hE7M3IxGirgCnJTl30jGxQEmxVB4p6Dsm3Nlr_EPN9jKNFU16Q7GefdGBahaHUFd_q1B_p80AE1pYBwBSQo45kINE4o9Ctz59hxOOZLvMzHsPXP5SgcMUByWMUW7ftFKFkpZ7nxVUzq_ovsyHimWqRR6a0VYjVh3kUm_GigWf9GLDRkgdbnH3jIMD8ZSMxqaruf9E6cSQ3-KbjsswaLZFiLIW9fVg3EoK4nNDcJ1I_bevZYeEzIxW1JzKFdq3e5NDvRzQEGSQxPI4OQqPplQrjFpgb-m0QHQrx8J1IB9wTFPisc7RJh_xo-khIiaANcr_6r7wxdzZRaAaEP3X6BiW4TPlWaVErMM1DwdPJaZ7AJrm5SuNPI6qzR4R13M7Hrt90Voe0k4LyRX8lAwnnEQ-wfreydUItziPrzwLpYTO542fxsaMZkt5rc2Ie4RsitL4s8VPrjyGP7GsJAwDi5BtCo4qTkfd87B0lqQHt8l-BH05YQItgrk-bgSsZH1IcY6naP4Zc-fJDMR-_N30LNqIgFr3zs-zSTUbSvEPNLVwXpW1JJKx61nBS3Cfo3SlobXAdS9Vc"
        //localStorage.setItem("token", token);
        //const token = localStorage.getItem('token')
        if (token) {
            if (userGrade !== 0) {
                fetch(`http://localhost:8000/api/update-grade`, {
                    method: "PUT",
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    body: JSON.stringify({ grade: index, idReview: idReview }),
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error(`Réponse HTTP avec code ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(() => {
                        setUserGrade(index);
                    })
                    .catch((error) => console.error(error));
            } else {
                fetch(`http://localhost:8000/api/add-grade`, {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    body: JSON.stringify({ grade: index, idMovie: props.idMovie }),
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error(`Réponse HTTP avec code ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(() => {
                        setUserGrade(index);
                    })
                    .catch((error) => console.error(error));
            }
        }

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