import axios from "axios";
import React from "react";

export default function Video(props) {

  function handleDelete(event) {
    event.preventDefault();
    axios.delete(`http://localhost:8000/api/reels/${props.reel_id}/videos/${props.id}`)
      .then(() => {
        window.location.reload();
      }).catch(error => {
        console.log(error)
      })
  }

  return (
    <div className="m-1 p-2 rounded border border-secondary">
      <div className="mb-1 w-100">
        <h4 className="mb-1">{props.name}</h4>
        <small>Start: {props.start} | End: {props.end} | Duration: {props.duration}</small>
      </div>
      <form onSubmit={handleDelete}>
        <input className="btn btn-outline-danger" type="submit" value="Delete" />
      </form>
    </div>
  )
}