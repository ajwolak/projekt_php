async function logginOff() {
  fetchApi("/api/login/", { action: "logginOff" })
    .then((res) => {
      return res.json();
    })
    .then((res) => {
      window.location.href = "/login/";
    });
}
