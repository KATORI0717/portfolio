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
    <ol class="flow-detail">
        <li class="flow-detail__item" id="step-1">
            <p class="flow-detail__num" aria-hidden="true">
                <span class="flow-detail__num-label">STEP</span>
                <span class="flow-detail__num-value">01</span>
            </p>
            <div class="flow-detail__card">
                <div class="flow-detail__head">
                    <img class="flow-detail__icon" src="<?php echo esc_url(get_theme_file_uri( 'assets/img/flow/step-01.svg' ) ); ?>" alt="" width="40" height="40">
                    <h2 class="flow-detail__title">お問い合わせ<span class="flow-detail__title-en">Contact</span></h2>
                </div>
                <p class="flow-detail__text">お問い合わせフォームからお気軽にご連絡ください。内容がまとまっていなくても大丈夫です。いただいた内容を読んで、ヒアリングの日程をご相談します。</p>
                <div class="flow-detail__box">
                    <p class="flow-detail__box-title">わかる範囲で書いていただけると助かります。</p>
                    <ul class="flow-detail__list">
                        <li class="flow-detail__list-item">どんなお仕事・お店か</li>
                        <li class="flow-detail__list-item">作りたいもの（WEBサイト・バナー・チラシなど）</li>
                        <li class="flow-detail__list-item">ご希望の納期や予算など</li>
                    </ul>
                </div>
                <div class="flow-detail__qa">
                    <details class="flow-detail__qa-item">
                        <summary class="flow-detail__question">相談だけで終わっても大丈夫ですか？</summary>
                        <p class="flow-detail__answer">はい、大丈夫です。お見積もりをご確認いただいてから、進めるかどうか決めていただけます。</p>
                    </details>
                    <details class="flow-detail__qa-item">
                        <summary class="flow-detail__question">ドメインやサーバーなど、まだ持っていません。</summary>
                        <p class="flow-detail__answer">ご依頼時には、持っていなくても大丈夫です。どの会社を選べば良いかなど、一緒に決めて登録方法もお手伝いいたします。</p>
                    </details>
                </div>
            </div>
        </li>
        <li class="flow-detail__item" id="step-2">
            <p class="flow-detail__num" aria-hidden="true">
                <span class="flow-detail__num-label">STEP</span>
                <span class="flow-detail__num-value">02</span>
            </p>
            <div class="flow-detail__card">
                <div class="flow-detail__head">
                    <img class="flow-detail__icon" src="<?php echo esc_url(get_theme_file_uri( 'assets/img/flow/step-02.svg' ) ); ?>" alt="" width="40" height="40">
                    <h2 class="flow-detail__title">ヒアリング<span class="flow-detail__title-en">Hearing</span></h2>
                </div>
                <p class="flow-detail__text">「どんな方に、何を伝えたいか」からお聞きします。まだ言葉になっていなくても大丈夫です。看護の現場で患者さまのお話を伺ってきたときと同じように、気になっていることをひとつずつ整理していきます。</p>
                <div class="flow-detail__box">
                    <p class="flow-detail__box-title">ご用意いただけると助かるもの</p>
                    <ul class="flow-detail__list">
                        <li class="flow-detail__list-item">参考にしたいサイトや画像</li>
                        <li class="flow-detail__list-item">ロゴや、使いたい写真</li>
                        <li class="flow-detail__list-item">公開したい時期の目安</li>
                    </ul>
                </div>
                <div class="flow-detail__qa">
                    <details class="flow-detail__qa-item">
                        <summary class="flow-detail__question">何も決まっていなくても、相談できますか？</summary>
                        <p class="flow-detail__answer">はい。「何から決めたらいいかわからない」というところから一緒に考えていきます。</p>
                    </details>
                </div>
            </div>
        </li>
        <li class="flow-detail__item" id="step-3">
            <p class="flow-detail__num" aria-hidden="true">
                <span class="flow-detail__num-label">STEP</span>
                <span class="flow-detail__num-value">03</span>
            </p>
            <div class="flow-detail__card">
                <div class="flow-detail__head">
                    <img class="flow-detail__icon" src="<?php echo esc_url(get_theme_file_uri( 'assets/img/flow/step-03.svg' ) ); ?>" alt="" width="40" height="40">
                    <h2 class="flow-detail__title">構成・デザイン<span class="flow-detail__title-en">Wireframe &amp; Design</span></h2>
                </div>
                <p class="flow-detail__text">まずはページの組み立て（ワイヤーフレーム）を作り、載せる内容に抜けがないかを一緒に確かめます。そのあと、色・写真・文字の大きさを決めて、デザインに仕上げます。</p>
                <div class="flow-detail__box">
                    <p class="flow-detail__box-title">一緒に確かめること</p>
                    <ul class="flow-detail__list">
                        <li class="flow-detail__list-item">伝える順番が自然か</li>
                        <li class="flow-detail__list-item">必要な情報が入っているか</li>
                        <li class="flow-detail__list-item">色や写真の雰囲気など</li>
                    </ul>
                </div>
                <div class="flow-detail__qa">
                    <details class="flow-detail__qa-item">
                        <summary class="flow-detail__question">デザインを見てから、直してもらえますか？</summary>
                        <p class="flow-detail__answer">はい。気になるところをお聞きして調整します。直す回数は、お見積りの時にご相談します。</p>
                    </details>
                </div>
            </div>
        </li>
        <li class="flow-detail__item" id="step-3">
            <p class="flow-detail__num" aria-hidden="true">
                <span class="flow-detail__num-label">STEP</span>
                <span class="flow-detail__num-value">03</span>
            </p>
            <div class="flow-detail__card">
                <div class="flow-detail__head">
                    <img class="flow-detail__icon" src="<?php echo esc_url(get_theme_file_uri( 'assets/img/flow/step-03.svg' ) ); ?>" alt="" width="40" height="40">
                    <h2 class="flow-detail__title">構成・デザイン<span class="flow-detail__title-en">Wireframe &amp; Design</span></h2>
                </div>
                <p class="flow-detail__text">まずはページの組み立て（ワイヤーフレーム）を作り、載せる内容に抜けがないかを一緒に確かめます。そのあと、色・写真・文字の大きさを決めて、デザインに仕上げます。</p>
                <div class="flow-detail__box">
                    <p class="flow-detail__box-title">一緒に確かめること</p>
                    <ul class="flow-detail__list">
                        <li class="flow-detail__list-item">伝える順番が自然か</li>
                        <li class="flow-detail__list-item">必要な情報が入っているか</li>
                        <li class="flow-detail__list-item">色や写真の雰囲気など</li>
                    </ul>
                </div>
                <div class="flow-detail__qa">
                    <details class="flow-detail__qa-item">
                        <summary class="flow-detail__question">デザインを見てから、直してもらえますか？</summary>
                        <p class="flow-detail__answer">はい。気になるところをお聞きして調整します。直す回数は、お見積りの時にご相談します。</p>
                    </details>
                </div>
            </div>
        </li>
        <li class="flow-detail__item" id="step-4">
            <p class="flow-detail__num" aria-hidden="true">
                <span class="flow-detail__num-label">STEP</span>
                <span class="flow-detail__num-value">04</span>
            </p>
            <div class="flow-detail__card">
                <div class="flow-detail__head">
                    <img class="flow-detail__icon" src="<?php echo esc_url(get_theme_file_uri( 'assets/img/flow/step-04.svg' ) ); ?>" alt="" width="40" height="40">
                    <h2 class="flow-detail__title">見出し：コーディング<span class="flow-detail__title-en">Coding</span></h2>
                </div>
                <p class="flow-detail__text">デザインをもとに、実際に見られるページを作ります。パソコンでもスマートフォンでも見やすいように整えます。公開後にお客様ご自身で更新しやすい形にします。</p>
            </div>
        </li>
        <li class="flow-detail__item" id="step-5">
            <p class="flow-detail__num" aria-hidden="true">
                <span class="flow-detail__num-label">STEP</span>
                <span class="flow-detail__num-value">05</span>
            </p>
            <div class="flow-detail__card">
                <div class="flow-detail__head">
                    <img class="flow-detail__icon" src="<?php echo esc_url(get_theme_file_uri( 'assets/img/flow/step-05.svg' ) ); ?>" alt="" width="40" height="40">
                    <h2 class="flow-detail__title">確認・修正<span class="flow-detail__title-en">Review</span></h2>
                </div>
                <p class="flow-detail__text">公開する前に、実際の画面でご確認いただきます。文字のまちがいや、気になるところがあればお知らせください。</p>
                <div class="flow-detail__qa">
                    <details class="flow-detail__qa-item">
                        <summary class="flow-detail__question">どうやって公開前のホームページを確認できますか？</summary>
                        <p class="flow-detail__answer">確認用のページのURLをお送りします。パソコンやスマートフォンで開いて、そのまま見ていただけます。</p>
                    </details>
                </div>
            </div>
        </li>
        <li class="flow-detail__item" id="step-6">
            <p class="flow-detail__num" aria-hidden="true">
                <span class="flow-detail__num-label">STEP</span>
                <span class="flow-detail__num-value">06</span>
            </p>
            <div class="flow-detail__card">
                <div class="flow-detail__head">
                    <img class="flow-detail__icon" src="<?php echo esc_url(get_theme_file_uri( 'assets/img/flow/step-06.svg' ) ); ?>" alt="" width="40" height="40">
                    <h2 class="flow-detail__title">公開<span class="flow-detail__title-en">Release</span></h2>
                </div>
                <p class="flow-detail__text">最終確認が終わったら、公開のための設定をして公開します。公開した後も、更新の仕方や小さい修正など、困ったときはご相談ください。</p>
                <div class="flow-detail__box">
                    <p class="flow-detail__box-title">公開の時に、こちらで行うこと</p>
                    <ul class="flow-detail__list">
                        <li class="flow-detail__list-item">ドメインとサーバーをつなぐ設定</li>
                        <li class="flow-detail__list-item">「https」で安全に見られるようにする設定</li>
                        <li class="flow-detail__list-item">お問い合わせフォームが届くのか確認</li>
                    </ul>
                </div>
                <div class="flow-detail__qa">
                    <details class="flow-detail__qa-item">
                        <summary class="flow-detail__question">公開後の更新は、自分でできますか？</summary>
                        <p class="flow-detail__answer">はい。必要でしたらオンラインで画面を見ながらわかるようにお伝えします。</p>
                    </details>
                </div>
            </div>
        </li>
    </ol>

</div>

<?php get_footer(); ?>