async function confirm() {
  try {
    const data = [];

    const form = document.querySelector("form");
    const selects = form.querySelectorAll('select[name^="select_for_"]');
    const inputs = form.querySelectorAll('input[name^="notes_for_"]');

    selects.forEach((select) => {
      const guestId = select.name.replace("select_for_", "");
      const isAccept = select.value;

      const input = form.querySelector(`input[name="notes_for_${guestId}"]`);
      const notes = input ? input.value : "";

      data.push({
        guest_id: guestId,
        isAccept: isAccept,
        notes: notes,
      });
    });

    const res = await fetchApi(
      "/api/invations/",
      {
        action: "confirmationEvent",
        form: JSON.stringify(data),
        code: paramDownload("code"),
      },
      "POST"
    );
    const resJson = await res.json();
    if (resJson.status == 200) {
      document.querySelector(".guest-box").innerHTML =
        '<br/><br/><h1 style="text-align:center;">Dziękujemy za potwierdzenie obecności!</h1><br/><br/>';
    } else {
      alert("Wystąpił błąd. Spróbuj ponownie później.");
      console.error(resJson.error);
    }
  } catch (e) {
    alert("Wystąpił błąd. Spróbuj ponownie później.");
    console.error(e);
  }
}
