const filters = document.querySelectorAll('.book-filter');
const books = document.querySelectorAll('.book-link');

//set the first filter as active
filters[0].classList.remove('inactive');
filters[0].classList.add('active');

const resetActiveState = () => {
    filters.forEach((filter) => {
        filter.classList.remove('active');
        filter.classList.add('inactive');
    });
}

const startFilters = () => {
    books.forEach((book) => {
        book.classList.add('hidden');
        const slug = filters[0].dataset.category;
        if(book.dataset.category === slug) {
            book.classList.remove('hidden');
        }
    })
}

startFilters();

filters.forEach((filter) => {
    filter.addEventListener('click', (e) => {
        e.preventDefault();
        const slug = filter.dataset.category;

        // reset active state
        resetActiveState();

        // Add active state to the correct category
        filter.classList.remove('inactive');
        filter.classList.add('active');

        books.forEach((book) => {
            book.classList.add('hidden');
            if(book.dataset.category === slug) {
                book.classList.remove('hidden');
            }
        });


    });
})
