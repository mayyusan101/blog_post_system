import { useQuery } from "@tanstack/react-query";
import useToken from "../hooks/useToken";
import { fetchAllCategories } from "../api/QuerisFn";

const Category = ({ navItem, onCategoryChange }) => {
  const { getToken } = useToken();
  const token = getToken();

  // fetch all categories
  const { isSuccess, data } = useQuery({
    queryKey: ["allCategories"],
    queryFn: () => fetchAllCategories(token),
    enabled: !!token,
    keepPreviousData: true,
  });

  const handleChangeCategory = (id, navItemName) => {
    onCategoryChange(id, navItemName);
  };

  return (
    <section className="whats-news-area pt-30 pb-10">
      <div className="container">
        <div className="row">
          <div className="col-lg-12">
            <div className="row d-flex justify-content-between align-items-center">
              <div className="col-lg-3 col-md-3">
                <div className="section-tittle mb-20">
                  <h3>Whats New</h3>
                </div>
              </div>
              <div className="col-lg-9 col-md-9">
                <div className="properties__button">
                  {/* <!--Nav Button  --> */}

                  <nav>
                    <div className="nav nav-tabs" id="nav-tab" role="tablist">
                      <a
                        className={`nav-item nav-link ${
                          navItem === "all" ? "active" : ""
                        }`}
                        id="nav-home-tab"
                        data-toggle="tab"
                        role="tab"
                        aria-controls="nav-home"
                        aria-selected="true"
                        onClick={() => handleChangeCategory("all", "all")}
                        style={{ cursor: "pointer" }}
                      >
                        All
                      </a>
                      {isSuccess &&
                        data.map((category) => (
                          <a
                            key={category.category_id}
                            className={`nav-item nav-link ${
                              navItem === category.title ? "active" : ""
                            }`}
                            id="nav-profile-tab"
                            data-toggle="tab"
                            role="tab"
                            aria-controls="nav-profile"
                            aria-selected="false"
                            onClick={() =>
                              handleChangeCategory(
                                category.category_id,
                                category.title
                              )
                            }
                            style={{ cursor: "pointer" }}
                          >
                            {category.title}
                          </a>
                        ))}
                    </div>
                  </nav>

                  {/* <!--End Nav Button  --> */}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

// const useHandleChange = (id) => {
//   const { data } = useGetCategoryAllPosts(id);
//   return data;
// };

export default Category;
