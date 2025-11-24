<?php get_header(); ?>

<main class="site-main">
    <section class="hero">
        <div class="container">
            <div class="hero__content">
                <h1 class="hero__title"><?php echo get_theme_mod('hero_title', 'Автоматизація майбутнього'); ?></h1>
                <p class="hero__subtitle"><?php echo get_theme_mod('hero_subtitle', 'Ми створюємо цифрові рішення, що працюють на вас. Від чат-ботів до складних CRM систем.'); ?></p>
                <a href="#contact" class="btn btn--primary">Замовити консультацію</a>
            </div>
        </div>
    </section>

    <section class="section section-services" id="services">
        <div class="container">
            <h2 class="section__title">Наші Послуги</h2>
            <div class="grid">
                <div class="card service-card">
                    <h3>Workflow Automation</h3>
                    <p>Оптимізація рутинних процесів та створення ефективних робочих потоків.</p>
                </div>
                <div class="card service-card">
                    <h3>CRM Інтеграція</h3>
                    <p>Об'єднання всіх каналів комунікації та даних клієнтів в єдину екосистему.</p>
                </div>
                <div class="card service-card">
                    <h3>Custom Development</h3>
                    <p>Розробка унікального програмного забезпечення під специфічні потреби вашого бізнесу.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-about" id="about">
        <div class="container">
            <div class="about-content">
                <h2 class="section__title">Про Нас</h2>
                <p class="about-text">Ми - команда ентузіастів, які вірять, що технології повинні спрощувати життя. Наша місія - звільнити людей від рутини, дозволивши їм займатися творчістю та стратегічним розвитком.</p>
            </div>
        </div>
    </section>

    <section class="section section-blog" id="blog">
        <div class="container">
            <h2 class="section__title">Останні Новини</h2>
            <div class="grid">
                <?php 
                $args = array( 'posts_per_page' => 3 );
                $the_query = new WP_Query( $args ); 
                
                if ( $the_query->have_posts() ) : 
                    while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <article class="card post-card">
                            <div class="post-meta"><?php echo get_the_date('d M, Y'); ?></div>
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo wp_trim_words( get_the_excerpt(), 15 ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="read-more">Читати далі &rarr;</a>
                        </article>
                    <?php endwhile; 
                    wp_reset_postdata();
                else : ?>
                    <article class="card post-card">
                        <div class="post-meta">22 Лист, 2025</div>
                        <h3>Майбутнє AI в бізнесі</h3>
                        <p>Як штучний інтелект змінює правила гри в корпоративному секторі.</p>
                        <a href="#" class="read-more">Читати далі &rarr;</a>
                    </article>
                    <article class="card post-card">
                        <div class="post-meta">15 Лист, 2025</div>
                        <h3>Топ 5 інструментів автоматизації</h3>
                        <p>Огляд найкращих рішень для підвищення продуктивності команди.</p>
                        <a href="#" class="read-more">Читати далі &rarr;</a>
                    </article>
                    <article class="card post-card">
                        <div class="post-meta">08 Лист, 2025</div>
                        <h3>Масштабування без хаосу</h3>
                        <p>Стратегії росту бізнесу зі збереженням керованості процесів.</p>
                        <a href="#" class="read-more">Читати далі &rarr;</a>
                    </article>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="section section-contact" id="contact">
        <div class="container">
            <h2 class="section__title">Зв'яжіться з Нами</h2>
            <div class="contact-wrapper">
                <div class="contact-info card">
                    <h3>Контакти</h3>
                    <p>Готові обговорити ваш проект? Напишіть нам або зателефонуйте.</p>
                    <ul class="contact-list">
                        <li><strong>Email:</strong> info@automationstudio.com</li>
                        <li><strong>Телефон:</strong> +380 99 123 45 67</li>
                        <li><strong>Адреса:</strong> Київ, Україна</li>
                    </ul>
                </div>
                <div class="contact-form card">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Ваше Ім'я" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Ваш Email" required>
                        </div>
                        <div class="form-group">
                            <textarea name="message" placeholder="Повідомлення" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn--primary">Надіслати</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
