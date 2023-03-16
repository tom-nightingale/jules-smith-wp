const filters = document.querySelectorAll('.book-filter');
const books = document.querySelectorAll('.book-link');


const resetActiveState = (savedFilter) => {
    filters.forEach((filter) => {
        if(filter.dataset.category !== savedFilter) {
            filter.classList.remove('active');
            filter.classList.add('inactive');
        }
        else {
            filter.classList.remove('inactive');
            filter.classList.add('active');
        }
    });
}

const startFilters = (savedFilter) => {
    books.forEach((book) => {
        book.classList.add('hidden');
        let slug;
        if(savedFilter) {
            slug = savedFilter;
        }
        else {
            slug = filters[0].dataset.category;
        }
        if(book.dataset.category === slug) {
            book.classList.remove('hidden');
        }
    })
}

const savedFilter = localStorage.getItem('activeCategory');

// console.log(localStorage.getItem('activeCategory') === null);
if(savedFilter === null) {
    console.log('activeFilters is null');
    filters[0].classList.remove('inactive');
    filters[0].classList.add('active');
}
else {
    resetActiveState(savedFilter);
    startFilters(savedFilter);
}


filters.forEach((filter) => {
    filter.addEventListener('click', (e) => {
        e.preventDefault();
        const slug = filter.dataset.category;
        
        // console.log(slug);
        // Store in localStorage
        localStorage.setItem('activeCategory', slug);
        // console.log(localStorage.getItem('activeCategory'));

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
