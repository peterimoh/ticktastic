<?php

return [
    'version' => file_get_contents(base_path('VERSION')),

    'app_url' => env('APP_URL'),
    'app_name' => 'TickTastic',

    'event_images_path' => 'user_media/event_images',
    'event_bg_images_path' => 'user_media/event_bg_images',
    'organiser_images_path' => 'user_media/organiser_images',
    'event_pdf_tickets_path' => 'user_media/pdf_tickets',
];
