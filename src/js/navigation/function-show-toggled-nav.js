function showToogledNav() {
  document.querySelector("nav").classList.toggle("toggled");
  document.querySelector("nav .group").classList.toggle("toggled");
  document.querySelector("section.content").classList.toggle("toggled");
  document.querySelector("section.pagination").classList.toggle("toggled");
}
