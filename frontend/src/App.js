import { Route, Routes } from 'react-router-dom';
import './App.css';
import AddReel from './components/AddReel';
import AddVideo from './components/AddVideo';
import Header from './components/Header';
import ReelDetail from './components/ReelDetail';
import { Reels } from './components/Reels';

function App() {
  return (
    <div className="container">
      <Header />
      <div style={{ maxWidth: 1750 }}>
        <Routes>
          <Route path="/" element={<Reels />} />
          <Route path="/reels/new" element={<AddReel />} />
          <Route path="/reels/:id" element={<ReelDetail />} />
          <Route path="/reels/:id/videos" element={<AddVideo />} />
        </Routes>
      </div>
    </div>
  );
}

export default App;
