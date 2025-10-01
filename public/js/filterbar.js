document.addEventListener("DOMContentLoaded", function () {
    const filterButton = document.getElementById("filterButton");
    const filterDropdown = document.getElementById("filterDropdown");
    const resetBtn = document.getElementById("resetBtn");
    const main = document.querySelector("main");
    let backdiv = null;

    const openDropdown = () => {
        filterDropdown.classList.remove("hidden");
        filterButton.classList.add("border", "border-custom-light-purple");
        createBackDiv();
    };

    const closeDropdown = () => {
        filterDropdown.classList.add("hidden");
        filterButton.classList.remove("border", "border-custom-light-purple");
        removeBackDiv();
    };

    const createBackDiv = () => {
        if (!backdiv) {
            backdiv = document.createElement("div");
            backdiv.id = "back-div";
            backdiv.style =
                "position: fixed; width: 100%; height: 100%; top: 0; background-color: var(--color-custom-blue); opacity: 0.9;";
            main.appendChild(backdiv);

            backdiv.addEventListener("click", closeDropdown);
        }
    };

    const removeBackDiv = () => {
        if (backdiv) {
            backdiv.remove();
            backdiv = null;
        }
    };

    const resetForm = () => {
        const form = document.getElementById("filterbar");
        form.reset();

        form.querySelectorAll("select").forEach(
            (select) => (select.selectedIndex = 0)
        );

        form.querySelectorAll("input[type=checkbox]").forEach(
            (checkbox) => (checkbox.checked = false)
        );

        closeDropdown();

        window.location.href = "/dashboard/events";
    };

    filterButton.addEventListener("click", () => {
        if (filterDropdown.classList.contains("hidden")) {
            openDropdown();
        } else {
            closeDropdown();
        }
    });

    resetBtn.addEventListener("click", resetForm);

    document.addEventListener("click", (e) => {
        if (
            !filterDropdown.contains(e.target) &&
            !filterButton.contains(e.target)
        ) {
            closeDropdown();
        }
    });
});
