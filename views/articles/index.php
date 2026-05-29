<div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto py-8">
    <header class="mb-12">
        <h1 class="font-headline-xl text-headline-xl text-on-background mb-4 uppercase">Nos Offres</h1>
        <p class="font-body-lg text-secondary max-w-2xl">Repoussez vos limites avec nos abonnements et services. Chaque formule est conçue pour l'excellence et la transformation.</p>
    </header>

    <?php if (empty($articles)): ?>
    <p class="font-body-md text-secondary text-center py-16">Aucune offre disponible pour le moment.</p>
    <?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
        <?php foreach ($articles as $article): ?>
        <div class="group bg-white border border-surface-variant hover:shadow-[0_15px_30px_rgba(0,0,0,0.05)] transition-all flex flex-col overflow-hidden">
            <div class="h-64 overflow-hidden relative">
                <img src="<?= articleImageUrl($article['image']) ?>" alt="<?= e($article['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 grayscale group-hover:grayscale-0"/>
                <div class="absolute top-4 left-4 bg-primary text-white px-3 py-1 font-label-sm uppercase tracking-widest">Offre</div>
            </div>
            <div class="p-6 flex-1 flex flex-col">
                <span class="font-label-sm text-primary uppercase mb-2 tracking-widest">Abonnement</span>
                <h3 class="font-headline-md text-on-background mb-3"><?= e($article['title']) ?></h3>
                <p class="text-secondary font-body-md mb-6 flex-1 leading-relaxed"><?= e($article['short_description']) ?></p>
                <a href="<?= APP_URL ?>/offres/<?= (int) $article['id'] ?>" class="w-full py-4 border-2 border-on-background font-label-md uppercase tracking-widest hover:bg-on-background hover:text-white transition-all active:scale-95 text-center">Voir détails</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
