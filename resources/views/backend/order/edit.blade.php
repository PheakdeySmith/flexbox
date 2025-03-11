<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Order</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editOrderForm" method="POST">
                @csrf
                @method('POST') <!-- Changed PUT to POST for compatibility -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_movie_id">Movie</label>
                        <select class="form-control" id="edit_movie_id" name="movie_id" required>
                            <option value="" disabled>Select a movie</option>
                            @foreach ($movies ?? [] as $movie)
                                <option value="{{ $movie->id }}" data-price="{{ $movie->price }}"
                                    {{ $order->movie_id == $movie->id ? 'selected' : '' }}>
                                    {{ $movie->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_price">Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control" id="edit_price" name="price" value="{{ $order->price }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('#editModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            const orderId = button.data('id');
            const movieId = button.data('movie_id');
            const price = button.data('price');

            const modal = $(this);
            modal.find('#editOrderForm').attr('action', `/backend/order/${orderId}`); // Adjusted endpoint
            modal.find('#edit_movie_id').val(movieId);
            modal.find('#edit_price').val(price);
        });

        $('#edit_movie_id').on('change', function () {
            const selectedOption = $(this).find(':selected');
            $('#edit_price').val(selectedOption.data('price'));
        });
    });
</script>