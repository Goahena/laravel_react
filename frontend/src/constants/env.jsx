const env = {
  REACT_APP_BASE_URL: import.meta.env.REACT_APP_BASE_URL || "localhost:7080",
  REACT_APP_BASE_URL_2: import.meta.env.REACT_APP_BASE_URL_2 || "http://127.0.0.1:8080",
  REACT_APP_ACCESS_TOKEN: import.meta.env.REACT_APP_ACCESS_TOKEN || "_t",
};
export default env;
