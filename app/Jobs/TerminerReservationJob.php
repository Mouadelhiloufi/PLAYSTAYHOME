<?php

namespace App\Jobs;

use App\Services\ReservationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TerminerReservationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reservationId;

    public function __construct($reservationId)
    {
        $this->reservationId = $reservationId;
    }

    public function handle(ReservationService $reservationService)
    {
        $reservationService->terminerReservation($this->reservationId);
    }
}
