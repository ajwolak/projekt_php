<div class="invation-form">
    <div class="header">
        <h3>Zaproszenie nr 1</h3>
    </div>
    <div id="guestsBox" class="guests-box">
        <div class="invation-box invation-form-item">
            <div class="header">
                <h3>Gość nr 1</h3>
            </div>
            <div class="global-input-box">
                <input type="text" name="name" autocomplete="off" required placeholder="Imię:">
                <label>Imię:</label>
            </div>
            <div class="global-input-box">
                <input type="text" name="surname" autocomplete="off" required placeholder="Nazwisko:">
                <label>Nazwisko:</label>
            </div>
            <div class="global-input-box">
                <select name="isKid">
                    <option value="0">Dorosły</option>
                    <option value="1">Dziecko</option>
                </select>
            </div>
            <div class="global-input-box">
                <input type="text" name="email" autocomplete="off" required placeholder="Email:">
                <label>Email:</label>
            </div>
            <div class="global-input-box">
                <input type="text" name="phone" autocomplete="off" required placeholder="Telefon:">
                <label>Telefon:</label>
            </div>
            <div class="global-input-box">
                <select name="sex">
                    <option value="0">Mężczyzna</option>
                    <option value="1">Kobieta</option>
                </select>
            </div>
            <div class="global-input-box">
                <input type="text" name="description" autocomplete="off" required placeholder="Twoja notatka:">
                <label>Twoja notatka:</label>
            </div>
            <div class="global-input-box">
                <select name="isAccepted">
                    <option value="2">Do potwierdzenia</option>
                    <option value="1">Potwierdził / ła obecność</option>
                </select>
            </div>
        </div>
    </div>
    <div class="action-box">
        <div class="button bg-color-blue font-color-white" onclick="addQuestElement();">Dodaj kolejną osobę do zaproszenia</div>
        <div class="button bg-color-green font-color-white" onclick="addInvationToDb();">Dodaj</div>
    </div>
</div>