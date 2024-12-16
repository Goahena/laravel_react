import env from "../../constants/env";
import Cookies from "js-cookie";

function getAccessToken() {
    const acccessToken = Cookies.get(env.REACT_APP_ACCESS_TOKEN)
    return acccessToken
}

export default getAccessToken;