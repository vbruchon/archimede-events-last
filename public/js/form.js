export function initEventForm(options = {}) {
    // options: { startSelector, endSelector, defaultStart, defaultEnd }
    const startSelector = options.startSelector || "#dateStart";
    const endSelector = options.endSelector || "#dateEnd";
    const defaultStart = options.defaultStart || null;
    const defaultEnd = options.defaultEnd || null;

    const startDatePicker = flatpickr(startSelector, {
        enableTime: true,
        time_24hr: true,
        dateFormat: "d-m-Y H:i",
        locale: "fr",
        defaultDate: defaultStart,
        onChange: function (selectedDates) {
            if (selectedDates.length) {
                const startDate = selectedDates[0];
                endDatePicker.set("minDate", startDate);

                if (!endDatePicker.selectedDates.length) {
                    const endDate = new Date(
                        startDate.getTime() + 60 * 60 * 1000
                    );
                    endDatePicker.setDate(endDate, true);
                }
            }
        },
        onReady: addTimeHeader,
    });

    const endDatePicker = flatpickr(endSelector, {
        enableTime: true,
        time_24hr: true,
        dateFormat: "d-m-Y H:i",
        locale: "fr",
        defaultDate: defaultEnd,
        onReady: addTimeHeader,
    });

    function addTimeHeader(selectedDates, dateStr, instance) {
        instance.calendarContainer
            .querySelector(".flatpickr-time")
            .insertAdjacentHTML(
                "afterbegin",
                `
            <div class="custom-time-header">
                <span class="time-label">Heures</span>
                <span class="time-label">Minutes</span>
            </div>
        `
            );
    }

    const radios = document.querySelectorAll("input[name='is_Fix']");
    const fixBlock = document.getElementById("is_fix");
    const notFixBlock = document.getElementById("is_not_fix");

    function toggleBlocks() {
        const checked = document.querySelector("input[name='is_Fix']:checked");
        if (!checked) {
            fixBlock.style.display = "none";
            notFixBlock.style.display = "none";
            return;
        }
        if (checked.value === "1") {
            fixBlock.style.display = "block";
            notFixBlock.style.display = "none";
        } else {
            fixBlock.style.display = "none";
            notFixBlock.style.display = "block";
        }
    }

    radios.forEach((radio) => radio.addEventListener("change", toggleBlocks));
    toggleBlocks();

    return { startDatePicker, endDatePicker };
}
