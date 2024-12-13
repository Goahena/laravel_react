import Cookies from "js-cookie";
import env from "~/constants/env";
const setAccessToken = (token , expires) => {
  Cookies.set(env.REACT_APP_ACCESS_TOKEN, token, {
    expires: new Date(Date.now() + 3600000 * expires/60),
    path: "/",
  });
};
const removeAccessToken = () => {
  Cookies.remove(env.REACT_APP_ACCESS_TOKEN);
};

export const cookiesUtils = {
  setAccessToken,
  removeAccessToken,
};
