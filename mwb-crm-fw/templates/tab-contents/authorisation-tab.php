<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the accounts creation page.
 *
 * @link       https://makewebbetter.com
 * @since      1.0.0
 *
 * @package    Mwb_Cf7_Integration_With_Hubspot
 * @subpackage Mwb_Cf7_Integration_With_Hubspot/admin/partials/templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<?php if ( '1' !== get_option( 'mwb-cf7-' . $this->crm_slug . '-crm-connected', false ) ) : ?>

	<section class="mwb-intro">
		<div class="mwb-content-wrap">
			<div class="mwb-intro__header">
				<h2 class="mwb-section__heading">
					<?php echo esc_html__( 'Getting started with CF7 and HubSpot', 'mwb-cf7-integration-with-hubspot' ); ?>
				</h2>
			</div>
			<div class="mwb-intro__body mwb-intro__content">
				<p>
				<?php
				echo sprintf(
					/* translators: %1$s:crm objects */
					esc_html__( 'With this CF7 HubSpot Integration you can easily sync all your Contact Form 7 Submissions data over HubSpot. It will create %1$s over HubSpot, based on your Contact Form 7 Feed data.', 'mwb-cf7-integration-with-hubspot' ),
					esc_html( 'Contacts, Companies, Tickets, Tasks and Forms' ),
				);
				?>
				</p>
				<ul class="mwb-intro__list">
					<li class="mwb-intro__list-item">
						<?php
						echo esc_html__( 'Connect your HubSpot account with CF7.', 'mwb-cf7-integration-with-hubspot' );
						?>
					</li>
					<li class="mwb-intro__list-item">
						<?php
						echo esc_html__( 'Sync your data over HubSpot.', 'mwb-cf7-integration-with-hubspot' );
						?>
					</li>
				</ul>
				<div class="mwb-intro__button">
					<a href="javascript:void(0)" class="mwb-btn mwb-btn--filled" id="mwb-showauth-form">
						<?php esc_html_e( 'Connect your Account.', 'mwb-cf7-integration-with-hubspot' ); ?>
					</a>
				</div>
			</div> 
		</div>
	</section>


	<!--============================================================================================
											Authorization form start.
	================================================================================================-->

	<div class="mwb_cf7_integration_account-wrap <?php echo esc_html( false === get_option( 'mwb-cf7-' . $this->crm_slug . '-crm-connected', false ) ? 'row-hide' : '' ); ?>" id="mwb-cf7-auth_wrap">
		<!-- Logo section start -->
		<div class="mwb-cf7_integration_logo-wrap">
			<div class="mwb-cf7_integration_logo-crm">
				<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_HUBSPOT_URL . 'admin/images/crm.png' ); ?>" alt="<?php esc_html_e( 'HubSpot', 'mwb-cf7-integration-with-hubspot' ); ?>">
			</div>
			<div class="mwb-cf7_integration_logo-contact">
				<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_HUBSPOT_URL . 'admin/images/contact-form.svg' ); ?>" alt="<?php esc_html_e( 'CF7', 'mwb-cf7-integration-with-hubspot' ); ?>">
			</div>
		</div>
		<!-- Logo section end -->

		<!-- Login form start -->
		<form method="post" id="mwb_cf7_integration_account_form">

			<div class="mwb_cf7_integration_table_wrapper">
				<div class="mwb_cf7_integration_account_setup">
					<h2>
						<?php esc_html_e( 'Enter your credentials here', 'mwb-cf7-integration-with-hubspot' ); ?>
					</h2>
				</div>

				<table class="mwb_cf7_integration_table">
					<tbody>
						<div class="mwb-auth-notice-wrap row-hide">
							<p class="mwb-auth-notice-text">
								<?php esc_html_e( 'Connection has been successful ! Validating .....', 'mwb-cf7-integration-with-hubspot' ); ?>
							</p>
						</div>

						<!-- Own app start -->
						<tr>
							<th>
								<label>
									<?php esc_html_e( 'Use own app', 'mwb-cf7-integration-with-hubspot' ); ?>
								</label>

								<?php
								$desc = esc_html__( 'Enable this to use your own HubSpot app credentials to authorize with HubSpot.', 'mwb-cf7-integration-with-hubspot' );
								echo esc_html( $params['admin_class']::mwb_cf7_integration_tooltip( $desc ) );
								?>
							</th>

							<td>
								<input type="checkbox" name="mwb_account[own_app]" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-own-app" value="yes" <?php checked( 'yes', $params['own_app'] ); ?> >
							</td>
						</tr>
						<!-- Own app end -->

						<!-- client Id start  -->
						<tr class="mwb-api-fields">
							<th>							
								<label><?php esc_html_e( 'Client ID', 'mwb-cf7-integration-with-hubspot' ); ?></label>

								<?php
								$desc = esc_html__( 'Enter Client ID from HubSpot', 'mwb-cf7-integration-with-hubspot' );
								echo esc_html( $params['admin_class']::mwb_cf7_integration_tooltip( $desc ) );
								?>
							</th>

							<td>
								<?php
								$client_id = ! empty( $params['client_id'] ) ? sanitize_text_field( wp_unslash( $params['client_id'] ) ) : '';
								?>
								<div class="mwb-cf7-integration__secure-field">
									<input type="password"  name="mwb_account[client_id]" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-client-id" value="<?php echo esc_html( $client_id ); ?>" required placeholder="<?php esc_html_e( 'Enter Client ID', 'mwb-cf7-integration-with-hubspot' ); ?>">
									<div class="mwb-cf7-integration__trailing-icon">
										<span class="dashicons dashicons-visibility mwb-toggle-view"></span>
									</div>
								</div>
							</td>
						</tr>
						<!-- Client id end -->

						<!-- client secret start  -->
						<tr class="mwb-api-fields">
							<th>							
								<label>
									<?php esc_html_e( 'Client Secret', 'mwb-cf7-integration-with-hubspot' ); ?>
								</label>

								<?php
								$desc = esc_html__( 'Enter Client Secret from HubSpot', 'mwb-cf7-integration-with-hubspot' );
								echo esc_html( $params['admin_class']::mwb_cf7_integration_tooltip( $desc ) );
								?>
							</th>

							<td>
								<?php
								$client_secret = ! empty( $params['client_secret'] ) ? sanitize_text_field( wp_unslash( $params['client_secret'] ) ) : '';
								?>
								<div class="mwb-cf7-integration__secure-field">
									<input type="password"  name="mwb_account[client_secret]" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-client-secret" value="<?php echo esc_html( $client_secret ); ?>" required placeholder="<?php esc_html_e( 'Enter Client Secret', 'mwb-cf7-integration-with-hubspot' ); ?>">
									<div class="mwb-cf7-integration__trailing-icon">
										<span class="dashicons dashicons-visibility mwb-toggle-view"></span>
									</div>
								</div>
							</td>
						</tr>
						<!-- Client secret end -->

						<!-- client secret start  -->
						<tr class="mwb-api-fields">
							<th>							
								<label>
									<?php esc_html_e( 'Scopes', 'mwb-cf7-integration-with-hubspot' ); ?>
								</label>

								<?php
								$desc  = esc_html__( 'Enter Scopes from HubSpot. ', 'mwb-cf7-integration-with-hubspot' );
								$desc .= sprintf(
									/* translators: %1$s: scopes %2$s:Scopes */
									esc_html__( 'Kindly select either of the following Scopes </br> 1. %1$s </br> or </br> 2. %2$s. </br> And paste them here seperated by commas.', 'mwb-cf7-integration-with-hubspot' ),
									esc_html( 'oauth contacts' ),
									esc_html( 'oauth crm.objects.contacts.read crm.objects.contacts.write' ),
								);
								echo esc_html( $params['admin_class']::mwb_cf7_integration_tooltip( $desc ) );
								?>
							</th>

							<td>
								<?php
								$scopes = ! empty( $params['scopes'] ) ? sanitize_text_field( wp_unslash( $params['scopes'] ) ) : '';
								?>
								<textarea name="mwb_account[client_secret]" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-scopes" required ><?php echo esc_html( $scopes ); ?></textarea>
							</td>
						</tr>
						<!-- Client secret end -->

						<!-- Redirect uri start -->
						<tr class="mwb-api-fields">
							<th>
								<label>
									<?php esc_html_e( 'Redirect URI', 'mwb-cf7-integration-with-hubspot' ); ?>
								</label>

								<?php
								$desc = esc_html__( 'Web-Protocol must be HTTPS in order to successfully authorize with HubSpot', 'mwb-cf7-integration-with-hubspot' );
								echo esc_html( $params['admin_class']::mwb_cf7_integration_tooltip( $desc ) );
								?>
							</th>

							<td>
								<input type="url" name="mwb_account[redirect_uri]" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-redirect-uri" value="<?php echo esc_html( rtrim( admin_url(), '/' ) ); ?>" readonly >
							</td>
						</tr>
						<!-- redirect uri end -->

						<!-- Save & connect account start -->
						<tr>
							<th>
							</th>
							<td>
								<a href="<?php echo esc_url( wp_nonce_url( admin_url( '?mwb-cf7-integration-perform-auth=1' ) ) ); ?>" class="mwb-btn mwb-btn--filled mwb_cf7_integration_submit_account" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-authorize-button" ><?php esc_html_e( 'Authorize', 'mwb-cf7-integration-with-hubspot' ); ?></a>
							</td>
						</tr>
						<!-- Save & connect account end -->
					</tbody>
				</table>
			</div>
		</form>
		<!-- Login form end -->

		<!-- Info section start -->
		<div class="mwb-intro__bottom-text-wrap">
			<p>
				<?php esc_html_e( 'Don’t have a HubSpot account yet . ', 'mwb-cf7-integration-with-hubspot' ); ?>
				<a href="https://www.hubspot.com/" target="_blank" class="mwb-btn__bottom-text">
					<?php esc_html_e( 'Create A Free Account', 'mwb-cf7-integration-with-hubspot' ); ?>
				</a>
			</p>
			<p class="mwb-api-fields">
				<?php esc_html_e( 'Get Your Api Key here.', 'mwb-cf7-integration-with-hubspot' ); ?>
				<a href="https://app.hubspot.com/signup/developers/" target="_blank" class="mwb-btn__bottom-text"><?php esc_html_e( 'Get Api Keys', 'mwb-cf7-integration-with-hubspot' ); ?></a>
			</p>
			<p >
				<?php esc_html_e( 'Check app setup guide . ', 'mwb-cf7-integration-with-hubspot' ); ?>
				<a href="javascript:void(0)" class="mwb-btn__bottom-text trigger-setup-guide"><?php esc_html_e( 'Show Me How', 'mwb-cf7-integration-with-hubspot' ); ?></a>
			</p>
		</div>
		<!-- Info section end -->
	</div>

