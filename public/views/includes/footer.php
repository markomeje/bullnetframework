<!-- Jquery -->
<script src="<?= PUBLIC_URL; ?>/jquery/jquery.min.js" type="text/javascript"></script>
<!-- Popper -->
<script src="<?= PUBLIC_URL; ?>/bootstrap/popper.min.js" type="text/javascript"></script>
<!-- Bootstrap JS -->
<script src="<?= PUBLIC_URL; ?>/bootstrap/bootstrap.min.js" type="text/javascript"></script>
<!-- general -->
<script src="<?= PUBLIC_URL; ?>/js/general.js" type="text/javascript"></script>
<!-- LoGIN JS -->
<script src="<?= PUBLIC_URL; ?>/js/login.js" type="text/javascript"></script>
<!-- banks JS -->
<script src="<?= PUBLIC_URL; ?>/js/banks.js" type="text/javascript"></script>
<!-- articles JS -->
<script src="<?= PUBLIC_URL; ?>/js/articles.js" type="text/javascript"></script>
<!-- signup JS -->
<script src="<?= PUBLIC_URL; ?>/js/signup.js" type="text/javascript"></script>
<!-- cashiers JS -->
<script src="<?= PUBLIC_URL; ?>/js/cashiers.js" type="text/javascript"></script>
<!-- withdrawals JS -->
<script src="<?= PUBLIC_URL; ?>/js/withdrawals.js" type="text/javascript"></script>
<!-- deposits JS -->
<script src="<?= PUBLIC_URL; ?>/js/deposits.js" type="text/javascript"></script>
<!-- machines JS -->
<script src="<?= PUBLIC_URL; ?>/js/machines.js" type="text/javascript"></script>
<!-- branches JS -->
<script src="<?= PUBLIC_URL; ?>/js/branches.js" type="text/javascript"></script>
<!-- products JS -->
<script src="<?= PUBLIC_URL; ?>/js/products.js" type="text/javascript"></script>
<!-- recharges JS -->
<script src="<?= PUBLIC_URL; ?>/js/recharges.js" type="text/javascript"></script>
<!-- capitals JS -->
<script src="<?= PUBLIC_URL; ?>/js/capitals.js" type="text/javascript"></script>
<!-- Summernote -->
<script src="<?= PUBLIC_URL; ?>/summernote/summernote-bs4.min.js" type="text/javascript"></script>
<!-- password JS -->
<script src="<?= PUBLIC_URL; ?>/js/password.js" type="text/javascript"></script>
<script type="text/javascript">
	var addArticle = $('#add-article-content');
	if (addArticle) {
		addArticle.summernote({
	        tabsize: 4,
	        height: 600
	    });
	}

	<?php if(!empty($article)): ?>
        var editArticle = $('#edit-article-content');
        if (editArticle) {
        	editArticle.summernote({
		        tabsize: 4,
		        height: 600
		    });
        }
    <?php endif; ?>

    <?php if(!empty($allArticles)): ?>
    	<?php foreach($allArticles as $article): ?>
    		<?php $articleid = empty($article->id) ? 0 : $article->id; ?>
	    	var addPostImageButton = $('.add-article-image-<?= $articleid; ?>');
		    if (addPostImageButton) {
		    	addPostImageButton.click(function(event) {
		    		if (confirm('Are Your Sure To Change Article Image')) {
			    		var articleid = $(this).attr('data-id');
			    		var uploadInput = $('.article-image-input-'+articleid);
			    		var loader = $('.add-article-image-loader-'+articleid);
			    		console.log(uploadInput);
			    		console.log(loader);

			            uploadInput.trigger('click');
				        uploadInput.change(function(event) {
				    		loader.removeClass('d-none').fadeIn();
				    	    var files = event.target.files
				    		var formData = new FormData();
				    		formData.append('blogimage', files[0]);

				    		var request = $.ajax({
					            method: 'post',
					            url: uploadInput.attr('data-url'),
					            data: formData,
					            processData: false,
					            contentType: false,
					            dataType: 'json'
					        });

					        request.done(function(response){
					        	if (response.status === 1) {
					        		var imagePreview = $('.article-image-preview-'+articleid);
						            imagePreview.file = files[0];    
						            var reader = new FileReader();
						            reader.onload = (function(picture) { 
						                return (function(event) { 
						                    picture.attr('src', event.target.result);
						                    loader.addClass('d-none').fadeOut(); 
						                });
						            })(imagePreview);
						            reader.readAsDataURL(files[0]);
					        	}else {
					        		loader.addClass('d-none').fadeOut();
					        		alert(response.info);
					        	}
					        });

					        request.fail(function(response) {
					        	loader.addClass('d-none').fadeOut();
					        	alert('Network Error. Try Again');
					        });
				    	});
				    }
		        });
		    }
		<?php endforeach; ?>
	<?php endif; ?>
</script>
</html>
