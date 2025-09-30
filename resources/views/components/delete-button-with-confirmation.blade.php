@props([
'route',
'id',
'name'
])

<link rel="stylesheet" href="{{ asset('css/delete-button-with-confirmation.css') }}">


<form id="deleteForm-{{ $id }}" method="POST" action="{{ $route }}" class="delete-form">
  @csrf
  @method('delete')
  <button type="button"
    onclick="openDeleteModal('{{ $id }}')"
    class="delete-button">
    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
      <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
    </svg>
  </button>
</form>

<!-- Modal -->
<div id="confirmDeleteModal-{{ $id }}" class="modal-overlay">
  <div class="modal-box">
    <h3 class="modal-title">Confirmation de suppression</h3>
    <p class="modal-text">Êtes-vous sûr de vouloir supprimer : <strong>{{ $name }}</strong> ?</p>
    <div class="modal-actions">
      <button type="button" onclick="closeDeleteModal('{{ $id }}')" class="btn btn-cancel">Annuler</button>
      <button type="button" onclick="submitDeleteForm('{{ $id }}')" class="btn btn-confirm">Confirmer</button>
    </div>
  </div>
</div>


<style>

</style>
<script src="{{ asset('js/deleteModal.js') }}"></script>