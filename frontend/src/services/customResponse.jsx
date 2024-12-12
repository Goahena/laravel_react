function customResponse(e) {
    if (e.response?.data?.error) {
        return Object.values(e.response.data.error)[0][0];
      }
      if (e.response?.data?.message) {
        return e.response.data.message;
      }
      return e;
}

export default customResponse;