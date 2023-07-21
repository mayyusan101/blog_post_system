const useAccont = () => {
  const accountRegister = async (postData) => {
    const response = await fetch("http://localhost:8000/api/user/register", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(postData),
    });
    const data = await response.json();
    return data;
  };

  const accountLogin = async (postData) => {
    const response = await fetch("http://localhost:8000/api/user/login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(postData),
    });
    const data = await response.json();
    return data;
  };
  return { accountRegister, accountLogin };
};

export default useAccont;
