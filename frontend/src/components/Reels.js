
import React, { useEffect } from "react";
import axios from "axios";
import Reel from "./Reel";

export function Reels() {
  const [reels, setReels] = React.useState([])

  useEffect(function () {
    axios.get("http://localhost:8000/api/reels")
      .then(res => {
        setReels(res.data.data)
      }).catch(error => {
        console.log(error)
      });
  }, [])

  const reelComps = reels.map(function (reel) {
    return <Reel key={reel.id} {...reel} />
  })

  return (
    <div>
      <div className="d-flex flex-row-reverse p-2">
        <a href="/reels/new" className="btn btn-outline-success">Create Reel</a>
      </div>
      <div className="list-group">
        {reelComps}
      </div>

    </div>
  )
}
