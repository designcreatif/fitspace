<?php

class ReservationController extends Controller
{
    public function create(): void
    {
        $articleId = (int) $_POST['article_id'];

        $reservationModel = new Reservation();

        if ($reservationModel->exists(Auth::id(), $articleId)) {

            $_SESSION['flash'] = [
                'type' => 'warning',
                'message' => 'Vous avez déjà réservé cette offre.'
            ];

            $this->redirect(APP_URL . '/dashboard');
        }

        $reservationModel->create(
            Auth::id(),
            $articleId,
            date('Y-m-d H:i:s')
        );

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Réservation créée avec succès.'
        ];

        $this->redirect(APP_URL . '/dashboard');
    }

    public function cancel(): void
    {
        $reservationId = (int) $_POST['reservation_id'];

        $reservationModel = new Reservation();

        $reservationModel->cancel($reservationId);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Réservation annulée.'
        ];

        $this->redirect(APP_URL . '/dashboard');
    }
}