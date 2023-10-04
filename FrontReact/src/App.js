import React from 'react';
import { Route, Routes } from 'react-router-dom';
import './assets/styles/App.css';
import FilmDetail from './pages/film-detail/FilmDetail';
import HomePage from './pages/home/HomePage';

function App() {
  return (
    <div>
      <Routes>
        <Route path="/film-detail/:id" element={<FilmDetail />} />
        <Route path="/" element={<HomePage />} />
      </Routes>
    </div>

  );
}

export default App;