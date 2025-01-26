function addLocationElement() {
  const invationBox = document.querySelector(".place-box");
  const guestsBox = document.querySelector("#guestsBox");
  const invationBoxClone = invationBox.cloneNode(true);

  const guestNumber = guestsBox.children.length + 1;
  invationBoxClone.querySelector(
    ".header h3"
  ).textContent = `Gość nr ${guestNumber}`;

  const inputs = invationBoxClone.querySelectorAll("input, select");
  inputs.forEach((input) => {
    if (input.tagName === "SELECT") {
      input.selectedIndex = 0;
    } else {
      input.value = "";
    }
  });

  guestsBox.appendChild(invationBoxClone);
}
