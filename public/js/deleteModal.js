function openDeleteModal(id) {
    const modal = document.getElementById("confirmDeleteModal-" + id);
    modal.classList.remove("hidden");
    modal.classList.add("flex");
}

function closeDeleteModal(id) {
    const modal = document.getElementById("confirmDeleteModal-" + id);
    modal.classList.remove("flex");
    modal.classList.add("hidden");
}

function submitDeleteForm(id) {
    document.getElementById("deleteForm-" + id).submit();
}

document.querySelectorAll(".modal-overlay").forEach((overlay) => {
    overlay.addEventListener("click", function (e) {
        if (!e.target.closest(".modal-box")) {
            const modalId = this.id.replace("confirmDeleteModal-", "");
            closeDeleteModal(modalId);
        }
    });
});
