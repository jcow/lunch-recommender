<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
		  <?=form_open('user/login', array(
		  	'class'=>'form-signin'
		  ));?>
		    <h2 class="form-signin-heading">Please sign in</h2>
		    <div class="form-group">
			    <label for="username" class="sr-only">Username</label>
			    <input id="username" name="username" value="<?=set_value('username')?>" class="form-control" placeholder="Username">
			    <?=form_error('username'); ?>
			</div>
		    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		  </form>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>