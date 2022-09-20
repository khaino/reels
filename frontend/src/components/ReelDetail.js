import axios from "axios";
import React, { useEffect } from "react";
import { Link, useParams } from "react-router-dom";
import Video from "./Video";

export default function ReelDetail() {
  const { id } = useParams();
  const [reelDetail, setReelDetail] = React.useState({ "clip_videos": [] })

  const videoComps = reelDetail.clip_videos.map(function (video) {
    return <Video key={video.id} {...video} />
  })
  useEffect(function () {
    axios.get(`http://localhost:8000/api/reels/${id}`)
      .then(res => {
        setReelDetail(res.data.data)
      }).catch(error => {
        console.log(error)
      });
  }, [id])
  return (
    <div className="m-1 p-2 rounded bg-light bg-gradient">
      <div className="mb-1 w-100">
        <h4 className="mb-1">{reelDetail.name}</h4>
        <small>Duration: {reelDetail.duration}</small><br />
        <code>{reelDetail.standard} {reelDetail.definition}</code>
      </div>
      <Link to={`/reels/${id}/videos`} className="text-decoration-none btn btn-outline-success">Add Video</Link>
      {videoComps}
    </div>
  )
}