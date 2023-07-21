import { Link } from "react-router-dom";

const BlogCard = ({ post }) => {
  return (
    <div className="col-lg-6 col-md-6">
      <Link to={`details/${post.post_id}`}>
        <div className="single-what-news mb-100">
          <div className="what-img">
            <img
              src={`http://localhost:8000/images/${post.image}`}
              alt="post image"
            />
          </div>
          <div className="what-cap">
            <span className="color1">{post.title}</span>
            <h4>
              <span>{post.description.slice(0, 100)} ...</span>
            </h4>
          </div>
        </div>
      </Link>
    </div>
  );
};

export default BlogCard;
