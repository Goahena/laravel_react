import { configureStore } from "@reduxjs/toolkit";
import { authSlice } from "./authStore/authReducer";

const store = configureStore({
    reducer: {
        authStore: authSlice.reducer
    }
})

export default store