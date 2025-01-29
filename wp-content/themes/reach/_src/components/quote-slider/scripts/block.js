/* eslint-disable */

window.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.quote-slider');

    [...items].forEach((item) => {
        const ajaxurl = `${window.location.origin}/wp-admin/admin-ajax.php`;

        const requestData = new URLSearchParams({
            action: 'get_quotes',
        });

        fetch(ajaxurl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: requestData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data && Array.isArray(data.data)) {
                    const reviews = data.data;
                    let currentIndex = 0;

                    const totalRating = reviews.reduce((sum, review) => sum + parseFloat(review.review.rating), 0);
                    const averageRating = (totalRating / reviews.length).toFixed(1);
                    const averageStarRating = '⭐'.repeat(Math.round(averageRating));

                    const updateQuoteSlider = () => {
                        const { review } = reviews[currentIndex];
                        const fullText = review.text;
                        const text = `${fullText.split('.')[0]}.`;
                        const name = review.author_name;
                        const { rating } = review;
                        const starRating = '⭐'.repeat(parseInt(rating));

                        // Use `item.querySelector()` instead of `document.querySelector()`
                        item.querySelector('.quote-slider__quote').classList.add('fade-out');
                        setTimeout(() => {
                            item.querySelector('.quote-slider__quote').classList.remove('fade-out');
                            item.querySelector('.quote-slider__text').innerHTML = `"${text}"`;
                            item.querySelector('.quote-slider__title').innerHTML = name;
                            item.querySelector('.quote-slider__rating').innerHTML = starRating;
                            currentIndex = (currentIndex + 1) % reviews.length;
                        }, 500);
                    };

                    updateQuoteSlider();
                    setInterval(updateQuoteSlider, 3000);

                    // Update the average rating inside each `.quote-slider`
                    item.querySelector('.quote-slider__review-average').innerHTML = averageRating + averageStarRating;
                } else {
                    console.error('Invalid data structure:', data);
                }
            })
            .catch((error) => {
                console.error('Fetch Error:', error);
            });
    });
});
