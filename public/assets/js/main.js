
const form = document.getElementById('form-delete');

const destroyModal = document.getElementById('destroyModal');
destroyModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const curriculum = button.dataset.curriculum; //getAttribute('data-peinado');
    const href = button.dataset.href;
    form.action = href;
    destroyModalContent.textContent = `¿Seguro que quieres eliminar el CV de ${curriculum}?`;
});

/*
const aDestroys = document.querySelectorAll('.link-destroy');
aDestroys.forEach(item => {
    item.addEventListener('click', () => {
        console.log('a href clicked:', item.dataset.href);
        if(confirm('¿Seguro que quieres borrar el peinado ' + item.dataset.curriculum + '?')) {
            form.action = item.dataset.href;
            form.submit();
        }
    });
});*/
