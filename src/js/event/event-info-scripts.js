async function loadInvations() {
  const res = await fetchApi(
    "/api/functions/invations/function-invation-display.php",
    {
      eventId: paramDownload("eventId"),
    }
  );

  const resText = await res.text();
  document.querySelector("#guestListBox").innerHTML = resText;
}
async function addInvationToDb() {
  const invationBoxes = document.querySelectorAll(".invation-form-item");
  const invations = [];

  invationBoxes.forEach((invationBox) => {
    const inputs = invationBox.querySelectorAll("input, select");
    const invation = {};
    inputs.forEach((input) => {
      invation[input.name] = input.value;
    });
    invations.push(invation);
  });
  console.log(invations);
  const res = await fetchApi(
    "/api/invations/",
    {
      action: "addInvation",
      eventId: paramDownload("eventId"),
      invations: JSON.stringify(invations),
    },
    "POST"
  );
  const resJson = await res.json();
  if (resJson.status == 200) {
    loadInvations();
    showAddInvationForm(false);
  } else {
    alert(resJson.message);
    console.log(resJson.error);
  }
}

function addQuestElement() {
  const invationBox = document.querySelector(".invation-box");
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

async function showAddInvationForm(bool) {
  var box = document.querySelector("#invationBox");
  if (bool) {
    const res = await fetchApi("/events/event-invation-add.php", {});
    box.innerHTML = await res.text();
  } else {
    box.innerHTML = "";
  }
}

async function deleteInvation(id) {
  const res = fetchApi(
    "/api/invations/",
    {
      action: "deleteInvation",
      invationId: id,
      eventId: paramDownload("eventId"),
    },
    "POST"
  );

  const resJson = await res.json();

  if (resJson.status == 200) {
    loadInvations();
  } else {
    console.error(resJson.error);
    alert("Błąd przy usuwaniu zaproszenia");
  }
}
