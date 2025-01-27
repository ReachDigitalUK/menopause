/* eslint-disable */
const ajaxurl = `${window.location.origin}/wp-admin/admin-ajax.php`;


const requestData = new URLSearchParams({
    action: 'get_quotes',  // Ensure this matches the action name in your PHP code
});

fetch(ajaxurl, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: requestData,
})
    .then(response => response.json())
    .then(data => {
        // Log the data to ensure it's being returned correctly
        console.log('Data:', data);

        // Check if data contains a `data` property and that it's an array
        if (data && Array.isArray(data.data)) {
            const reviews = data.data; // Extract the reviews array
            let currentIndex = 0; // Start with the first review

            // Calculate average rating
            const totalRating = reviews.reduce((sum, review) => sum + parseFloat(review.review.rating), 0);
            const averageRating = (totalRating / reviews.length).toFixed(1); // Rounded to 1 decimal place

            // Create star representation of average rating
            const averageStarRating = '⭐'.repeat(Math.round(averageRating));

            // Log the average rating and stars for debugging
            console.log('Average Rating:', averageRating);
            console.log('Average Star Rating:', averageStarRating);

            // Function to update the quote slider content
            const updateQuoteSlider = () => {
                const review = reviews[currentIndex].review; // Get the current review
                const fullText = review.text;
                const text = fullText.split('.')[0] + '.'; // Get text up to the first full stop
                const name = review.author_name;
                const rating = review.rating;

                // Turn rating into stars
                const starRating = '⭐'.repeat(parseInt(rating));

                // Add fade-out class
                document.querySelector('.quote-slider__quote').classList.add('fade-out');
                setTimeout(() => {
                    // Update content after fade-out
                    document.querySelector('.quote-slider__quote').classList.remove('fade-out');
                    document.querySelector('.quote-slider__text').innerHTML = `"${text}"`;
                    document.querySelector('.quote-slider__title').innerHTML = name;
                    document.querySelector('.quote-slider__rating').innerHTML = starRating;

                    // Move to the next review (loop back to the start if at the end)
                    currentIndex = (currentIndex + 1) % reviews.length;
                }, 500); // Wait for fade-out transition to complete
            };

            // Start the slider
            updateQuoteSlider(); // Show the first review immediately
            setInterval(updateQuoteSlider, 3000); // Update every 10 seconds

            // Optionally, display the average rating somewhere on the page
            document.querySelector('.quote-slider__review-average').innerHTML = averageRating + averageStarRating;
        } else {
            console.error('Invalid data structure:', data);
        }
    })
    .catch(error => {
        // Log any errors
        console.error('Fetch Error:', error);
    });