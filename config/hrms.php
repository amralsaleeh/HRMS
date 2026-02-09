<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Unassigned center ID
    |--------------------------------------------------------------------------
    |
    | Center ID used for "not affiliated" employees in activeEmployees().
    | Set to null or ensure this center exists; otherwise not-affiliated
    | employees are omitted when the center is missing.
    |
    */
    'unassigned_center_id' => env('HRMS_UNASSIGNED_CENTER_ID', 100),
];
