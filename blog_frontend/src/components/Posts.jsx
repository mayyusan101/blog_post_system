import React from "react";
import BlogCard from "./BlogCard";

const Posts = ({ posts }) => {
  return (
    <div className="whats-news-caption">
      <div className="row">
        {posts.map((post) => (
          <BlogCard post={post} key={post.post_id} />
        ))}
      </div>
    </div>
  );
};

export default Posts;
