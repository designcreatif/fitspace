<?php

class AdminReservationController extends Controller
{
    public function index(): void
    {
        $reservationModel = new Reservation();

        $reservations = $reservationModel->all();

        $this->view('admin/reservations/index', [
            'title' => 'Réservations',
            'reservations' => $reservations,
        ], 'admin');
    }
}