import Axios from "axios";
import { createBrowserHistory } from "history";

const history = createBrowserHistory();

const axiosInstance = Axios.create();

axiosInstance.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response && error.response.status === 403) {
      localStorage.removeItem("security_id");
      localStorage.removeItem("session");
      history.push("/login");
      window.location.reload();
    }

    // Propagate the error further if needed
    return Promise.reject(error);
  }
);

export default axiosInstance;
