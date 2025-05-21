<?php

return [

    /*
     * Enable or disable activity logging globally.
     * Use .env: ACTIVITY_LOGGER_ENABLED=true or false
     */
    'enabled' => env('ACTIVITY_LOGGER_ENABLED', true),

    /*
     * Automatically delete activity log records older than this many days
     * when running the clean-command.
     */
    'delete_records_older_than_days' => 365,

    /*
     * Default log name if none is provided when logging activity.
     */
    'default_log_name' => 'default',

    /*
     * Auth driver to use for fetching users.
     * Null uses default Laravel auth driver.
     */
    'default_auth_driver' => null,

    /*
     * Whether to return soft deleted models as subjects in activities.
     */
    'subject_returns_soft_deleted_models' => false,

    /*
     * Activity model used for logging.
     */
    'activity_model' => \Spatie\Activitylog\Models\Activity::class,

    /*
     * Database table name for storing activities.
     */
    'table_name' => env('ACTIVITY_LOGGER_TABLE_NAME', 'activity_log'),

    /*
     * Database connection for activity log table.
     * Null uses Laravel's default connection.
     */
    'database_connection' => env('ACTIVITY_LOGGER_DB_CONNECTION'),

];
