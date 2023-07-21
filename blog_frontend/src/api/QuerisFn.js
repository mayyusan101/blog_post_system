import axios from "axios";

export const url = axios.create({
  baseURL: "http://localhost:8000",
});

// fetch posts
const fetchAllPosts = async ({ token, page }) => {
  const response = await url.get(`/api/allPost?page=${page}`, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });
  return response.data;
};

// fetch categories
const fetchAllCategories = async (token) => {
  const response = await url.get("/api/allCategory", {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });
  return response.data.category;
};

// fetch all posts by category
const fetchAllPostsCategory = async ({ id, token, page }) => {
  const response = await url.post(
    `/api/category/search?page=${page}`,
    {
      key: id,
    },
    {
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      },
    }
  );
  return response.data;
};

// fetch search posts
const fetchAllPostsSearch = async ({ searchKey, token, page }) => {
  const response = await url.post(
    `/api/post/search?page=${page}`,
    {
      key: searchKey,
    },
    {
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      },
    }
  );
  return response.data;
};

// fetch details post
const fetchDetailsPost = async ({ postId, token }) => {
  const response = await url.post(
    "http://localhost:8000/api/post/detail",
    {
      id: postId,
    },
    {
      headers: {
        "Content-type": "application/json",
        Authorization: `Bearer ${token}`,
      },
    }
  );
  return response.data.post;
};

export {
  fetchAllPosts,
  fetchAllCategories,
  fetchAllPostsCategory,
  fetchAllPostsSearch,
  fetchDetailsPost,
};
