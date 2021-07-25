import {handleInputErrors, handleButtonSpinner, addClasses, removeClasses} from '../components/helpers.js';

export default class Form {

    constructor(button, message, spinner, form) {
        this.spinner = spinner;
        this.button = button;
        this.message = message;
        this.form = form;
    }

    submit(onSuccess = null) {
        this.button.setAttribute('disabled', true);
        removeClasses(this.spinner, ['d-none']);
        this.message.classList.contains('d-none') ? '' : removeClasses(this.message, ['d-none']);
        fetch(this.form.getAttribute('data-action'), {method: this.form.getAttribute('method'), headers: {}, body: new FormData(this.form)}).then(data => data.json()).then(response => {
            this.handle(response, onSuccess);
        }).catch(error => {
            handleButtonSpinner(this.button, this.spinner);
            alert('Network Error. Try Again');
        });
    }

    handle(response, onSuccess) {
        if (response.status === 0 && response.field === '') {
            handleButtonSpinner(this.button, this.spinner);
            removeClasses(this.message, ['d-none', 'alert-success']);
            addClasses(this.message, ['alert-danger']);
            this.message.innerHTML = response.info;

        }else if(response.status === 0 && response.field !== ''){
            handleButtonSpinner(this.button, this.spinner);
            handleInputErrors(document.querySelector(`.${response.field}`), document.querySelector(`.${response.field}-error`), response.info);

        } else if (response.status === 1 && response.field === '') {
            handleButtonSpinner(this.button, this.spinner);
            removeClasses(this.message, ['d-none', 'alert-danger']);
            addClasses(this.message, ['alert-success']);
            this.message.innerHTML = response.info;
            onSuccess();

        } else {
            handleButtonSpinner(this.button, this.spinner);
            alert('Network Error. Try Again');
        }
    }

}