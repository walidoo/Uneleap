<?php

namespace App\Repositories;

use App\Feedback;

class FeedbackRepository {

    public function feedBack($data) {
        Feedback::create($data);
    }

}
