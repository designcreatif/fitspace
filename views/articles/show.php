<!-- Hero -->
<section class="relative h-[min(530px,70vh)] w-full overflow-hidden">
    <img src="<?= articleImageUrl($article['image']) ?>" alt="<?= e($article['title']) ?>"
        class="w-full h-full object-cover grayscale-[20%]" />
    <div class="absolute inset-0 bg-gradient-to-t from-background via-transparent to-transparent"></div>
    <div class="absolute bottom-0 left-0 w-full p-margin-mobile md:p-margin-desktop">
        <div class="max-w-container-max mx-auto">
            <span
                class="inline-block bg-primary text-on-primary px-3 py-1 font-label-sm uppercase tracking-widest mb-4">Offre</span>
            <h1 class="font-headline-xl text-headline-xl text-on-surface max-w-2xl mb-2"><?= e($article['title']) ?>
            </h1>
            <p class="font-body-lg text-secondary max-w-xl"><?= e($article['short_description']) ?></p>
        </div>
    </div>
</section>

<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
        <div class="md:col-span-8 space-y-8">
            <div class="space-y-4">
                <h2 class="font-headline-lg text-headline-lg border-l-4 border-primary pl-4 uppercase">Description</h2>
                <p class="font-body-lg text-on-surface-variant leading-relaxed whitespace-pre-line">
                    <?= e($article['full_description']) ?></p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                <div class="border border-surface-variant p-6 text-center">
                    <p class="font-label-sm text-secondary uppercase mb-2">Publié le</p>
                    <p class="font-headline-md text-headline-md"><?= formatDate($article['published_at']) ?></p>
                </div>
                <?php if ($article['author_first']): ?>
                    <div class="border border-surface-variant p-6 text-center sm:col-span-2">
                        <p class="font-label-sm text-secondary uppercase mb-2">Auteur</p>
                        <p class="font-headline-md text-headline-md">
                            <?= e($article['author_first'] . ' ' . $article['author_last']) ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="md:col-span-4">
            <div class="sticky top-24 border border-surface-variant bg-surface-container-lowest p-8 space-y-6">
                <h3 class="font-headline-md text-headline-md uppercase">S'abonner</h3>
                <p class="font-body-md text-secondary">Rejoignez FitSpace et accédez à cette offre dès maintenant.</p>
                <?php if (!Auth::check()): ?>
                    <a href="<?= APP_URL ?>/register"
                        class="block w-full py-4 bg-primary-container text-on-primary font-label-md uppercase tracking-widest text-center hover:opacity-90 active:scale-95">Créer
                        un compte</a>
                    <a href="<?= APP_URL ?>/login"
                        class="block w-full py-4 border-2 border-on-background font-label-md uppercase tracking-widest text-center hover:bg-on-background hover:text-white transition-all">Se
                        connecter</a>
                <?php else: ?>

                    <form method="POST" action="<?= APP_URL ?>/reservation/create">
                        <input type="hidden" name="article_id" value="<?= $article['id'] ?>">

                        <button type="submit"
                            class="w-full py-4 bg-primary-container text-on-primary font-label-md uppercase tracking-widest text-center hover:opacity-90">
                            Réserver cette offre
                        </button>
                    </form>

                    <a href="<?= APP_URL ?>/dashboard"
                        class="block mt-3 w-full py-4 border border-surface-variant text-center">
                        Mon espace
                    </a>

                <?php endif; ?>
                <a href="<?= APP_URL ?>/offres" class="block text-center font-label-md text-primary hover:underline">←
                    Toutes les offres</a>
            </div>
        </div>
    </div>
</section>