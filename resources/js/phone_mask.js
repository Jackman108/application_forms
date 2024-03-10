// phone_mask.js
document.addEventListener('DOMContentLoaded', function () {
    const countryCodeSelect = document.getElementById('country_code');
    const phoneInput = document.getElementById('phone');

    function applyMask() {
        const selectedCountryCode = countryCodeSelect.value;
        let mask = '';
        if (selectedCountryCode === '+7') {
            mask = '999 999-99-99';
        } else if (selectedCountryCode === '+375') {
            mask = '99 999-99-99';
        }
        phoneInput.inputmask(mask);
    }

    countryCodeSelect.addEventListener('change', applyMask);

    // Применяем маску на основе выбранного кода страны при загрузке страницы
    applyMask();

    const form = document.querySelector('form');
    form.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            return false;
        }
    });
});
