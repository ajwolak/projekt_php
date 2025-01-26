<?php
$textButton = isset($_GET['eventId']) ? 'Aktualizuj' : 'Dodaj';
$eventId = isset($_GET['eventId']) ? $_GET['eventId'] : '';
$exist = isset($_GET['eventId']) ? 'updateEvent' : 'addNewEvent';
$name = isset($_GET['eventId']) ? eventDownload($_GET['eventId'])['name'] : '';
$date = isset($_GET['eventId']) ? substr(eventDownload($_GET['eventId'])['max_accept_date'], 0, 10) : '';
$guestDescription = isset($_GET['eventId']) ? eventDownload($_GET['eventId'])['guest_description'] : '';
$userDescription = isset($_GET['eventId']) ? eventDownload($_GET['eventId'])['user_description'] : '';
$locationName = isset($_GET['eventId']) ? locationDownload($_GET['eventId'])['name'] : '';
$locationDate = isset($_GET['eventId']) ? substr(locationDownload($_GET['eventId'])['date'], 0, 10) : '';
$country = isset($_GET['eventId']) ? locationDownload($_GET['eventId'])['country'] : '';
$town = isset($_GET['eventId']) ? locationDownload($_GET['eventId'])['town'] : '';
$zipCode = isset($_GET['eventId']) ? locationDownload($_GET['eventId'])['zip_code'] : '';
$street = isset($_GET['eventId']) ? locationDownload($_GET['eventId'])['street'] : '';
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
                    value="<?= htmlspecialchars($name) ?>" />
            </div>
            <div>
                <label><b>Czas do którego można potwierdzić udział:</b></label>
                <input
                    required
                    name="dateMax"
                    class="date-input"
                    type="date"
                    value="<?= htmlspecialchars($date) ?>" />
            </div>
        </div>
        <div class="box-separate">
            <div>
                <label><b>Opis dla gości:</b></label>
                <textarea class="text-area-input" name="descriptionGuest" id="text-area-gues"><?= htmlspecialchars($guestDescription) ?></textarea>
            </div>
            <div>
                <label><b>Uwagi własne:</b></label>
                <textarea class="text-area-input" name="descriptionOwn" id="text-area-own"><?= htmlspecialchars($userDescription) ?></textarea>
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
                        type="text"
                        value="<?= htmlspecialchars($locationName) ?>" />
                </div>
                <div>
                    <label><b>Data wydarzenia:</b></label>
                    <input
                        required
                        name="locationDate"
                        class="text-input"
                        type="date"
                        value="<?= htmlspecialchars($locationDate) ?>" />
                </div>
            </div>
            <div class="input-box-2">
                <div>
                    <label><b>Kraj:</b></label>
                    <input
                        required
                        name="country"
                        class="date-input"
                        type="text"
                        value="<?= htmlspecialchars($country) ?>" />
                </div>
                <div>
                    <label><b>Miasto:</b></label>
                    <input
                        required
                        name="city"
                        class="text-input"
                        type="text"
                        value="<?= htmlspecialchars($town) ?>" />
                </div>

            </div>
            <div class="input-box-2">
                <div>
                    <label><b>Kod pocztowy:</b></label>
                    <input
                        required
                        name="postCode"
                        class="date-input"
                        type="text"
                        pattern="^\d{2}-\d{3}$"
                        value="<?= htmlspecialchars($zipCode) ?>" />
                </div>
                <div>
                    <label><b>Miejscowość/ulica i numer:</b></label>
                    <input
                        required
                        name="street"
                        class="text-input"
                        type="text"
                        value="<?= htmlspecialchars($street) ?>" />
                </div>

            </div>
        </div>
        <input type="hidden" name="action" value="<?= htmlspecialchars($exist) ?>">
        <input type="hidden" name="eventIdUpdate" value="<?= htmlspecialchars($eventId) ?>">
        <button

            class="form-submit"
            type="submit">
            <b><?= $textButton ?></b>
        </button>
    </form>
</div>
</div>