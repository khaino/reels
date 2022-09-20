import axios from "axios"
import React from "react"
import { useNavigate, useParams } from "react-router-dom"

export default function AddVideo() {

  const { id: reelId } = useParams()
  const navigate = useNavigate();
  const [videoData, setVideoData] = React.useState(
    {
      "name": "",
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
    setVideoData(prevFormData => {
      return {
        ...prevFormData,
        [name]: value
      }
    })
  }

  function handleSubmit(event) {
    event.preventDefault();
    axios.post(`http://localhost:8000/api/reels/${reelId}/videos`, videoData)
      .then(function (response) {
        if (response.data.code === 0) {
          navigate(`/reels/${reelId}`)
        } else {
          showErrorMessage(response.data.message)
        }
      })
      .catch(function (error) {
        showErrorMessage(error.message)
      })
  }

  function showErrorMessage(message) {
    setVideoData(prevFormData => {
      return {
        ...prevFormData,
        "error": message
      }
    })
  }

  return (
    <form onSubmit={handleSubmit} className="m-1 p-2 rounded bg-light bg-gradient">
      {videoData.error && <div className="alert alert-danger" role="alert">{videoData.error}</div>}
      <div className="mb-3">
        <label htmlFor="name" className="form-label">Video name</label>
        <input
          type="text"
          placeholder="Video name"
          onChange={handleChange}
          name="name"
          value={videoData.name}
          className="form-control"
          required
        />
      </div>

      <div className="mb-3">
        <label htmlFor="description" className="form-label">Video description</label>
        <input
          type="text"
          placeholder="Video clip description"
          onChange={handleChange}
          name="description"
          value={videoData.description}
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
          value={videoData.start}
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
          value={videoData.end}
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
          value={videoData.standard}
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
          value={videoData.definition}
          onChange={handleChange}>
          <option value="HD">HD</option>
          <option value="SD">SD</option>
        </select>
      </div>
      <input type="submit" className="btn btn-primary mb-3" value="Create" />
    </form>
  )
}
