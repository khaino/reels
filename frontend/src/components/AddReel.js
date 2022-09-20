import axios from "axios"
import React from "react"
import { useNavigate } from "react-router-dom"

export default function AddReel() {
  const navigate = useNavigate();
  const [reelData, setReelData] = React.useState(
    {
      "name": "",
      "video_name": "",
      "standard": "NTSC",
      "definition": "HD",
      "description": "",
      "start": "",
      "end": "",
      "error": ""
    }
  )

  function handleChange(event) {
    const { name, value } = event.target
    setReelData(prevFormData => {
      return {
        ...prevFormData,
        [name]: value
      }
    })
  }

  function handleSubmit(event) {
    event.preventDefault();
    axios.post('http://localhost:8000/api/reels', formatData(reelData))
      .then(function (response) {
        if (response.data.code === 0) {
          navigate("/")
        } else {
          showErrorMessage(response.data.message)
        }
      })
      .catch(function (error) {
        console.log(error.message);
        showErrorMessage(error.message)
      })
  }

  function showErrorMessage(message) {
    setReelData(prevFormData => {
      return {
        ...prevFormData,
        "error": message
      }
    })
  }

  function formatData(reelData) {
    return {
      "name": reelData.name,
      "video": {
        "name": reelData.video_name,
        "description": reelData.description,
        "standard": reelData.standard,
        "definition": reelData.definition,
        "start": reelData.start,
        "end": reelData.end
      }
    }
  }

  return (
    <form onSubmit={handleSubmit} className="m-1 p-2 rounded bg-light bg-gradient">
      {reelData.error && <div className="alert alert-danger" role="alert">{reelData.error}</div>}
      <div className="mb-3">
        <label htmlFor="name" className="form-label">Reel name</label>
        <input
          type="text"
          placeholder="Reel name"
          onChange={handleChange}
          name="name"
          value={reelData.name}
          className="form-control"
          required
        />
      </div>

      <div className="mb-3">
        <label htmlFor="video_name" className="form-label">Video clip name</label>
        <input
          type="text"
          placeholder="Video clip name"
          onChange={handleChange}
          name="video_name"
          value={reelData.video_name}
          className="form-control"
          required
        />
      </div>

      <div className="mb-3">
        <label htmlFor="description" className="form-label">Video description</label>
        <input
          type="text"
          placeholder="Video description"
          onChange={handleChange}
          name="description"
          value={reelData.description}
          className="form-control"
          required
        />
      </div>

      <div className="mb-3">
        <label htmlFor="start" className="form-label">Video start</label>
        <input
          type="text"
          placeholder="HH:MM:ss:ff"
          onChange={handleChange}
          name="start"
          value={reelData.start}
          className="form-control"
          required
        />
      </div>

      <div className="mb-3">
        <label htmlFor="end" className="form-label">Video end</label>
        <input
          type="text"
          placeholder="HH:MM:ss:ff"
          onChange={handleChange}
          name="end"
          value={reelData.end}
          className="form-control"
          required
        />
      </div>

      <div className="mb-3">
        <label htmlFor="standard" className="form-label">Video standard</label>
        <select
          className="form-select form-select-md mb-3"
          aria-label=".form-select-lg example"
          id="standard"
          name="standard"
          value={reelData.standard}
          onChange={handleChange}>
          <option value="NTSC">NTSC</option>
          <option value="PAL">PAL</option>
        </select>
      </div>

      <div className="mb-3">
        <label htmlFor="definition" className="form-label">Video definition</label>
        <select
          className="form-select form-select-md mb-3"
          aria-label=".form-select-lg example"
          id="definition"
          name="definition"
          value={reelData.definition}
          onChange={handleChange}>
          <option value="HD">HD</option>
          <option value="SD">SD</option>
        </select>
      </div>
      <input type="submit" className="btn btn-primary mb-3" value="Create" />
    </form>
  )
}
