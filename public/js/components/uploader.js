import {handleInputErrors, handleButtonSpinner} from '../components/helpers.js';

export default class Uploader {

    constructor(button, message, spinner, url) {
        this.spinner = spinner;
        this.button = button;
        this.message = message;
        this.url = url;
    }

    upload(onSuccess = null) {
        button.addEventListener('click', (event) => {
            upload.click();
        });

        upload.addEventListener('change', (event) => {
            const files = event.target.files
            const formData = new FormData();
            formData.append('upfile', files[0]);

            var image = document.querySelector('.preview');            
            image.file = files[0];    
            var reader = new FileReader();
            reader.onload = ((preview) => { 
                return ((event) => { 
                    preview.src = event.target.result; 
                }); 
            })(image);

            reader.readAsDataURL(files[0]);
            fetch(button.getAttribute('data-url'), {method: 'post', body: formData}).then(response => response.json()).then(data => { 
                console.log(data);
            }).catch(error => {
                alert('Network Error. Try Again');
            });
        });

    }

}