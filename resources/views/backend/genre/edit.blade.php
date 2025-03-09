<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Genre</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editGenreForm" action="" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" id="edit_id" name="genre_id">
          <div class="modal-body">
            <div class="form-group">
              <label for="edit_name">Name</label>
              <input type="text" class="form-control" id="edit_name" name="name" placeholder="Enter genre name" required>
            </div>
            <div class="form-group">
              <label for="edit_slug">Slug</label>
              <input type="text" class="form-control" id="edit_slug" name="slug" placeholder="Enter genre slug" required>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

<!-- Add slug generation script -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.querySelector('#editModal #edit_name');
    const slugInput = document.querySelector('#editModal #edit_slug');

    if (nameInput && slugInput) {
      nameInput.addEventListener('keyup', function() {
        // Generate slug from name: lowercase and replace spaces with hyphens
        slugInput.value = nameInput.value
          .toLowerCase()
          .replace(/\s+/g, '-')       // Replace spaces with -
          .replace(/[^\w\-]+/g, '')   // Remove all non-word characters
          .replace(/\-\-+/g, '-')     // Replace multiple - with single -
          .replace(/^-+/, '')         // Trim - from start of text
          .replace(/-+$/, '');        // Trim - from end of text
      });
    }

    // Handle edit modal data
    $('#editModal').on('show.bs.modal', function (event) {
      const button = $(event.relatedTarget);
      const id = button.data('id');
      const name = button.data('name');
      const slug = button.data('slug');
      const modal = $(this);

      // Update form action URL
      modal.find('#editGenreForm').attr('action', `/backend/genre/${id}`);

      // Set form values
      modal.find('#edit_id').val(id);
      modal.find('#edit_name').val(name);
      modal.find('#edit_slug').val(slug);
    });
  });
</script>
