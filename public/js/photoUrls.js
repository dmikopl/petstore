function addPhotoUrlField() {
    const container = document.getElementById('photoUrlsContainer');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'photoUrls[]';
    input.placeholder = 'Enter photo URL';
    input.required = true;
    container.appendChild(input);
    container.appendChild(document.createElement('br'));
}