<?php else : ?>

	<!-- Successfull connection start -->
	<section class="mwb-sync">
		<div class="mwb-content-wrap">
			<div class="mwb-sync__header">
				<h2 class="mwb-section__heading">
					<?php
					echo esc_html__( 'Congrats! You’ve successfully set up the MWB CF7 Integration with HubSpot Plugin.', 'mwb-cf7-integration-with-hubspot' );
					?>
				</h2>
			</div>
			<div class="mwb-sync__body mwb-sync__content-wrap">            
				<div class="mwb-sync__image">    
					<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_HUBSPOT_URL . 'admin/images/congo.jpg' ); ?>" >
				</div>       
				<div class="mwb-sync__content">            
					<p> 
						<?php
						echo esc_html__( 'Now you can go to the dashboard and check connection data. You can create your feeds, edit them in the feeds tab. If you do not see your data over HubSpot, you can check the logs for any possible error.', 'mwb-cf7-integration-with-hubspot' );
						?>
					</p>
					<div class="mwb-sync__button">
						<a href="javascript:void(0)" class="mwb-btn mwb-btn--filled mwb-onboarding-complete">
							<?php esc_html_e( 'View Dashboard', 'mwb-cf7-integration-with-hubspot' ); ?>
						</a>
					</div>
				</div>             
			</div>       
		</div>
	</section>
	<!-- Successfull connection end -->

<?php endif; ?>
