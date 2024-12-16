import httpRequest from "~/utils/axios/axios";

const apiLogin = (payload) =>
  new Promise((resolve, reject) => {
    try {
      const response = httpRequest("api/auth/login", payload);
      resolve(response);
    } catch (error) {
      reject(error);
    }
  });

const apiRegister = async (payload) => {
  try {
    const response = await httpRequest.post("api/auth/register", payload);
    return response;
  } catch (error) {
    return error;
  }
};

const authService = {
  apiLogin,
  apiRegister,
};
export default authService;
