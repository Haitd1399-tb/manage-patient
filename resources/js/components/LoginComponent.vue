<template>
      <div id="app">
				<div class="container">
						<div class="row justify-content-center">
								<div class="col-md-8">
										<div class="card">
												<div class="card-header"></div>
												<div class="card-body">
														<form method="POST" action="">
																<div class="row mb-3">
																		<label for="username" class="col-md-4 col-form-label text-md-end">Tài khoản</label>

																		<div class="col-md-6">
																				<input id="username" type="text" class="form-control " name="username" value="" required autocomplete="username" autofocus>
																		</div>
																</div>

																<div class="row mb-3">
																		<label for="password" class="col-md-4 col-form-label text-md-end">Mật khẩu</label>

																		<div class="col-md-6">
																				<input id="password" type="password" class="form-control" name="password" required autocomplete="password">
																		</div>
																</div>

																<div class="row mb-3">
																		<div class="col-md-6 offset-md-4">
																				<div class="form-check">
																						<input class="form-check-input" type="checkbox" name="remember" id="remember">
																						<label class="form-check-label" for="remember">
																							Ghi nhớ mật khẩu
																						</label>
																				</div>
																		</div>
																</div>

																<div class="row mb-0">
																		<div class="col-md-8 offset-md-4">
																				<button type="submit" class="btn btn-primary">
																				</button>
																		</div>
																</div>
														</form>
												</div>
										</div>
								</div>
						</div>
				</div>
      </div>
</template>

<script>
export default {
  
}
</script>

<style scoped>

</style>