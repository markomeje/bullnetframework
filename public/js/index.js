import Form from './components/form.js';


document.addEventListener('DOMContentLoaded', () => {
	
	const preloader = document.querySelector('.preloader');
	if(preloader){
		setTimeout(() => {
           preloader.style.display = 'none';
		}, 100);
	}

	const loginForm = document.querySelector('.login-form');
	if (loginForm) {
		loginForm.addEventListener('submit', (event) => {
			(new Form(document.querySelector('.login-button'), document.querySelector('.login-message'), document.querySelector('.login-spinner'), loginForm)).submit(() => {
				window.location.reload();
			});
		});
	}

	const backendSidebar = document.querySelector('.backend-sidebar');
	if (backendSidebar) {
        const backendNavigationMenuCloseIcon = document.querySelector('.backend-navigation-menu-close-icon');
		const backendNavigationMenuIcon = document.querySelector('.backend-navigation-menu-icon');
		if (backendNavigationMenuIcon) {
			backendNavigationMenuIcon.addEventListener('click', (event) => {
				backendSidebar.classList.remove('d-none');
				backendSidebar.classList.add('backend-sidebar-toggle');
			});
		}

		if (backendNavigationMenuCloseIcon) {
			backendNavigationMenuCloseIcon.addEventListener('click', (event) => {
				backendSidebar.classList.remove('backend-sidebar-toggle');
				backendSidebar.classList.add('d-none');
			});
		}
	}

	const processForm = document.querySelector('.process-password-reset-form');
	if (processForm) {
		processForm.addEventListener('submit', (event) => {
			(new Form(document.querySelector('.process-password-reset-button'), document.querySelector('.process-password-reset-message'), document.querySelector('.process-password-reset-spinner'), processForm)).submit(() => {
				alert('Success');
			});
		});
	}

	const button = document.querySelector('.upload-button');
	const upload = document.querySelector('.upload-input');
	if (button && upload) {
		button.addEventListener('click', (event) => {
			upload.click();
		});

		upload.addEventListener('change', (event) => {
		    const files = event.target.files
			const formData = new FormData();
			formData.append('upfile', files[0]);

			var image = document.querySelector('.profile-picture');            
            image.file = files[0];    
            var reader = new FileReader();
            reader.onload = ((picture) => { 
                return ((event) => { 
                    picture.src = event.target.result; 
                }); 
            })(image);
            reader.readAsDataURL(files[0]);
			fetch(button.getAttribute('data-url'), {method: 'post', body: formData}).then(response => response.json()).then(data => { 
				console.log(data);
			});
		});
	}

	const addCategory = document.querySelector('.add-category-form');
	if (addCategory) {
		addCategory.addEventListener('submit', (event) => {
			(new Form(document.querySelector('.add-category-button'), document.querySelector('.add-category-message'), document.querySelector('.add-category-spinner'), addCategory)).submit(() => {
				window.location.reload();
			});
		});
	}

	const editCategory = document.querySelector('.edit-category-form');
	if (editCategory) {
		editCategory.addEventListener('submit', (event) => {
			(new Form(document.querySelector('.edit-category-button'), document.querySelector('.edit-category-message'), document.querySelector('.edit-category-spinner'), editCategory)).submit(() => {
				window.location.href = editCategory.getAttribute('data-redirect');
			});
		});
	}

	const deleteCategories = document.querySelectorAll('.delete-category');
	if (deleteCategories) {
		deleteCategories.forEach((category, index) => {
			category.addEventListener('click', (event) => {
				if (confirm('Are You Sure To Delete?')) {
					fetch(category.getAttribute('data-url'), {method: 'post', headers: {}}).then(data => data.json()).then(response => {
			            response.status === 1 ? window.location.reload() : alert(response.info);
			        }).catch(error => {
			            alert(response.info);
			        });
				}
			});
		});
	}

});
    
