import { createSlice } from "@reduxjs/toolkit";
import { authThunks } from "./authThunks";
import { toast } from "react-toastify";
import { cookiesUtils } from "~/utils/cookies";
import { navigateTo } from "~/routes/navigateService";
import ROUTE_PATH from "~/routes/route_Path";
const initialState = {
    user: null,

    token: null,
    loading: false,
    isSubmitting: false,
    error: null,
};
export const authSlice = createSlice({
  name: "auth",
  initialState,
  reducers: {
    logout: (state) => {
      state.isAuthenticated = false;
      state.user = null;
    },
  },
  extraReducers: (builder) => {
    builder
    .addCase(authThunks.apiLogin.pending , (state) => {
        state.loading = true;
        state.error = null;
    })
    .addCase(authThunks.apiLogin.fulfilled, (state , action) => {
        state.loading = false;
        console.log(action);
        
        state.token = action.payload.data.token;
        cookiesUtils.setAccessToken(action.payload.data.access_token, action.payload.data.expires_in)
        toast.success("Đăng nhập thành công")
        navigateTo(ROUTE_PATH.HOME)
    })
    .addCase(authThunks.apiLogin.rejected , (state , action) => {
        state.loading = false;
        state.error = action.error.message;
        toast.error(action.error.message)
    });

    builder
    .addCase(authThunks.apiRegister.pending , state => {
        state.loading = true;
        state.error = null;
    })
    .addCase(authThunks.apiRegister.fulfilled , (state ) => {
        state.loading = false;
        toast.success("Đăng ký thành công")
        navigateTo(ROUTE_PATH.LOGIN)
    })
    .addCase(authThunks.apiRegister.rejected , (state , action) => {
        state.loading = false;
        state.error = action.payload;
        console.log(action);
        
        toast.error(action.payload)
    })

  }
});

export const authActions  = {
    ...authSlice.actions,
    ...authThunks
}

export default authSlice.reducer;