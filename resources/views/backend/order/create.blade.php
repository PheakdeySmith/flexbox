<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Order</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createOrderForm" action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="movie_id">Movie</label>
                        <select class="form-control" id="movie_id" name="movie_id" required>
                            <option value="" disabled selected>Select a movie</option>
                            @foreach ($movies ?? [] as $movie)
                                <option value="{{ $movie->id }}" data-price="{{ $movie->price }}">
                                    {{ $movie->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control" id="price" name="price" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const movieSelect = document.getElementById("movie_id");
        const priceInput = document.getElementById("price");

        movieSelect.addEventListener("change", function() {
            const selectedOption = movieSelect.options[movieSelect.selectedIndex];
            const price = selectedOption.getAttribute("data-price");
            priceInput.value = price; // Set the price input field
        });
    });
</script>
