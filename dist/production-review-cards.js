(function () {
    'use strict';

    const reviewCardButtons = document.querySelectorAll('.review-card-button');
    const closeButtons = document.querySelectorAll('.close-modal');
    const reviewContainers = document.querySelectorAll('.review-container');
    reviewCardButtons.forEach((button) => {
        button.addEventListener('click', (e) => {
            console.log(e);
            const reviewContainer = button.nextElementSibling;
            reviewContainer.classList.remove('opacity-0', 'invisible', 'pointer-events-none');
        });
    });

    closeButtons.forEach((button) => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            reviewContainers.forEach((container) => {
                container.classList.add('opacity-0', 'invisible', 'pointer-events-none');
            });
        });
    });

})();
