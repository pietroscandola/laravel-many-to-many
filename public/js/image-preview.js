const placeholder = "https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png?w=640";
const imageInput = document.getElementById('image');
const imagePreview = document.getElementById('preview');

imageInput.addEventListener('change', e => {
    const url = imageInput.value;
    if (url) imagePreview.setAttribute('src', url);
    else imagePreview.setAttribute('src', placeholder);
})