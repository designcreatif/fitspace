<section class="mb-10">
    <?php if (!empty($_SESSION['flash'])): ?>

<div class="mb-6 p-4 border border-yellow-500 bg-yellow-100 text-yellow-800">

    <?= e($_SESSION['flash']['message']) ?>

</div>

<?php unset($_SESSION['flash']); ?>

<?php endif; ?>
    <h1 class="font-headline-xl text-headline-xl text-on-background mb-2">Bonjour, <?= e($user['first_name']) ?>.</h1>
    <div class="flex items-center gap-2 flex-wrap">
        <span
            class="inline-block px-3 py-1 bg-primary text-on-primary font-label-md rounded-full uppercase tracking-wider">Membre</span>
        <p class="font-body-md text-secondary">Bienvenue sur votre espace FitSpace.</p>
    </div>
</section>

<section class="grid grid-cols-1 md:grid-cols-3 gap-gutter mb-12">

    <!-- Calories -->
    <div
        class="bg-surface-container-lowest border border-surface-variant p-8 flex flex-col justify-between min-h-[220px]">
        <span class="material-symbols-outlined text-primary text-3xl">local_fire_department</span>

        <div>
            <p class="font-label-md text-secondary uppercase tracking-widest mb-4">
                Calories brûlées
            </p>

            <div class="flex items-end gap-2">
                <span class="text-5xl font-black text-on-background">
                    <?= $stats['calories_burned'] ?? 0 ?> </span>
                <span class="text-primary font-semibold mb-2">
                    Kcal
                </span>
            </div>
        </div>
    </div>

    <!-- Série -->
    <div
        class="bg-surface-container-lowest border border-surface-variant p-8 flex flex-col justify-between min-h-[220px]">
        <span class="material-symbols-outlined text-primary text-3xl">bolt</span>

        <div>
            <p class="font-label-md text-secondary uppercase tracking-widest mb-4">
                Jours de série
            </p>

            <div class="flex items-end gap-2">
                <span class="text-5xl font-black text-on-background">
                    <?= $stats['streak_days'] ?? 0 ?>
                </span>
                <span class="text-primary font-semibold mb-2">
                    Jours
                </span>
            </div>
        </div>
    </div>

    <!-- Volume -->
    <div
        class="bg-surface-container-lowest border border-surface-variant p-8 flex flex-col justify-between min-h-[220px]">

        <div class="flex justify-between items-start">
            <span class="material-symbols-outlined text-primary text-3xl">
                fitness_center
            </span>

            <span class="text-primary font-bold">
                +15% vs mois dernier
            </span>
        </div>

        <div>
            <p class="font-label-md text-secondary uppercase tracking-widest mb-4">
                Volume total levé
            </p>

            <div class="flex items-end gap-2">
                <span class="text-5xl font-black text-on-background">
                    <?= number_format($stats['total_volume'] ?? 0, 0, ',', ' ') ?>
                </span>
                <span class="text-primary font-semibold mb-2">
                    KG
                </span>
            </div>
        </div>
    </div>

</section>

<section class="mb-12">

    <div class="flex justify-between items-end mb-6">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-background">
                Mes réservations à venir
            </h2>
            <p class="font-body-md text-secondary mt-2">
                Retrouvez vos prochains entraînements programmés.
            </p>
            <div class="w-12 h-1 bg-primary mt-2"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">

        <!-- Réservation principale -->
<div class="lg:col-span-7 relative overflow-hidden h-[350px] bg-black">

    <?php if (!empty($reservations[0]['image'])): ?>
        <img
            src="<?= articleImageUrl($reservations[0]['image']) ?>"
            alt="<?= e($reservations[0]['title']) ?>"
            class="absolute inset-0 w-full h-full object-cover opacity-60">
    <?php endif; ?>

    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex flex-col justify-end p-8">

        <span class="font-label-md text-primary uppercase mb-2">
            <?= !empty($reservations[0])
                ? date('d/m/Y H:i', strtotime($reservations[0]['reservation_date']))
                : 'Aucune réservation'
            ?>
        </span>

        <h3 class="font-headline-xl text-white mb-4">
            <?= e($reservations[0]['title'] ?? 'Aucune réservation') ?>
        </h3>

        <button class="bg-primary-container text-white px-6 py-3 w-fit uppercase tracking-widest">
            Réservé
        </button>

    </div>
</div>

        <!-- Réservations secondaires -->
<div class="lg:col-span-5 flex flex-col gap-4">

    <?php foreach (array_slice($reservations, 1, 2) as $reservation): ?>

<div class="border border-surface-variant p-6">

    <span class="text-secondary uppercase text-sm">
        <?= date('d/m/Y H:i', strtotime($reservation['reservation_date'])) ?>
    </span>

    <h4 class="font-headline-md mt-2">
        <?= e($reservation['title']) ?>
    </h4>

    <p class="text-secondary mb-4">
        Réservation confirmée
    </p>

    <form method="POST" action="<?= APP_URL ?>/reservation/cancel">

        <input
            type="hidden"
            name="reservation_id"
            value="<?= $reservation['id'] ?>">

        <button
            type="submit"
            class="px-4 py-2 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition">

            Annuler

        </button>

    </form>

</div>

<?php endforeach; ?>

</div>

    </div>

</section>

<section>
    <h2 class="font-headline-lg text-headline-lg uppercase italic font-black mb-8 flex items-center gap-2">
        <span class="w-8 h-1 bg-primary inline-block"></span>
        Dernières offres
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
        <?php foreach ($articles as $article): ?>
            <div
                class="group bg-white border border-surface-variant overflow-hidden hover:shadow-[0_15px_30px_rgba(0,0,0,0.05)] transition-all">
                <div class="h-40 overflow-hidden">
                    <img src="<?= articleImageUrl($article['image']) ?>" alt="<?= e($article['title']) ?>"
                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500" />
                </div>
                <div class="p-4">
                    <h3 class="font-headline-md text-sm mb-2 line-clamp-1"><?= e($article['title']) ?></h3>
                    <a href="<?= APP_URL ?>/offres/<?= (int) $article['id'] ?>"
                        class="font-label-md text-primary flex items-center gap-1">
                        Détails <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="<?= APP_URL ?>/offres"
        class="inline-block mt-8 font-label-md text-primary border-b-2 border-primary pb-1 uppercase">Voir toutes les
        offres</a>
</section>