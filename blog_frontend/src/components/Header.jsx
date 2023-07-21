import { Link, useNavigate } from "react-router-dom";
import useToken from "../hooks/useToken";
import { useEffect } from "react";

const Header = () => {
  const navigate = useNavigate();
  const date = new Date();

  const { getUser, logout } = useToken();
  const user = getUser();

  const handleLogout = () => {
    logout();
    navigate("/login");
  };
  return (
    <header>
      {/* <!-- Header Start --> */}
      <div className="header-area">
        <div className="main-header">
          <div className="header-top black-bg d-none d-md-block">
            <div className="container">
              <div className="col-xl-12 d-flex justify-content-between align-items-center">
                <div className="row d-flex justify-content-between align-items-center">
                  <div className="header-info-left">
                    <ul>
                      <li>
                        <img
                          src="../../public/assets/img/icon/header_icon1.png"
                          alt=""
                        />
                        34ºc, Sunny
                      </li>
                      <li>
                        <img
                          src="../../public/assets/img/icon/header_icon1.png"
                          alt=""
                        />
                        {date.toISOString()}
                      </li>
                    </ul>
                  </div>
                  <div className="header-info-right">
                    <ul className="header-social">
                      <li>
                        <a href="details.html">
                          <i className="fab fa-twitter"></i>
                        </a>
                      </li>
                      <li>
                        <a href="details.html">
                          <i className="fab fa-instagram"></i>
                        </a>
                      </li>
                      <li>
                        <a href="details.html">
                          <i className="fab fa-pinterest-p"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                {user && <h5 className="text-white">Welcome {user["name"]}</h5>}
              </div>
            </div>
          </div>

          <div className="header-bottom header-sticky">
            <div className="container">
              <div className="row align-items-center">
                <div className="col-xl-10 col-lg-10 col-md-12 header-flex align-items-center">
                  {/* <!-- sticky --> */}
                  <div className="sticky-logo">
                    <a href="index.html">
                      <img src="../../public/assets/img/logo/logo.png" alt="" />
                    </a>
                  </div>
                  {/* <!-- Main-menu --> */}
                  <div className="main-menu d-none d-md-block">
                    <nav>
                      <ul id="navigation">
                        <li>
                          <Link to={"/"} style={{ padding: "15px" }}>
                            Home
                          </Link>
                        </li>
                        {user ? (
                          <li onClick={handleLogout}>
                            <Link to={"/register"} style={{ padding: "15px" }}>
                              Logout
                            </Link>
                          </li>
                        ) : (
                          <>
                            <li>
                              <Link to={"/login"} style={{ padding: "15px" }}>
                                Login
                              </Link>
                            </li>
                            <li>
                              <Link
                                to={"/register"}
                                style={{ padding: "15px" }}
                              >
                                Register
                              </Link>
                            </li>
                          </>
                        )}

                        <li>
                          <Link to={"/contact"} style={{ padding: "15px" }}>
                            Contact
                          </Link>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>

                {/* <!-- Mobile Menu --> */}
                <div className="col-12">
                  <div className="mobile_menu d-block d-md-none"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {/* <!-- Header End --> */}
    </header>
  );
};

export default Header;
