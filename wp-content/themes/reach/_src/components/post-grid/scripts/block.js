/* eslint-disable */
document.addEventListener('DOMContentLoaded', function () {
    const ajaxurl = `${window.location.origin}/wp-admin/admin-ajax.php`;

    fetch(ajaxurl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=fetch_posts',
    })
        .then((response) => response.json())
        .then((data) => {
            const posts = data.data;
            const postGrid = document.querySelector('.post-grid__posts');
            const selector = document.querySelector('#post_grid__category');
            const allButton = document.querySelector('.post-grid__all-button');

            showResults(posts);

            selector.addEventListener('change', (e) => {
                const selectedCategory = e.target.value;

                if (selectedCategory === 'all') {
                    showResults(posts);
                    return;
                }

                const filteredPosts = posts.filter((post) => {
                    if (post.category && post.category.length > 0) {
                        return post.category.some(
                            (cat) => cat.name.trim().toLowerCase() === selectedCategory.trim().toLowerCase()
                        );
                    }
                    return false;
                });

                showResults(filteredPosts);
            });

            allButton.addEventListener('click', () => {
                showResults(posts);
            });



        })
        .catch((error) => {
            console.error('Fetch Error:', error);
        });

    function showResults(posts) {
        const postGrid = document.querySelector('.post-grid__posts');

        if (!posts || posts.length === 0) {
            postGrid.innerHTML = '<p>No posts available</p>';
            return;
        }

        const postHTML = posts
            .map((post) => {
                const firstCategory =
                    post.category && post.category.length > 0 ? post.category[0].name : 'Uncategorized';

                    const truncatedTitle = post.title.length > 50 ? post.title.substring(0, 55) + '...' : post.title;

                return `
                <div class="post-grid__item">
                    <div class="post-grid__item__image">
                        ${post.image ? `<img src="${post.image}" alt="${post.title}">` : ''}
                        <div class="post-grid__category">
                            <p>${firstCategory}</p>
                        </div>
                    </div>
                    <div class="post-grid__item__content">
                        <p>${post.date}</p>
                        <h3>${truncatedTitle}</h3>
                        <a href="${post.link}">Read more</a>
                    </div>
                </div>
            `;
            })
            .join('');

        postGrid.innerHTML = `
            <div class="post-grid__grid_container">
                ${postHTML}
            </div>
        `;
    }
});
