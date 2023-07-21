import React from "react";

const PgButton = ({
  pg,
  isFetching,
  isLoading,
  setPageNumber,
  currentPage,
}) => {
  return (
    <button
      onClick={() => setPageNumber(pg)}
      disabled={isFetching || isLoading ? true : false}
    >
      <li className="page-item">
        <span
          className={`page-link ${pg === currentPage ? "active-page" : ""}`}
        >
          0{pg}
        </span>
      </li>
    </button>
  );
};

export default PgButton;
