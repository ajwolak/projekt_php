<link rel="stylesheet" href="/src/css/pages/events/add-event.css">
<div class="add-event">
    <h1 class="event-title">Dodaj wydarzenie</h1>
    <form class="">
        <div class="input-box-2">
            <div>
                <label><b>Nazwa:</b></label>
                <input
                    class="text-input"
                    type="text" />
            </div>
            <div>
                <label><b>Czas do którego można potwierdzić udział:</b></label>
                <input
                    class="date-input"
                    type="date" />
            </div>
        </div>
        <div class="box-separate">
            <div>
                <label><b>Opis dla gości:</b></label>
                <textarea class="text-area-input" name="text-area-guest" id="text-area-gues"></textarea>
            </div>
            <div>
                <label><b>Uwagi własne:</b></label>
                <textarea class="text-area-input" name="text-area-own" id="text-area-own"></textarea>
            </div>
        </div>



        <button
            class="form-submit"
            type="submit">
            <b>Dodaj</b>
        </button>
    </form>
</div>
</div>