<h3 class="text-pumpkin mb-3">Contact Form</h3>
					<p class="text-white">Please fill in all fields.</p>
					<div class="border-msugreen p-3 border-raduis-sm">
						<form class="contact-form" action="javascript:;" method="post" autocomplete="off">
							<div class="form-row">
								<div class="form-group input-group-lg col-lg-6">
									<label class="text-white">Firstname</label>
									<input type="text" name="first" class="form-control first" placeholder="e.g., Shola">
								</div>
								<div class="form-group input-group-lg col-lg-6">
									<label class="text-white">Lastname</label>
									<input type="text" name="last" class="form-control last" placeholder="e.g., Bello">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group input-group-lg col-lg-6">
									<label class="text-white">Email</label>
									<input type="email" name="emaill" class="form-control emaill" placeholder="e.g., name@email.com">
								</div>
								<div class="form-group input-group-lg col-lg-6">
									<label class="text-white">Phone</label>
									<input type="number" name="phonenumber" class="form-control phonenumber" placeholder="e.g., +23359098564">
								</div>
							</div>
							<label class="text-white">Message</label>
							<textarea class="form-control message" rows="6" name="message" placeholder="Type Your Message Here."></textarea>
							<button type="submit" class="btn mt-4 btn-lg border-0 bg-pumpkin text-white contact-button">
								<img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none contact-spinner mb-1">
								Send
							</button>
						</form>
					</div>