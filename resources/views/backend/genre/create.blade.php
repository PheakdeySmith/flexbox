<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Genre</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="createGenreForm" action="{{ route('genre.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter genre name" required>
            </div>
            <div class="form-group">
              <label for="slug">Slug</label>
              <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter genre slug" required>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
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
    const nameInput = document.querySelector('#modal-lg #name');
    const slugInput = document.querySelector('#modal-lg #slug');

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
  });
</script>
