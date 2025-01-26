<?php
isset($_GET['eventId']) ? $eventData = eventDownload($_GET['eventId']) : $eventData = '';
$eventData != '' ? $eventDataLoc = locationDownload($_GET['eventId']) : $eventDataLoc = '';

?>

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
                    type="text"
                    value="" />
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
        <div id="place-box" class="place">
            <h3 class="location-title">Lokalizacja</h3>
            <div class="input-box-2">
                <div>
                    <label><b>Nazwa:</b></label>
                    <input
                        required
                        name="locationName"
                        class="date-input"
                        type="text" />
                </div>
                <div>
                    <label><b>Data:</b></label>
                    <input
                        required
                        name="locationDate"
                        class="text-input"
                        type="date" />
                </div>
            </div>
            <div class="input-box-2">
                <div>
                    <label><b>Kraj:</b></label>
                    <input
                        required
                        name="country"
                        class="date-input"
                        type="text" />
                </div>
                <div>
                    <label><b>Miasto:</b></label>
                    <input
                        required
                        name="city"
                        class="text-input"
                        type="text" />
                </div>

            </div>
            <div class="input-box-2">
                <div>
                    <label><b>Kod pocztowy:</b></label>
                    <input
                        required
                        name="postCode"
                        class="date-input"
                        type="text" />
                </div>
                <div>
                    <label><b>Miejscowość/ulica i numer:</b></label>
                    <input
                        required
                        name="street"
                        class="text-input"
                        type="text" />
                </div>

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