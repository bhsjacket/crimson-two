<?php if( $_COOKIE['newsletter-popup'] !== 'true' ) {
    setcookie( 'newsletter-popup', 'true', strtotime('+2 days') ); ?>

<div class="popup hidden">
    <div class="email-popup">
        <i class="far fa-times close-popup"></i>
        <?php echo file_get_contents( get_template_directory() . '/assets/newsletter-animated.svg' ); ?>
        <h2 class="email-heading">Subscribe to our newsletter</h2>
        <p class="email-description">Our biweekly newsletter includes a curated selection of the best student journalism produced by the <em>Jacket</em>.</p>
        <form class="email-form" target="_blank" action="https://bhsjacket.us20.list-manage.com/subscribe/post?u=cd770a9475cd688fc6dcac8f1&id=43ce4620e7" method="POST">
            <input type="email" name="EMAIL" placeholder="Enter email address">
            <!-- Spam Protection -->
            <div style="position: absolute; left: -5000px;" aria-hidden="true">
                <input type="text" name="b_cd770a9475cd688fc6dcac8f1_43ce4620e7" tabindex="-1" value="">
            </div>
            <button class="button">Sign up</button>
        </form>
    </div>
</div>

<script>
    (()=>{

    var popup = document.querySelector('.popup'),
        popupBody = popup.querySelector('.email-popup'),
        animatedIcon = document.getElementById('animated-newsletter-icon');

    setTimeout( () => {
        popup.classList.remove('hidden');
    }, 3000)

    setTimeout( () => {
        animatedIcon.classList.remove('not-animated');
    }, 4000 )

    popup.querySelector('.close-popup').addEventListener('click', () => {
        popup.classList.add('hidden');
    })

    })();
</script>

<?php } ?>