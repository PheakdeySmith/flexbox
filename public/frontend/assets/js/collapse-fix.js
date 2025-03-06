// Bootstrap collapse fix script
document.addEventListener('DOMContentLoaded', function() {
    // Add a small delay to ensure our code runs after any Bootstrap initialization
    setTimeout(function() {
        // Direct solution for the filter button
        const filterButton = document.querySelector('[data-bs-target="#filter"]');
        const filterElement = document.getElementById('filter');

        if (filterButton && filterElement) {
            // Remove bootstrap data attributes to disable default behavior
            filterButton.removeAttribute('data-bs-toggle');
            filterButton.removeAttribute('data-bs-target');

            // Initialize state
            let isFilterOpen = false;

            // Remove any existing click listeners
            const newFilterButton = filterButton.cloneNode(true);
            filterButton.parentNode.replaceChild(newFilterButton, filterButton);

            // Set up the click handler on the new button
            newFilterButton.addEventListener('click', function(e) {
                // Prevent any default actions
                e.preventDefault();
                e.stopPropagation();

                // Toggle state
                isFilterOpen = !isFilterOpen;

                // Update UI based on state
                if (isFilterOpen) {
                    filterElement.classList.add('show');
                    this.setAttribute('aria-expanded', 'true');
                } else {
                    filterElement.classList.remove('show');
                    this.setAttribute('aria-expanded', 'false');
                }
            });

            console.log('Filter collapse fix applied');
        } else {
            console.log('Filter collapse elements not found');
        }
    }, 100); // Small delay of 100ms
});
