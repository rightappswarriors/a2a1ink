document.getElementById('download-form').addEventListener('click', function () {
    const fetchForm = document.querySelector('form');
    fetchForm.action = window.appRoutes.downloadForm;

    if(fetchForm.reportValidity()) {
        fetchForm.requestSubmit();
    }
});