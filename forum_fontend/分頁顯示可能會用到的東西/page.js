document.addEventListener('DOMContentLoaded', () => {
    const paginationLinks = document.querySelectorAll('.pagination a');

    paginationLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const url = e.target.href;

            // Fetch articles dynamically
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('body').innerHTML = html;
                })
                .catch(err => console.error('Error fetching articles:', err));
        });
    });
});
