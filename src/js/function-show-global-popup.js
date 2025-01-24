function showGlobalPopup(data, action) {
  document.querySelector((action == "id" ? "#" : ".") + data).style.display =
    "block";
}

function closeGlobalPopup(data, action) {
  document.querySelector((action == "id" ? "#" : ".") + data).style.display =
    "none";
}

function fillGlobalPopup(data) {
  const arr = data;
  document.querySelector("#global_popup_heading_title").innerHTML =
    arr["popup_heading"];
  document.querySelector("#global_popup_main_content").innerHTML =
    arr["popup_body"];
}
