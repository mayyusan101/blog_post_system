import React from "react";
import { Link } from "react-router-dom";

const NoPermission = () => {
  return (
    <div className="row bg-danger text-center col-8 offset-2 p-3 my-5 rounded-2">
      <h2 className="text-white">You don't have permission to access</h2>
      <Link
        to={"/login"}
        className="text-end text-primary text-decoration-underline"
      >
        Please login
      </Link>
    </div>
  );
};

export default NoPermission;
