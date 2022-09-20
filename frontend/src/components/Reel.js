import React from "react";
import { Link } from "react-router-dom";

export default function Reel(props) {

  return (
    <div className="m-1 p-2 rounded bg-light bg-gradient">
      <Link to={`/reels/${props.id}`} className="text-decoration-none">
        <div className="mb-1 w-100">
          <h4 className="mb-1">{props.name}</h4>
          <small>Duration: {props.duration}</small><br />
          <code>{props.standard} {props.definition}</code>
        </div>
      </Link>
    </div>
  )
}