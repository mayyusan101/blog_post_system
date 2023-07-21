import { useNavigate, useParams } from "react-router-dom";
import Header from "../components/Header";
import useToken from "../hooks/useToken";
import { useQuery } from "@tanstack/react-query";
import { fetchDetailsPost } from "../api/QuerisFn";

const Details = () => {
  const { postId } = useParams();
  const navigate = useNavigate();

  const { getToken } = useToken();
  const token = getToken();

  // fetch details post
  const { isSuccess, data: post } = useQuery({
    queryKey: ["post", postId],
    queryFn: () => fetchDetailsPost({ postId, token }),
    enabled: !!token,
    keepPreviousData: true,
  });

  return (
    <>
      <Header />
      <main>
        {/* <!-- About US Start --> */}
        <div className="about-area">
          <div className="container">
            {/* <!-- Hot Aimated News Tittle--> */}
            <div className="row">
              <div className="col-lg-12">
                <div className="trending-tittle">
                  <strong
                    style={{ cursor: "pointer" }}
                    onClick={() => navigate(-1)}
                  >
                    Back
                  </strong>
                </div>
              </div>
            </div>
            <div className="row">
              <div className="col-lg-8">
                {/* <!-- Trending Tittle --> */}
                {isSuccess && (
                  <div className="about-right mb-90">
                    <div className="about-img">
                      <img
                        src={`http://localhost:8000/images/${post.image}`}
                        alt=""
                      />
                    </div>
                    <div className="section-tittle mb-30 pt-30">
                      <h3>{post.title}</h3>
                    </div>
                    <div className="about-prea">
                      <p className="about-pera1 mb-25">{post.description}</p>
                    </div>
                    <div className="social-share pt-30">
                      <div className="section-tittle">
                        <h3 className="mr-20">Share:</h3>
                        <ul>
                          <li>
                            <a href="#">
                              <img
                                src="../../public/assets/img/news/icon-ins.png"
                                alt=""
                              />
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <img
                                src="../../public/assets/img/news/icon-fb.png"
                                alt=""
                              />
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <img
                                src="../../public/assets/img/news/icon-tw.png"
                                alt=""
                              />
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <img
                                src="../../public/assets/img/news/icon-yo.png"
                                alt=""
                              />
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                )}
                {/* <!-- From --> */}
                <div className="row">
                  <div className="col-lg-8">
                    <form
                      className="form-contact contact_form mb-80"
                      action="contact_process.php"
                      method="post"
                      id="contactForm"
                    >
                      <div className="row">
                        <div className="col-12">
                          <div className="form-group">
                            <textarea
                              className="form-control w-100 error"
                              name="message"
                              id="message"
                              cols="30"
                              rows="9"
                              placeholder="Enter Message"
                            ></textarea>
                          </div>
                        </div>
                        <div className="col-sm-6">
                          <div className="form-group">
                            <input
                              className="form-control error"
                              name="name"
                              id="name"
                              type="text"
                              placeholder="Enter your name"
                            />
                          </div>
                        </div>
                        <div className="col-sm-6">
                          <div className="form-group">
                            <input
                              className="form-control error"
                              name="email"
                              id="email"
                              type="email"
                              placeholder="Email"
                            />
                          </div>
                        </div>
                        <div className="col-12">
                          <div className="form-group">
                            <input
                              className="form-control error"
                              name="subject"
                              id="subject"
                              type="text"
                              placeholder="Enter Subject"
                            />
                          </div>
                        </div>
                      </div>
                      <div className="form-group mt-3">
                        <button
                          type="submit"
                          className="button button-contactForm boxed-btn"
                        >
                          Send
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div className="col-lg-4">
                <div className="section-tittle mb-40">
                  <h3>Follow Us</h3>
                </div>
                {/* <!-- Flow Socail --> */}
                <div className="single-follow mb-45">
                  <div className="single-box">
                    <div className="follow-us d-flex align-items-center">
                      <div className="follow-social">
                        <a href="#">
                          <img
                            src="../../public/assets/img/news/icon-fb.png"
                            alt=""
                          />
                        </a>
                      </div>
                      <div className="follow-count">
                        <span>8,045</span>
                        <p>Fans</p>
                      </div>
                    </div>
                    <div className="follow-us d-flex align-items-center">
                      <div className="follow-social">
                        <a href="#">
                          <img
                            src="../../public/assets/img/news/icon-tw.png"
                            alt=""
                          />
                        </a>
                      </div>
                      <div className="follow-count">
                        <span>8,045</span>
                        <p>Fans</p>
                      </div>
                    </div>
                    <div className="follow-us d-flex align-items-center">
                      <div className="follow-social">
                        <a href="#">
                          <img
                            src="../../public/assets/img/news/icon-ins.png"
                            alt=""
                          />
                        </a>
                      </div>
                      <div className="follow-count">
                        <span>8,045</span>
                        <p>Fans</p>
                      </div>
                    </div>
                    <div className="follow-us d-flex align-items-center">
                      <div className="follow-social">
                        <a href="#">
                          <img
                            src="../../public/assets/img/news/icon-yo.png"
                            alt=""
                          />
                        </a>
                      </div>
                      <div className="follow-count">
                        <span>8,045</span>
                        <p>Fans</p>
                      </div>
                    </div>
                  </div>
                </div>
                {/* <!-- New Poster --> */}
                <div className="news-poster d-none d-lg-block">
                  <img
                    src="../../public/assets/img/news/news_card.jpg"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        {/* <!-- About US End --> */}
      </main>
    </>
  );
};

export default Details;
