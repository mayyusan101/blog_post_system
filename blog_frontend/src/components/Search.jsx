import React, { useEffect, useRef, useState } from "react";

const Search = ({ onSearchPosts, enableSearch }) => {
  const [search, setSearch] = useState("");
  const box = useRef(null);

  const handleSearch = (e) => {
    e.preventDefault();
    onSearchPosts(search); // call the search fun
  };

  useEffect(() => {
    if (enableSearch === "") {
      // clear the text if any exists when category click
      setSearch("");
    }
  }, [enableSearch]);

  // clear the  seach box by icon
  const handleClear = () => {
    console.log(box.current);
    box.current.blur();
    setSearch("");
    onSearchPosts("");
  };

  return (
    <div className="col-xl-2 col-lg-2 col-md-4 f-right pe-5">
      <form onSubmit={handleSearch} method="POST">
        <div className="header-right-btn f-right d-none d-lg-flex gap-1 align-items-center">
          <div className="position-relative">
            <input
              type="text"
              name="searchKey"
              placeholder="Search"
              className="form-control position-relative"
              value={search}
              onChange={(e) => setSearch(e.target.value)}
              ref={box}
            />
            <div
              onClick={handleClear}
              className={search ? "d-block" : "d-none"}
              style={{
                position: "absolute",
                right: "10px",
                top: "8px",
                cursor: "pointer",
              }}
            >
              <i className="fa-solid fa-xmark "></i>
            </div>
          </div>

          <button
            style={{
              cursor: "pointer",
              outline: "none",
              border: "none",
            }}
            type="submit"
          >
            <i className="fas fa-search special-tag text-black"></i>
          </button>
        </div>
      </form>
    </div>
  );
};

export default Search;
