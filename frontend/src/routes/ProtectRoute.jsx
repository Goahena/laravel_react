
import { toast } from "react-toastify";
import getAccessToken from "~/utils/functions/getAccessToken";
import { Navigate, Outlet } from "react-router-dom";
import ROUTE_PATH from "./route_Path";

function ProtectRoute() {  
   
  const accessToken = getAccessToken();
  if (!accessToken) {
      toast.warning("Vui lòng đăng nhập");
      return <Navigate to={ROUTE_PATH.LOGIN} />;
    }
    return <Outlet />;
}

export default ProtectRoute;