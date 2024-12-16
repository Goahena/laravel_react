import { createRoot } from "react-dom/client";
import App from "~/App.jsx";
import GlobalStyles from "../src/components/globalStyles/GlobalStyles.jsx"
import { Provider } from "react-redux";
import store from "./stores/index.jsx";

createRoot(document.getElementById("root")).render(
  // <StrictMode>
  <Provider store={store}>
    <GlobalStyles>
      <App />
    </GlobalStyles>
   </Provider>
  // </StrictMode>
);
