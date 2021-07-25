export const addClasses = (element, classes) => {
    if (element.length || element !== undefined) {
        classes.forEach((className) => {
            element.classList.add(className);
        });
    }
}

export const removeClasses = (element, classes) => {
    if (element.length || element !== undefined) {
        classes.forEach((className) => {
            element.classList.remove(className);
        });
    }
}

export const handleButtonSpinner = (button, spinner) => {
    button.hasAttribute('disabled') ? button.removeAttribute('disabled') : button.setAttribute('disabled', true);
    spinner.classList.toggle('d-none');
}

export const handleInputErrors = (input, span, message = '') => {
    input.classList.add('is-invalid');
    span.innerHTML = message;
    input.onfocus = () => {
        input.classList.remove('is-invalid');
        span.innerHTML = '';
    };
}

export const isEmptyObject = (object) => {
    return object && Object.keys(object).length === 0 && object.constructor === Object;
}