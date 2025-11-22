<?php

get_header();

?>


<main id="content" class="site-content single single-page">
    <h1 style="text-align: center; padding: 50px 0; background-color: #15423b17;margin-bottom: 50px;"><?= get_the_title() ?></h1>
    <div class="site-content-inner p-0">
        <?php the_content(); ?>
    </div>
</main>


<?php

get_footer();
