<div class="footer">
    <div class="container clearfix">
        <?php tfuse_footer();?>
        <?php if(tfuse_options('enable_footer_newsletter')):?>
            <div class="col-md-4 f_col f_col_4">
                <!-- newsletter widget -->
                <div class="widget-container newsletter_subscription_box newsletterBox">
                    <h3 class="widget-title"><?php echo tfuse_options('footer_news_title'); ?></h3>

                <div class="newsletter_subscription_messages before-text">
                    <div class="newsletter_subscription_message_initial">
                        <?php _e('','tfuse') ?>
                    </div>
                    <div class="newsletter_subscription_message_success">
                        <?php _e('Thank you for your subscribtion.','tfuse') ?>
                    </div>
                    <div class="newsletter_subscription_message_wrong_email">
                        <?php _e('Your email format is wrong!','tfuse') ?>
                    </div>
                    <div class="newsletter_subscription_message_failed">
                        <?php _e('Sad, but we couldn\'t add you to our mailing list ATM.','tfuse') ?>
                    </div>
                </div>
                    <form action="#" method="post" class="newsletter_subscription_form">
                        <input type="text" value="" name="newsletter" id="newsletter" class="newsletter_subscription_email inputField" placeholder="<?php _e('Your email address','tfuse') ?>" />
                        <button type="submit" class="btn-form newsletter_subscription_submit" value="<?php _e('Send','tfuse') ?>"><span class="icon-caret-right"></span></button>
                        <div class="newsletter_subscription_ajax"> <?php _e('Loading...','tfuse') ?></div>
                        <div class="newsletter_text">
                        <a class="newssetter_subscribe" href="<?php echo tfuse_options('feedburner_url', get_bloginfo_rss('rss2_url'));?>"><?php  _e('I also want to subscribe to the RSS Feed', 'tfuse');?></a>
                        </div>
                    </form>
                </div>
                <!--/ newsletter widget -->
                <?php 
                    $fb = tfuse_options('footer_newsletter_facebook');
                    $tw = tfuse_options('footer_newsletter_twitter');
                    $goo = tfuse_options('footer_newsletter_google');
                    $pin = tfuse_options('footer_newsletter_pinterest');
                ?>
                <div class="footer_social">
                    <?php if(!empty($fb)):?>
                    <a href="<?php echo $fb;?>" class="icon-facebook" target="_blank"><span><?php _e('Facebook','tfuse');?></span></a>
                    <?php endif;?>
                    <?php if(!empty($goo)):?>
                        <a href="<?php echo $goo;?>" class="icon-google-plus" target="_blank"><span><?php _e('Google Plus','tfuse');?></span></a>
                    <?php endif;?>
                    <?php if(!empty($tw)):?>
                        <a href="<?php echo $tw;?>" class="icon-twitter" target="_blank"><span><?php _e('Twitter','tfuse');?></span></a>
                    <?php endif;?>
                    <?php if(!empty($pin)):?>
                        <a href="<?php echo $pin;?>" class="icon-pinterest" target="_blank"><span><?php _e('Pinterest','tfuse');?></span></a>
                    <?php endif;?>
                </div>

            </div>
        <?php endif;?>
    </div>
</div>
<div class="copyright">
    <div class="container">
        <p><?php //echo tfuse_options('footer_copyright');?></p>
    </div>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>