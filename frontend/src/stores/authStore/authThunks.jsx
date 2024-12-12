import { createAsyncThunk } from "@reduxjs/toolkit";
import customResponse from "~/services/customResponse";
import httpRequest from "~/utils/axios/axios";

const apiLogin = createAsyncThunk(
  "auth/login",
  async (payload, { rejectWithValue }) => {
    try {
      const response = await httpRequest.post("api/auth/login", payload);
      console.log(response.data);
      
      return response.data;
    } catch (error) {
      console.log(error);

      return rejectWithValue(customResponse(error));
    }
  }
);

const apiRegister = createAsyncThunk(
  "auth/register",
  async (payload, { rejectWithValue }) => {
    try {
      const response = await httpRequest.post("api/auth/register", payload);
      console.log(response.data);

      return response.data;
    } catch (error) {
      console.log(error);

      return rejectWithValue(customResponse(error));
    }
  }
);

export const authThunks = {
  apiLogin,
  apiRegister,
};
