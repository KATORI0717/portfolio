<?php get_header(); ?>

<div class="flow-page">
    <p class="flow-page__bg-text" aria-hidden="true">Flow</p>

    <div class="flow-page__head">
        <p class="flow-page__label">( FLOW )</p>
        <h1 class="flow-page__title">制作の流れ</h1>
        <p class="flow-page__lead">お問い合わせから公開まで、6つの段階で進めます。まだ何も決まっていなくても大丈夫です。わからないことは、どの段階でもお気軽にお聞きください。</p>
    </div>

    <ol class="flow-index">
        <li class="flow-index__item">
            <a class="flow-card" href="#step-1">
                <span class="flow-card__tab" aria-hidden="true">01</span>
                <span class="flow-card__step">STEP 01</span>
                <img class="flow-card__icon" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/flow/step-01.svg' ) ); ?>" alt="" width="48" height="48">
                <span class="flow-card__name">お問い合わせ</span>
            </a>
        </li>
        <li class="flow-index__item">
            <a class="flow-card" href="#step-2">
                <span class="flow-card__tab" aria-hidden="true">02</span>
                <span class="flow-card__step">STEP 02</span>
                <img class="flow-card__icon" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/flow/step-02.svg' ) ); ?>" alt="" width="48" height="48">
                <span class="flow-card__name">ヒアリング</span>
            </a>
        </li>
        <li class="flow-index__item">
            <a class="flow-card" href="#step-3">
                <span class="flow-card__tab" aria-hidden="true">03</span>
                <span class="flow-card__step">STEP 03</span>
                <img class="flow-card__icon" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/flow/step-03.svg' ) ); ?>" alt="" width="48" height="48">
                <span class="flow-card__name">構成・デザイン</span>
            </a>
        </li>
        <li class="flow-index__item">
            <a class="flow-card" href="#step-4">
                <span class="flow-card__tab" aria-hidden="true">04</span>
                <span class="flow-card__step">STEP 04</span>
                <img class="flow-card__icon" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/flow/step-04.svg' ) ); ?>" alt="" width="48" height="48">
                <span class="flow-card__name">コーディング</span>
            </a>
        </li>
        <li class="flow-index__item">
            <a class="flow-card" href="#step-5">
                <span class="flow-card__tab" aria-hidden="true">05</span>
                <span class="flow-card__step">STEP 05</span>
                <img class="flow-card__icon" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/flow/step-05.svg' ) ); ?>" alt="" width="48" height="48">
                <span class="flow-card__name">確認・修正</span>
            </a>
        </li>
        <li class="flow-index__item">
            <a class="flow-card" href="#step-6">
                <span class="flow-card__tab" aria-hidden="true">06</span>
                <span class="flow-card__step">STEP 06</span>
                <img class="flow-card__icon" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/flow/step-06.svg' ) ); ?>" alt="" width="48" height="48">
                <span class="flow-card__name">公開</span>
            </a>
        </li>
    </ol>

</div>

<?php get_footer(); ?>