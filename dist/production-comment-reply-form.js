(function () {
    'use strict';

    const replyButtons = document.querySelectorAll('.comment-reply-button');
    document.querySelectorAll('.comment-reply-form');

    replyButtons.forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            // hide all forms
            const commentForm = item.nextElementSibling;
            commentForm.classList.toggle('hidden');
            if (e.target.innerHTML === "Reply") {
                e.target.innerHTML = "Close form";
            } else {
                e.target.innerHTML = "Reply";
            }
        });
    });

})();
