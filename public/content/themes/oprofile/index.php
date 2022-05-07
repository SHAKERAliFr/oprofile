<?php
get_header();
?>

<body>
    <!------------NAVIGATION HEADER---------->
    <!--------------------------------------->
    <nav class="section main-menu">
        <ul>
            <li><a href="#">Oprofiles</a></li>

            <li>
                <a href="#"><i class="fas fa-id-card"></i> / <i class="fa fa-users"></i></a>
            </li>
            <li>
                <a href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
    <!-------------PREMIERE SECTION--------->
    <!--------------------------------------->
    <section class="section welcome">
        <h1 class="section__title">Bienvenue sur oProfiles</h1>

        <p class="section__content">
            Le site de partage de profils de développeurs Web. Viens toi aussi
            participer à la communauté des oProfilers...
        </p>

        <div class="welcome__cta">
            <a href="">Les profils</a>
            <a href="">Le blog de la communauté</a>
        </div>
    </section>
    <!-------------CAROUSEL------------------>
    <!--------------------------------------->
    <section class="section diaporama">
        <section>
            <h1 class="section__title">Profil de Nicole</h1>
            <h3 class="section-title">Biographie</h3>
            <p class="biography">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea odio,
                ratione saepe, quasi iusto tempora neque obcaecati fuga illo autem
                ullam, nam culpa aliquam! Quaerat explicabo, quo quibusdam ex ducimus
                quod commodi laborum aperiam molestias fuga ipsum corporis neque
                voluptates perferendis vitae dolores animi quae, eius magni atque
                aliquid delectus!
            </p>

            <div class="customer-quotes">
                <h3 class="section-title customer-quotes__title">
                    Quelques retours des clients
                </h3>

                <div class="customer-quotes__container carousel">
                    <p class="customer-quotes__item carousel__item" data-number="0">
                        Lorem1 ipsum dolor sit, amet consectetur adipisicing elit.
                        Recusandae perspiciatis itaque repellat explicabo inventore magni,
                        ipsa non laboriosam molestias vel officiis, minima error
                        architecto. Ad commodi corporis similique? Fugiat, saepe.
                    </p>

                    <p class="customer-quotes__item carousel__item" data-number="1">
                        Lorem2 accusantium illo reiciendis non quis aliquid exercitationem
                        molestiae ipsam, temporibus harum perferendis sit sed minima, qui
                        iste praesentium necessitatibus reprehenderit consectetur? Iure
                        consequatur saepe rem minus reiciendis. Iusto, temporibus.
                    </p>
                    <p class="customer-quotes__item carousel__item" data-number="2">
                        Lorem3 voluptate sed mollitia. Labore voluptatem doloribus minus
                        ullam impedit beatae id veniam aperiam voluptate temporibus, quas
                        praesentium optio? Pariatur doloribus explicabo non enim corrupti
                        voluptatem consequuntur facere impedit maxime!
                    </p>
                </div>

                <div class="customer-quotes__nav carousel__nav">
                    <div class="customer-quotes__nav__bar active carousel__nav__button" data-slide-number="0"></div>

                    <div class="customer-quotes__nav__bar carousel__nav__button" data-slide-number="1"></div>
                    <div class="customer-quotes__nav__bar carousel__nav__button" data-slide-number="2"></div>
                </div>
            </div>
        </section>
    </section>
    <!-----------ARTICLE COMMU--------------->
    <!--------------------------------------->
    <section class="section community">
        <!--Emmet : h1.section__title+div>(article.article>h2.article__title+p.article__excerpt)*5 -->
        <h1 class="section__title">Les articles de la communauté</h1>
        <div>
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    echo get_template_part('partials/article-community', 'article-community');
                }
            }

            ?>

        </div>
    </section>
    <!--------ILS ONT FAIT CONF------------>
    <!--------------------------------------->
    <section class="section">
        <h1 class="section__title">Ils nous font confiance</h1>

        <div>
            <article class="company">
                <h2 class="company__title">Company</h2>
                <p class="company__excerpt">
                    Lorem ipsum dolor sit amet. Quos cumque fuga quibusdam sunt! Vel
                    saepe tempore ducimus cupiditate! Suscipit, nesciunt. Adipisci,
                    dolores aperiam! Similique harum a non tempora!
                </p>
            </article>

            <article class="company">
                <h2 class="company__title">company</h2>
                <p class="company__excerpt">
                    Lorem ipsum dolor sit amet. Quos cumque fuga quibusdam sunt! Vel
                    saepe tempore ducimus cupiditate! Suscipit, nesciunt. Adipisci,
                    dolores aperiam! Similique harum a non tempora!
                </p>
            </article>

            <article class="company">
                <h2 class="company__title">Company</h2>
                <p class="company__excerpt">
                    Lorem ipsum dolor sit amet. Quos cumque fuga quibusdam sunt! Vel
                    saepe tempore ducimus cupiditate! Suscipit, nesciunt. Adipisci,
                    dolores aperiam! Similique harum a non tempora!
                </p>
            </article>

            <article class="company">
                <h2 class="company__title">Company</h2>
                <p class="company__excerpt">
                    Lorem ipsum dolor sit amet. Quos cumque fuga quibusdam sunt! Vel
                    saepe tempore ducimus cupiditate! Suscipit, nesciunt. Adipisci,
                    dolores aperiam! Similique harum a non tempora!
                </p>
            </article>
        </div>
    </section>
    <?php
    get_footer();
    ?>