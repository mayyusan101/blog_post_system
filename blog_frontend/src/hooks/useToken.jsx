const useToken = () => {
  const storeToken = (data) => {
    localStorage.setItem("token", data.token);
    localStorage.setItem("user", JSON.stringify(data.user));
  };
  const getToken = () => {
    const token = localStorage.getItem("token") || null;
    return token;
  };
  const getUser = () => {
    const userData = localStorage.getItem("user") || null;
    return JSON.parse(userData);
  };
  const logout = () => {
    localStorage.removeItem("token");
    localStorage.removeItem("user");
  };
  return { storeToken, getToken, getUser, logout };
};

export default useToken;
