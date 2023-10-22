import axiosInstance from "./Axios";

const getToken = () => {
  return localStorage.getItem("jwtToken");
};

const isTokenValid = (token) => {
  if (!token) {
    return false;
  }

  const decodedToken = decodeToken(token);
  if (!decodedToken) {
    return false;
  }

  const currentTime = Date.now() / 1000;
  return decodedToken.exp > currentTime;
};

const checkAuthenticationStatus = () => {
  const token = getToken();
  const valid = isTokenValid(token);
  if (valid) {
    axiosInstance.defaults.headers.common = {
      Authorization: `Bearer ${token}`,
    };
  } else {
    localStorage.removeItem("jwtToken");
  }
  return valid;
};

const parseJwt = (token) => {
  try {
    return JSON.parse(atob(token.split(".")[1]));
  } catch (e) {
    return null;
  }
};

const decodeToken = (token) => {
  try {
    const decoded = parseJwt(token);
    return decoded;
  } catch (error) {
    return null;
  }
};

export { checkAuthenticationStatus };
