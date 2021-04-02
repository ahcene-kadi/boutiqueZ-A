<?php $this->view("header", $data); ?>

<section id="form" style="margin-top:5px;">
	<!--form-->
	<div class="container">
		<div class="row" style="text-align: center;">

			<span style="font-size:18px;color:red;"><?php check_error() ?></span>

			<div class="col-sm-4 col-sm-offset-1" style="float: none;display: inline-block;">
				<div class="login-form">
					<!--login form-->
					<h2>Connectez-vous a votre compte</h2>
					<form method="post">
						<input name="email" <?= isset($_POST['email']) ? $_POST['email'] : ''; ?> type="email" placeholder="Adresse Email" />
						<input name="password" <?= isset($_POST['password']) ? $_POST['password'] : ''; ?> type="password" placeholder="Mot de passe" />
						<span>
							<input type="checkbox" class="checkbox">
							Keep me signed in
						</span>
						<button type="submit" class="btn btn-default">Valider</button>
					</form>
					</br>
					<a href="<?= ROOT ?>signup">Vous n'avez pas de compte? Inscrivez-vous ici<a>
				</div>
				<!--/login form-->
			</div>

		</div>
	</div>
</section>
<!--/form-->

<?php $this->view("footer", $data); ?>