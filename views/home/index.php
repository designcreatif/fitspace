<!-- Hero -->
<section class="relative h-[min(751px,90vh)] w-full flex items-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img alt="FITSPACE" class="w-full h-full object-cover grayscale brightness-50" src="<?= THEME_HERO_IMG ?>"/>
        <div class="absolute inset-0 bg-gradient-to-r from-background via-background/40 to-transparent"></div>
    </div>
    <div class="relative z-10 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto w-full">
        <div class="max-w-2xl space-y-6">
            <h2 class="font-headline-xl text-headline-xl text-on-background leading-tight">DÉPASSEZ VOS LIMITES.<br/><span class="text-primary italic">AUCUNE EXCUSE.</span></h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-lg">L'élite du fitness à portée de main. Équipements de pointe, coaching expert et abonnements flexibles. Inscrivez-vous en ligne en quelques clics.</p>
            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <a href="<?= APP_URL ?>/register" class="bg-primary-container text-on-primary px-8 py-4 font-label-md text-label-md uppercase tracking-wider hover:opacity-90 transition-opacity active:scale-95 text-center">S'inscrire</a>
                <a href="<?= APP_URL ?>/offres" class="border-2 border-on-background text-on-background px-8 py-4 font-label-md text-label-md uppercase tracking-wider hover:bg-on-background hover:text-background transition-all active:scale-95 text-center">Nos offres</a>
            </div>
        </div>
    </div>
</section>

<!-- Services Bento -->
<section class="py-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="mb-12">
        <h3 class="font-headline-md text-headline-md uppercase tracking-tighter flex items-center gap-2">
            <span class="w-8 h-1 bg-primary inline-block"></span>
            Nos Services Premium
        </h3>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-auto md:h-[500px]">
        <div class="md:col-span-8 bg-white border border-surface-variant overflow-hidden group relative min-h-[280px]">
            <img class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 grayscale group-hover:grayscale-0" src="<?= THEME_EQUIPMENT_IMG ?>" alt="Équipement"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-8 text-white">
                <h4 class="font-headline-md text-headline-md mb-2">Équipement Moderne</h4>
                <p class="font-body-md text-body-md opacity-90 max-w-md">Cardio, musculation et espace fonctionnel avec du matériel haut de gamme.</p>
            </div>
        </div>
        <div class="md:col-span-4 bg-surface-container-low border border-surface-variant p-8 flex flex-col justify-end relative">
            <span class="material-symbols-outlined text-primary text-5xl absolute top-8 right-8">spa</span>
            <div>
                <h4 class="font-headline-md text-headline-md mb-4 text-on-surface">Zone de Récupération</h4>
                <p class="font-body-md text-body-md text-on-surface-variant mb-6">Sauna, cryothérapie et protocoles de récupération pour optimiser vos progrès.</p>
            </div>
        </div>
        <div class="md:col-span-4 bg-primary border border-primary p-8 flex flex-col justify-between min-h-[180px]">
            <span class="material-symbols-outlined text-white text-5xl">fitness_center</span>
            <div class="text-white">
                <h4 class="font-headline-md text-headline-md mb-2">Coaching Élite</h4>
                <p class="font-body-md text-body-md opacity-90">Programmes personnalisés par des coachs certifiés.</p>
            </div>
        </div>
        <div class="md:col-span-8 bg-white border border-surface-variant p-8 flex items-center justify-between">
            <div class="max-w-md">
                <h4 class="font-headline-md text-headline-md mb-2">Inscription en ligne</h4>
                <p class="font-body-md text-body-md text-on-surface-variant">Créez votre compte, choisissez votre abonnement et commencez dès aujourd'hui.</p>
            </div>
            <span class="text-headline-xl font-black text-surface-variant/40 hidden md:block">24/7</span>
        </div>
    </div>
</section>

<!-- Offres -->
<section class="py-20 bg-surface-container-lowest">
    <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
            <div class="max-w-xl">
                <h3 class="font-headline-lg text-headline-lg uppercase italic font-black text-on-background">Nos Offres</h3>
                <p class="font-body-lg text-body-lg text-on-surface-variant">Choisissez la formule adaptée à vos objectifs fitness.</p>
            </div>
            <a href="<?= APP_URL ?>/offres" class="font-label-md text-label-md uppercase border-b-2 border-primary pb-1 text-primary">Voir tout</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
            <?php foreach ($articles as $article): ?>
            <article class="flex flex-col gap-6 group">
                <div class="overflow-hidden border border-surface-variant h-64">
                    <img src="<?= articleImageUrl($article['image']) ?>" alt="<?= e($article['title']) ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500"/>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-4 text-primary font-label-sm text-label-sm uppercase tracking-widest">
                        <span><?= formatDate($article['published_at']) ?></span>
                    </div>
                    <h4 class="font-headline-md text-headline-md text-on-background group-hover:text-primary transition-colors"><?= e($article['title']) ?></h4>
                    <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2"><?= e($article['short_description']) ?></p>
                    <a href="<?= APP_URL ?>/offres/<?= (int) $article['id'] ?>" class="inline-flex items-center gap-2 font-label-md text-label-md text-primary group/link">
                        En savoir plus <span class="material-symbols-outlined group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="bg-inverse-surface text-inverse-on-surface py-24 text-center px-margin-mobile">
    <div class="max-w-3xl mx-auto space-y-8">
        <h3 class="font-headline-xl text-headline-xl uppercase tracking-tighter italic">REJOIGNEZ LA RÉVOLUTION</h3>
        <p class="font-body-lg text-body-lg opacity-70">Ne remettez pas à demain ce que vous pouvez transformer aujourd'hui.</p>
        <a href="<?= APP_URL ?>/register" class="inline-block bg-primary-container text-on-primary px-12 py-5 font-label-md text-label-md uppercase tracking-widest font-black active:scale-95 transition-transform">S'inscrire maintenant</a>
    </div>
</section>
