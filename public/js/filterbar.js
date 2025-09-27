document.addEventListener("DOMContentLoaded", function () {
    const filterButton = document.getElementById("filterButton");
    const filterDropdown = document.getElementById("filterDropdown");
    const resetBtn = document.getElementById("resetBtn");
    const main = document.querySelector("main");
    let backdiv;

    // Toggle dropdown
    filterButton.addEventListener("click", function (e) {
        filterDropdown.classList.toggle("hidden");
        filterButton.classList.toggle("border");
        filterButton.classList.toggle("border-custom-light-purple");

        if (!filterDropdown.classList.contains("hidden")) {
            backdiv = document.createElement("div");
            backdiv.id = "back-div";
            backdiv.style =
                "position: fixed;  width: 100%; height: 100%; top: 0%; background-color: #182946; opacity: 90%;";
            main.appendChild(backdiv); // <- ici
        } else if (backdiv) {
            backdiv.remove();
        }
    });

    // Click outside closes dropdown
    document.addEventListener("click", function (e) {
        if (
            !filterDropdown.contains(e.target) &&
            !filterButton.contains(e.target)
        ) {
            filterDropdown.classList.add("hidden");
            filterButton.classList.remove(
                "border",
                "border-custom-light-purple"
            );
            if (backdiv) backdiv.remove();
        }
    });
    backdiv.addEventListener("click", () => {
        filterDropdown.classList.add("hidden");
        filterButton.classList.remove("border", "border-custom-light-purple");
        backdiv.remove();
    });

    // Reset form
    resetBtn.addEventListener("click", function () {
        const form = document.getElementById("filterbar");
        form.reset();
    });

    // Auto-submit on select change
    const form = document.getElementById("filterbar");
    const formElements = form.querySelectorAll("select, input[type=date]");
    formElements.forEach((el) => {
        el.addEventListener("change", function () {
            form.submit();
        });
    });
});
