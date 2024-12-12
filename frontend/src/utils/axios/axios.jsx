import axios from "axios";
import env from "~/constants/env";
import getAccessToken from "../functions/getAccessToken";

const httpRequest = axios.create({
  baseURL: env.REACT_APP_BASE_URL_2,
  timeout: 10000,
});

httpRequest.interceptors.request.use(function (config) {
  let token = getAccessToken();
  if (token !== undefined) {
    config.headers = {
      withCredentials: true,
      authorization: token ? `Bearer ${token}` : null,
    };
  }
  return config;
});

// Add a response interceptor
httpRequest.interceptors.response.use(function (response) {
  // refresh token

  return response;
});

export default httpRequest;
