function fetchApi(url, params = {}, method = "GET") {
  let fetch_options = {
    method: method,
    headers: {
      "Content-Type":
        method === "POST"
          ? "application/x-www-form-urlencoded"
          : "application/json",
    },
  };

  let link = `${window.location.protocol}//${window.location.hostname}/${url}`;

  if (method === "POST") {
    fetch_options.body = new URLSearchParams(params).toString();
  } else if (method === "GET") {
    const queryString = new URLSearchParams(params).toString();
    link += `?${queryString}`;
  }

  try {
    return fetch(link, fetch_options)
      .then((res) => res)
      .catch((err) => {
        console.error("Error in fetch: ", err);
      });
  } catch (err) {
    console.error("Error in fetch api: ", err);
  }
}
