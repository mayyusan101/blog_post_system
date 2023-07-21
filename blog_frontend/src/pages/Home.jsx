import { useState } from "react";
import Category from "../components/Category";
import AllPosts from "../components/posts/AllPosts";
import AllPostsCategory from "../components/posts/AllPostsCategory";
import Search from "../components/Search";
import SearchPosts from "../components/posts/SearchPosts";
import NoPermission from "../components/NoPermission";
import useToken from "../hooks/useToken";

const Home = () => {
  const [navItem, setNavItem] = useState("all");
  const [categoryId, setCategoryId] = useState("");
  const [searchKey, setSearchKey] = useState("");
  const [enableSearch, setEnableSearch] = useState(false);

  const { getToken } = useToken();
  const token = getToken(); // get token

  const handleCategoryChange = (id, navItem) => {
    setCategoryId(id);
    setNavItem(navItem);
    setSearchKey(""); // set empty if any in search box
    setEnableSearch(false); // search for category posts
  };

  let posts; // store posts to show

  // when user not search(!Enter)
  if (!enableSearch) {
    if (navItem === "all") {
      posts = <AllPosts />;
    } else {
      posts = <AllPostsCategory id={categoryId} />;
    }
  }

  // only show when user search (Enter)
  if (searchKey !== "" && enableSearch) {
    posts = <SearchPosts searchKey={searchKey} />;
  }

  // search  posts fun
  const handleSearchPosts = (search) => {
    setSearchKey(search);
    setEnableSearch(true); // user search for posts
    if (search === "") {
      setEnableSearch(false); // fetch all post if clear
    }
  };

  return (
    <div>
      {token ? (
        <>
          <Category navItem={navItem} onCategoryChange={handleCategoryChange} />
          <Search onSearchPosts={handleSearchPosts} enableSearch={searchKey} />
          <main>
            {/* <!-- Whats New Start --> */}
            <section className="whats-news-area pt-50 pb-20">
              <div className="container">
                <div className="row">
                  <div className="col-lg-12">
                    <div className="row">
                      <div className="col-12">
                        {/* <!-- Nav Card --> */}
                        <div className="tab-content" id="nav-tabContent">
                          <div
                            className="tab-pane fade show active"
                            id="nav-home"
                            role="tabpanel"
                            aria-labelledby="nav-home-tab"
                          >
                            {posts}
                          </div>
                        </div>
                        {/* <!-- End Nav Card --> */}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </main>
        </>
      ) : (
        <NoPermission />
      )}
    </div>
  );
};

export default Home;
