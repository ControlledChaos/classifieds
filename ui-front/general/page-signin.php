<?php

global $user_ID, $user_identity, $user_login, $user_email, $userdata;
get_currentuserinfo();

$register = (empty($_GET['register'])) ? '' : $_GET['register'];
$reset = (empty($_GET['reset'])) ? '' : $_GET['reset'];
$redirect = (empty($_GET['redirect_to'])) ? '' : $_GET['redirect_to'];

//mail("abaileytn@gmail.com","Success","Thanks, that works", "From: abailey@webwrights.com\r\n");
?>

<div id="login-register-password">

	<?php if (! $user_ID): ?>

	<ul class="tabs_login">
		<li class="active_login"><a href="#tab1_login"><?php _e('Login', $this->text_domain); ?></a></li>
		<li><a href="#tab2_login"><?php _e('New Account', $this->text_domain); ?></a></li>
		<li><a href="#tab3_login"><?php _e('Forgot?', $this->text_domain); ?></a></li>
	</ul>
	<div class="tab_container_login">

		<div id="tab1_login" class="tab_content_login">
			<?php if ($register == true): ?>

			<h3><?php _e('Success!', $this->text_domain); ?></h3>
			<p><?php _e('Check your email for the password and then return to log in.', $this-text_domain); ?></p>

			<?php elseif($reset == true): ?>

			<h3><?php _e('Success!', $this->text_domain); ?></h3>
			<p><?php _e('Check your email to reset your password.', $this->text_domain); ?></p>

			<?php else: ?>

			<h3><?php _e('Have an account?', $this->text_domain); ?></h3>
			<p><?php _e('You have to login to view the contents of this page.', $this->text_domain); ?></p>
			<p><?php _e('Log in or sign up! It&rsquo;s fast &amp; <em>free!</em>', $this->text_domain); ?></p>

			<?php endif; ?>

			<form method="post" action="<?php bloginfo('url') ?>/wp-login.php" class="wp-user-form">
				<div class="username">
					<label for="user_login"><?php _e('Username', $this->text_domain); ?>: </label>
					<input type="text" name="log" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="11" />
				</div>
				<div class="password">
					<label for="user_pass"><?php _e('Password', $this->text_domain); ?>: </label>
					<input type="password" name="pwd" value="" size="20" id="user_pass" tabindex="12" />
				</div>
				<div class="login_fields">
					<div class="rememberme">
						<label for="rememberme">
							<input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13" /> <?php _e('Remember me', $this->text_domain); ?>
						</label>
					</div>
					<?php do_action('login_form'); ?>
					<input type="submit" name="user-submit" value="<?php _e('Login', $this->text_domain); ?>" tabindex="14" class="user-submit" />
					<input type="hidden" name="redirect_to" value="<?php echo $redirect; ?>" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>
		</div>

		<div id="tab2_login" class="tab_content_login" style="display:none;">
			<h3><?php _e('Register for this site!', $this->text_domain); ?></h3>
			<p><?php _e('Sign up now for the good stuff.', $this->text_domain); ?></p>
			
			<?php if(is_multisite()): ?>
			<form method="post" action="<?php echo site_url('wp-signup.php') ?>" class="wp-user-form">
					<input type="hidden" name="stage" value="validate-user-signup" />
					<?php do_action( 'signup_hidden_fields' ); ?>
					
					<input type="hidden" name="signup_for" value="user" />
				<div class="username">
					<label for="user_name"><?php _e('Username', $this->text_domain); ?>: </label>
					<input type="text" name="user_name" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_name" tabindex="101" />
				</div>
			<?php else:	?>
			<form method="post" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" class="wp-user-form">
				<div class="username">
					<label for="user_login"><?php _e('Username', $this->text_domain); ?>: </label>
					<input type="text" name="user_login" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="101" />
				</div>
			<?php endif; ?>	
				<div class="password">
					<label for="user_email"><?php _e('Your Email', $this->text_domain); ?>: </label>
					<input type="text" name="user_email" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" id="user_email" tabindex="102" />
				</div>
				<div class="login_fields">
					<?php do_action('register_form'); ?>
					<input type="submit" name="user-submit" value="<?php _e('Sign up!', $this->text_domain); ?>" class="user-submit" tabindex="103" />
					<?php if($register == true): ?>
					<p><?php _e('Check your email for the password!', $this->text_domain); ?></p>
					````````````<?php endif; ?>
					<input type="hidden" name="redirect_to" value="<?php echo $redirect; ?>?register=true" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>
		</div>

		<div id="tab3_login" class="tab_content_login" style="display:none;">
			<h3>Lose something?</h3>
			<p>Enter your username or email to reset your password.</p>
			<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
				<div class="username">
					<label for="user_login" class="hide"><?php _e('Username or Email', $this->text_domain); ?>: </label>
					<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
				</div>
				<div class="login_fields">
					<?php do_action('login_form', 'resetpass'); ?>
					<input type="submit" name="user-submit" value="<?php _e('Reset my password', $this->text_domain); ?>" class="user-submit" tabindex="1002" />
					<?php if($reset == true): ?>
					<p><?php _e('A message will be sent to your email address.', $this->text_domain); ?></p>
					<?php endif; ?>
					<input type="hidden" name="redirect_to" value="<?php echo $redirect; ?>?reset=true" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>
		</div>
	</div>

	<?php else: // is logged in ?>

	<div class="sidebox">
		<h3><?php echo sprintf(__('Welcome, %s', $this->text_domain), $user_identity); ?></h3>
		<div class="usericon">
			<?php echo get_avatar($userdata->ID, 60); ?>
		</div>
		<div class="userinfo">
			<p><?php echo sprintf(__('You&rsquo;re logged in as <strong>%s</strong>',$this->text_domain),$user_identity); ?></p>
			<p>
				<a href="<?php echo wp_logout_url('index.php'); ?>"><?php _e('Log out', $this->text_domain); ?></a> |
				<?php if (current_user_can('manage_options')) {
				echo '<a href="' . admin_url() . '">' . __('Admin') . '</a>'; } else {
				echo '<a href="' . admin_url() . 'profile.php">' . __('Profile') . '</a>'; } ?>
			</p>
		</div>
	</div>
	<?php endif; ?>
</div>

<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
			$(".tab_content_login").hide();
			$("ul.tabs_login li:first").addClass("active_login").show();
			$(".tab_content_login:first").show();
			$("ul.tabs_login li").click(function() {
				$("ul.tabs_login li").removeClass("active_login");
				$(this).addClass("active_login");
				$(".tab_content_login").hide();
				var activeTab = $(this).find("a").attr("href");
				$(activeTab).show();
				return false;
			});
		});
	})(jQuery);
</script>
