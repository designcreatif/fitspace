<section class="space-y-8">

    <div>
        <h1 class="font-headline-xl text-headline-xl">
            Réservations
        </h1>

        <p class="text-secondary mt-2">
            Liste de toutes les réservations des membres.
        </p>
    </div>

    <div class="overflow-x-auto border border-surface-variant">

        <table class="w-full">

            <thead class="bg-surface-container">
                <tr>
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Utilisateur</th>
                    <th class="p-4 text-left">Offre</th>
                    <th class="p-4 text-left">Date</th>
                    <th class="p-4 text-left">Statut</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($reservations as $reservation): ?>

                    <tr class="border-t border-surface-variant">

                        <td class="p-4">
                            <?= $reservation['id'] ?>
                        </td>

                        <td class="p-4">
                            <?= e(
                                $reservation['first_name']
                                . ' '
                                . $reservation['last_name']
                            ) ?>
                        </td>

                        <td class="p-4">
                            <?= e($reservation['title']) ?>
                        </td>

                        <td class="p-4">
                            <?= date(
                                'd/m/Y H:i',
                                strtotime($reservation['reservation_date'])
                            ) ?>
                        </td>

                        <td class="p-4">

                            <?php if ($reservation['status'] === 'confirmed'): ?>

                                <span class="text-green-600 font-semibold">
                                    Confirmée
                                </span>

                            <?php else: ?>

                                <span class="text-red-600 font-semibold">
                                    Annulée
                                </span>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</section>