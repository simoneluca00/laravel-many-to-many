const deleteForms = document.querySelectorAll('.deleteForm');
console.log(deleteForms)

deleteForms.forEach(form => {
    
    const title = form.getAttribute('data-name');

    form.addEventListener('submit', (el)=> {
        el.preventDefault();

        const accept = confirm(`Sei sicuro di eliminare ${title}?`);

        if (accept) {
            el.target.submit();
        }
    })
});