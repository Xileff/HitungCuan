// const imgOverlay = document.querySelectorAll('.img-overlay')[0];
const containerInputImage = document.querySelector('#containerInputImage');
const inputImg = document.querySelector('#inputImg');
const imgPreview = document.querySelector('#imgPreview');

containerInputImage.addEventListener('click', () => {
    // jika imgPreview diclick, akan trigger click ke profileImage
    inputImg.click();
});

inputImg.addEventListener('change', (evt) => {
    // evt = PointerEvent
    // evt.target = elemen imgInputnya. ekuivalen dengan function(){...this}
    const img = evt.target.files[0];
    if(!img) return;
    const reader = new FileReader();
    reader.onload = (evt) => imgPreview.setAttribute('src', evt.target.result);
    reader.readAsDataURL(img);
});