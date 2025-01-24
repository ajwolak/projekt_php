<link rel="stylesheet" href="/src/css/pages/events/add-event.css">
<div class="add-event">
    <h1 class="event-title">Dodaj wydarzenie</h1>
    <form method="post" action="/api/events/">
        <div class="input-box-2">
            <div>
                <label><b>Nazwa:</b></label>
                <input
                    required
                    name="name"
                    class="text-input"
                    type="text" />
            </div>
            <div>
                <label><b>Czas do którego można potwierdzić udział:</b></label>
                <input
                    required
                    name="dateMax"
                    class="date-input"
                    type="date" />
            </div>
        </div>
        <div class="box-separate">
            <div>
                <label><b>Opis dla gości:</b></label>
                <textarea class="text-area-input" name="descriptionGuest" id="text-area-gues"></textarea>
            </div>
            <div>
                <label><b>Uwagi własne:</b></label>
                <textarea class="text-area-input" name="descriptionOwn" id="text-area-own"></textarea>
            </div>
        </div>
        <input type="hidden" name="action" value="addNewEvent">
        <button

            class="form-submit"
            type="submit">
            <b>Dodaj</b>
        </button>
    </form>
</div>
</div>