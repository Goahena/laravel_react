import { createBrowserRouter } from "react-router-dom";
import ProtectRoute from "./ProtectRoute";
import ErrorDetails from "~/pages/errors/ErrorsDetails";
import LayoutDefault from "~/layouts/client/LayoutDefault";
import ROUTE_PATH from "./route_Path";
import Login from "~/pages/auth/Login";
import Register from "~/pages/auth/Register";
import Contact from "~/pages/contact/Contact";
import Home from "~/pages/home";

const routes = createBrowserRouter(
  [
    {
      element: <ProtectRoute />,
      errorElement: <ErrorDetails />,
    },
    {
      element: <LayoutDefault />,
      children: [
        {
          path: ROUTE_PATH.LOGIN,
          element: <Login />,
        },
        {
          path: ROUTE_PATH.REGISTER,
          element: <Register />,
        },
        {
          path: ROUTE_PATH.CONTACT,
          element: <Contact />,
        },
        {
          path: ROUTE_PATH.HOME,
          element: <Home/>
        }
      ],
    },
  ],
  {
    future: {
      v7_relativeSplatPath: true,
      v7_fetcherPersist: true,
      v7_normalizeFormMethod: true,
      v7_partialHydration: true,
      v7_skipActionErrorRevalidation: true,
    },
  }
);

export default routes;
