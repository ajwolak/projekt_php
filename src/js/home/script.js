let chart = null;

async function generateStats(eventId) {
  document.querySelector(".card_one").onclick = function () {
    window.location.href = "/pdf/all-invations/?eventId=" + eventId;
  };
  document.querySelector(".card_two").onclick = function () {
    window.location.href = "/pdf/currently-accepted/?eventId=" + eventId;
  };
  document.querySelector(".card_three").onclick = function () {
    window.location.href = "/events/?list=info&eventId=" + eventId;
  };

  const res = await fetchApi("/api/home/", {
    action: "getStats",
    eventId: eventId,
  });
  const resJson = await res.json();

  if (resJson.status == 200) {
    if (chart !== null) {
      chart.destroy();
    }

    var options = {
      chart: {
        type: "donut",
      },
      series: [
        resJson.body.noInfo,
        resJson.body.accepted,
        resJson.body.notAccepted,
      ],
      labels: [
        `Czekają na akceptację (${resJson.body.noInfo})`,
        `Zaakceptowane (${resJson.body.accepted})`,
        `Odrzucone (${resJson.body.notAccepted})`,
      ],
    };

    // Tworzenie nowego wykresu i zapisywanie referencji
    chart = new ApexCharts(document.querySelector(".chart-box"), options);
    chart.render();
  } else {
    console.error(resJson.error);
    alert("Błąd w statystykach");
  }
}
