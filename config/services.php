<?php
use Blog\Controller;

return [
    Controller\BlogController::class => function() {
        return new Controller\BlogController();
    }
];
