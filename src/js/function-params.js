function getAllParamFromUrl() {
  const params = new URLSearchParams(window.location.search);
  const paramsObject = {};
  for (const [key, value] of params.entries()) {
    paramsObject[key] = value;
  }
  return paramsObject;
}

function paramDownload(paramName) {
  return new URL(window.location.href).searchParams.get(paramName);
}

function paramLoad(paramName, paramValue) {
  const url = new URL(window.location.href);
  url.searchParams.set(paramName, paramValue);
  window.history.replaceState(null, null, decodeURIComponent(url));
}

function paramDelete(paramName) {
  const url = new URL(window.location.href);
  url.searchParams.delete(paramName);
  window.history.replaceState(null, null, url);
}
