import React, { useRef, useState } from "react";
import Posts from "../Posts";
import useToken from "../../hooks/useToken";
import { useQuery } from "@tanstack/react-query";
import { fetchAllPostsCategory } from "../../api/QuerisFn";
import PgButton from "../PgButton";
import NoPosts from "../NoPosts";

const AllPostsCategory = ({ id }) => {
  const [page, setPageNumber] = useState(1);
  const { getToken } = useToken();
  const token = getToken();
  const totalPageNumbers = useRef(0);
  const pageArray = useRef([]);

  const handleSuccess = (data) => {
    totalPageNumbers.current = Math.ceil(
      data.posts.total / data.posts.per_page
    ); // calculate the total number

    // make an index array for page numbers
    pageArray.current = Array.from(
      { length: totalPageNumbers.current },
      (_, index) => index + 1
    );
  };

  const prevPage = () => {
    if (page === 1) {
      return;
    }
    setPageNumber((page) => Math.max(page - 1, 1));
  };
  const nextPage = () => {
    if (page === totalPageNumbers.current) {
      return;
    }
    setPageNumber((page) => Math.min(page + 1, totalPageNumbers.current));
  };

  // fetch all posts
  const { isLoading, isFetching, isSuccess, data } = useQuery({
    queryKey: ["category", id, `page${page}`],
    queryFn: () => fetchAllPostsCategory({ id, token, page }),
    enabled: !!token,
    onSuccess: handleSuccess,
    keepPreviousData: true,
  });

  return (
    <>
      {isSuccess && <Posts posts={data.posts.data} />}
      {isSuccess && data.posts.data.length === 0 && <NoPosts />}
      {/* <!--Start pagination --> */}
      {pageArray.current.length > 1 && (
        <div className="pagination-area pb-45 text-center">
          <div className="container">
            <div className="row">
              <div className="col-xl-12">
                <div className="single-wrap d-flex justify-content-center">
                  <nav aria-label="Page navigation example">
                    <ul className="pagination justify-content-start">
                      <button
                        onClick={prevPage}
                        disabled={page === 1 || isFetching || isLoading}
                      >
                        <li className="page-item">
                          <span className="page-link">
                            <i
                              className={`fa-solid fa-arrow-left-long ${
                                page === 1 ? "disable-arrow " : "active-arrow"
                              } `}
                              style={{ fontSize: "1.5rem" }}
                            ></i>
                          </span>
                        </li>
                      </button>
                      {pageArray.current.length > 0 &&
                        pageArray.current.map((pageNumber) => (
                          <PgButton
                            key={pageNumber}
                            pg={pageNumber}
                            isFetching={isFetching}
                            isLoading={isLoading}
                            setPageNumber={setPageNumber}
                            currentPage={page}
                          />
                        ))}
                      <button
                        onClick={nextPage}
                        disabled={
                          page === totalPageNumbers.current ||
                          isFetching ||
                          isLoading
                        }
                      >
                        <li className="page-item">
                          <span className="page-link">
                            <i
                              className={`fa-solid fa-arrow-right-long ${
                                page < totalPageNumbers.current
                                  ? "active-arrow"
                                  : "disable-arrow "
                              } `}
                              style={{ fontSize: "1.5rem" }}
                            ></i>
                          </span>
                        </li>
                      </button>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      )}
      {/* <!-- End pagination  --> */}
    </>
  );
};

export default AllPostsCategory;
