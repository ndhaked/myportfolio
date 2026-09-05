<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuizLevel;
use App\Models\QuizTechnology;
use Illuminate\Database\Seeder;

class QuizQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $technology = QuizTechnology::where('slug', 'laravel')->first();

        if (! $technology) {
            return;
        }

        $data = [
            'starter' => [
                ['topic' => 'Artisan', 'q' => 'Which command creates a new Laravel controller?', 'options' => ['php artisan make:controller', 'php artisan create:controller', 'php artisan controller:new', 'php artisan generate:controller'], 'correct' => 0],
                ['topic' => 'Blade', 'q' => 'What is the default templating engine used in Laravel?', 'options' => ['Blade', 'Twig', 'Smarty', 'Handlebars'], 'correct' => 0],
                ['topic' => 'Routing', 'q' => 'Which file is used to define web routes in a standard Laravel app?', 'options' => ['routes/web.php', 'routes/routes.php', 'app/web.php', 'config/routes.php'], 'correct' => 0],
                ['topic' => 'Eloquent', 'q' => 'What does Eloquent ORM primarily provide?', 'options' => ['An ActiveRecord implementation for interacting with the database', 'A templating engine', 'A queue driver', 'A caching layer'], 'correct' => 0],
                ['topic' => 'Artisan', 'q' => 'Which artisan command runs pending database migrations?', 'options' => ['php artisan migrate', 'php artisan db:migrate', 'php artisan migrate:run', 'php artisan db:update'], 'correct' => 0],
                ['topic' => 'Configuration', 'q' => 'In Laravel, what is the .env file used for?', 'options' => ['Storing environment-specific configuration values', 'Storing compiled views', 'Storing session data', 'Storing routes'], 'correct' => 0],
                ['topic' => 'Blade', 'q' => "Which Blade directive is used to extend a layout?", 'options' => ['@extends', '@layout', '@use', '@template'], 'correct' => 0],
                ['topic' => 'Routing', 'q' => "What HTTP method does a Laravel resource route use for creating a new record?", 'options' => ['POST', 'GET', 'PUT', 'PATCH'], 'correct' => 0],
                ['topic' => 'Tooling', 'q' => 'Which Composer command installs Laravel project dependencies?', 'options' => ['composer install', 'composer setup', 'composer build', 'composer init'], 'correct' => 0],
                ['topic' => 'Security', 'q' => "What is the purpose of Laravel's APP_KEY?", 'options' => ['Used for encrypting sessions and other encrypted values', 'Used to identify the app in Composer', 'Used as the database password', 'Used as the API rate limit key'], 'correct' => 0],
                ['topic' => 'Artisan', 'q' => 'Which artisan command creates a new Eloquent model?', 'options' => ['php artisan make:model', 'php artisan make:eloquent', 'php artisan create:model', 'php artisan model:create'], 'correct' => 0],
                ['topic' => 'Database', 'q' => 'Since Laravel 11, which database driver is used by default in a newly created application?', 'options' => ['SQLite', 'MongoDB', 'Oracle', 'SQL Server'], 'correct' => 0],
                ['topic' => 'Blade', 'q' => 'Which Blade syntax escapes output to prevent XSS by default?', 'options' => ['{{ $variable }}', '{!! $variable !!}', '@php', '@raw'], 'correct' => 0],
                ['topic' => 'Tooling', 'q' => 'What does php artisan tinker provide?', 'options' => ['An interactive REPL/console for the application', 'A code formatter', 'A database GUI', 'A deployment tool'], 'correct' => 0],
                ['topic' => 'Eloquent', 'q' => "What is the purpose of the fillable property on an Eloquent model?", 'options' => ['To whitelist attributes that can be mass-assigned', 'To hide attributes from JSON output', 'To define database indexes', 'To set default values'], 'correct' => 0],
                ['topic' => 'Artisan', 'q' => 'Which command generates a new Form Request class?', 'options' => ['php artisan make:request', 'php artisan make:form', 'php artisan request:create', 'php artisan make:validation'], 'correct' => 0],
                ['topic' => 'Debugging', 'q' => 'What does dd() do when debugging a Laravel application?', 'options' => ['Dumps a variable and stops script execution', 'Deletes a database record', 'Deploys the application', 'Disables debug mode'], 'correct' => 0],
                ['topic' => 'Structure', 'q' => 'Which folder typically contains Blade view files in a standard Laravel app?', 'options' => ['resources/views', 'app/views', 'public/views', 'storage/views'], 'correct' => 0],
                ['topic' => 'Configuration', 'q' => "What is the purpose of Laravel's .env.example file?", 'options' => ['A template showing required environment variables without real secret values', 'The actual production environment file', 'A backup of .env', 'A file used only in testing'], 'correct' => 0],
                ['topic' => 'Eloquent', 'q' => 'Which Eloquent method retrieves a single record by primary key, throwing an exception if not found?', 'options' => ['findOrFail()', 'find()', 'first()', 'get()'], 'correct' => 0],
                ['topic' => 'Artisan', 'q' => 'What does the php artisan route:list command show?', 'options' => ['All registered routes in the application', 'All installed packages', 'All database tables', 'All environment variables'], 'correct' => 0],
                ['topic' => 'Eloquent', 'q' => "Which query builder method adds a WHERE clause to a query?", 'options' => ['where()', 'select()', 'orderBy()', 'limit()'], 'correct' => 0],
                ['topic' => 'Artisan', 'q' => 'Which command runs a specific database seeder class?', 'options' => ['php artisan db:seed --class=ClassName', 'php artisan seed:run', 'php artisan db:seeder', 'php artisan run:seeder'], 'correct' => 0],
                ['topic' => 'Security', 'q' => "What does CSRF stand for, in the context of Laravel's built-in protection?", 'options' => ['Cross-Site Request Forgery', 'Cross-Site Resource Fetching', 'Client-Side Request Filtering', 'Cross-Server Request Formatting'], 'correct' => 0],
            ],
            'intermediate' => [
                ['topic' => 'Eloquent', 'q' => 'Which Eloquent method eager loads a relationship to avoid N+1 queries?', 'options' => ['with()', 'load()', 'join()', 'has()'], 'correct' => 0],
                ['topic' => 'Architecture', 'q' => "What does Laravel's Service Container primarily manage?", 'options' => ['Class dependency resolution and binding', 'HTTP sessions', 'Queue jobs', 'Database migrations'], 'correct' => 0],
                ['topic' => 'Security', 'q' => 'Which middleware is responsible for CSRF protection in Laravel?', 'options' => ['VerifyCsrfToken', 'EncryptCookies', 'TrustProxies', 'ThrottleRequests'], 'correct' => 0],
                ['topic' => 'Validation', 'q' => 'What is the purpose of a Laravel Form Request class?', 'options' => ['To encapsulate validation and authorization logic for a request', 'To render Blade views', 'To define API routes', 'To queue background jobs'], 'correct' => 0],
                ['topic' => 'Eloquent', 'q' => 'Which Eloquent relationship type is used for a "has many through" scenario?', 'options' => ['hasManyThrough', 'belongsToMany', 'morphMany', 'hasOneThrough'], 'correct' => 0],
                ['topic' => 'Queues', 'q' => 'What does php artisan queue:work do?', 'options' => ['Starts processing jobs from the configured queue', 'Publishes routes', 'Compiles Blade views', 'Clears the cache'], 'correct' => 0],
                ['topic' => 'Caching', 'q' => 'Which facade is commonly used to interact with the cache in Laravel?', 'options' => ['Cache', 'Storage', 'Session', 'Config'], 'correct' => 0],
                ['topic' => 'Architecture', 'q' => "What is the purpose of a Repository pattern in a Laravel app?", 'options' => ['To abstract data access logic away from controllers', 'To handle routing', 'To manage sessions', 'To render views'], 'correct' => 0],
                ['topic' => 'Artisan', 'q' => "Which command clears Laravel's configuration cache?", 'options' => ['php artisan config:clear', 'php artisan cache:clear', 'php artisan config:reset', 'php artisan optimize:clear-config'], 'correct' => 0],
                ['topic' => 'Helpers', 'q' => "What does Laravel's Str::slug() helper do?", 'options' => ['Converts a string into a URL-friendly slug', 'Encrypts a string', 'Converts a string to uppercase', 'Removes whitespace only'], 'correct' => 0],
                ['topic' => 'Testing', 'q' => 'Which Laravel testing helper simulates an authenticated user in a test?', 'options' => ['actingAs()', 'loginAs()', 'authAs()', 'simulateUser()'], 'correct' => 0],
                ['topic' => 'Events', 'q' => 'What is the relationship between Laravel Events and Listeners?', 'options' => ['An Event is fired and one or more Listeners react to it', 'A Listener fires and an Event reacts to it', 'They are unrelated', 'Listeners replace Events entirely'], 'correct' => 0],
                ['topic' => 'API', 'q' => 'Which Laravel feature transforms Eloquent models into a consistent JSON API structure?', 'options' => ['API Resources', 'Form Requests', 'Middleware', 'Service Providers'], 'correct' => 0],
                ['topic' => 'Database', 'q' => 'What is the purpose of a database seeder in Laravel?', 'options' => ['To populate the database with test/sample data', 'To define the schema', 'To run scheduled tasks', 'To handle file storage'], 'correct' => 0],
                ['topic' => 'Middleware', 'q' => 'Where are global middleware registered in a modern Laravel (11/12) application?', 'options' => ['bootstrap/app.php', 'routes/web.php', '.env', 'composer.json'], 'correct' => 0],
                ['topic' => 'Authorization', 'q' => 'What is the purpose of a Laravel Policy class?', 'options' => ["To authorize a user's actions on a specific model", 'To validate incoming requests', 'To define routes', 'To schedule tasks'], 'correct' => 0],
                ['topic' => 'Scheduling', 'q' => 'Which Laravel feature lets you define scheduled/recurring tasks (e.g. a daily cleanup job)?', 'options' => ['Task Scheduling', 'Queues', 'Events', 'Middleware'], 'correct' => 0],
                ['topic' => 'Eloquent', 'q' => "What is the purpose of an Eloquent accessor?", 'options' => ["To transform an attribute's value when it is retrieved from the model", 'To validate form input', 'To define a database index', 'To register a route'], 'correct' => 0],
                ['topic' => 'Testing', 'q' => 'Which Laravel testing trait migrates the database fresh and wraps each test in a transaction?', 'options' => ['RefreshDatabase', 'WithFaker', 'InteractsWithSession', 'MakesHttpRequests'], 'correct' => 0],
                ['topic' => 'Notifications', 'q' => "What does Laravel's Notification system allow you to do?", 'options' => ['Send notifications across multiple channels (mail, SMS, database, Slack, etc.) via one interface', 'Only send database records', 'Only send emails', 'Handle HTTP redirects'], 'correct' => 0],
                ['topic' => 'Artisan', 'q' => 'Which artisan command creates a new Eloquent factory?', 'options' => ['php artisan make:factory', 'php artisan make:seed', 'php artisan factory:create', 'php artisan make:fake'], 'correct' => 0],
                ['topic' => 'API', 'q' => "What is the purpose of a Laravel API Resource Collection?", 'options' => ['To transform a collection of Eloquent models into a consistent JSON structure', 'To paginate database queries only', 'To cache API responses', 'To rate-limit API requests'], 'correct' => 0],
                ['topic' => 'Eloquent', 'q' => 'Which method permanently removes a model that uses the SoftDeletes trait, bypassing the soft-delete behavior?', 'options' => ['forceDelete()', 'delete()', 'restore()', 'trashed()'], 'correct' => 0],
                ['topic' => 'Eloquent', 'q' => "What does the restore() method do on a soft-deleted Eloquent model?", 'options' => ['Un-deletes the record by clearing its deleted_at column', 'Restores a database backup', 'Reverts the last migration', 'Refreshes the model from the database'], 'correct' => 0],
                ['topic' => 'Helpers', 'q' => 'Which Laravel helper function generates a fully qualified URL to a named route?', 'options' => ['route()', 'url()', 'asset()', 'action()'], 'correct' => 0],
                ['topic' => 'Authorization', 'q' => "What is the purpose of Laravel's Gate::define()?", 'options' => ['To define a simple authorization check outside of a full Policy class', 'To define a new route group', 'To define a database gate/index', 'To define a queue connection'], 'correct' => 0],
                ['topic' => 'Artisan', 'q' => 'Which command lists all artisan commands available in the application?', 'options' => ['php artisan list', 'php artisan help', 'php artisan commands', 'php artisan show'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => "What is the purpose of Laravel's config:cache command?", 'options' => ['Combines all config files into a single cached file for faster loading in production', 'Clears all cached config', 'Publishes vendor config files', 'Validates config syntax'], 'correct' => 0],
                ['topic' => 'Eloquent', 'q' => "Which Eloquent feature lets you define a computed value that is always appended to a model's array/JSON output even though it's not a database column?", 'options' => ['An accessor combined with the $appends property', '$fillable', '$hidden', '$casts alone'], 'correct' => 0],
                ['topic' => 'Helpers', 'q' => 'What does Str::plural() do?', 'options' => ['Converts a singular word to its plural form', 'Converts a string to uppercase', 'Reverses a string', 'Removes duplicate words'], 'correct' => 0],
            ],
            'senior' => [
                ['topic' => 'Queues', 'q' => 'What is the main benefit of using Laravel Queues with a driver like Redis?', 'options' => ['Deferring time-consuming tasks to be processed asynchronously in the background', 'Improving Blade rendering speed', 'Reducing the number of routes', 'Replacing Eloquent'], 'correct' => 0],
                ['topic' => 'Architecture', 'q' => "Which design pattern does Laravel's Service Container primarily implement?", 'options' => ['Dependency Injection / IoC container', 'Singleton only', 'Observer pattern', 'Factory pattern only'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'When optimizing a high-traffic Laravel API, which technique most directly reduces database load from repeated identical reads?', 'options' => ['Caching query results (e.g. with Redis)', 'Adding more Eloquent relationships', 'Increasing PHP memory limit', 'Disabling middleware'], 'correct' => 0],
                ['topic' => 'Database', 'q' => 'What is the purpose of database indexing in a Laravel/MySQL application under heavy load?', 'options' => ['To speed up query lookups on frequently filtered/sorted columns', 'To encrypt sensitive columns', 'To enforce foreign key constraints only', 'To reduce migration file size'], 'correct' => 0],
                ['topic' => 'Scaling', 'q' => 'In a Laravel application scaled horizontally across multiple servers, what must session/cache storage typically move to?', 'options' => ['A centralized store like Redis or a database, instead of the local file driver', 'Local file storage on each server', 'Cookies only', 'In-memory arrays'], 'correct' => 0],
                ['topic' => 'Queues', 'q' => 'What is a common strategy to prevent race conditions when multiple queue workers update the same database row?', 'options' => ['Using database transactions with row locking (e.g. lockForUpdate)', 'Increasing the number of workers', 'Disabling the queue', 'Using more Eloquent accessors'], 'correct' => 0],
                ['topic' => 'Real-time', 'q' => 'Which Laravel feature allows broadcasting real-time events to the frontend (e.g. via WebSockets)?', 'options' => ['Laravel Broadcasting (Echo + a broadcaster like Pusher/Reverb)', 'Blade Components', 'Form Requests', 'Artisan Scheduler'], 'correct' => 0],
                ['topic' => 'Architecture', 'q' => "What is the primary purpose of a Repository + Interface binding pattern in a large Laravel application?", 'options' => ['To decouple business logic from a specific data source, easing testing and future changes', 'To speed up Blade compilation', 'To handle authentication', 'To manage file uploads'], 'correct' => 0],
                ['topic' => 'Security', 'q' => 'When securing a Laravel REST API, which approach is most appropriate for stateless token-based authentication?', 'options' => ['Laravel Sanctum or Passport issuing API tokens', 'Storing credentials in the URL', 'Session-based cookies only', 'Disabling CSRF entirely'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => "What is the benefit of using Laravel's chunk() method when processing a very large Eloquent result set?", 'options' => ['It processes records in smaller batches to reduce memory usage', 'It automatically caches all results', 'It disables model events', 'It sorts records alphabetically'], 'correct' => 0],
                ['topic' => 'Testing', 'q' => 'What is the main advantage of using database transactions in feature tests (e.g. RefreshDatabase)?', 'options' => ['Each test runs against a clean, isolated database state', 'It speeds up Blade rendering', 'It disables middleware automatically', 'It replaces the need for assertions'], 'correct' => 0],
                ['topic' => 'Architecture', 'q' => 'What is a key advantage of using Laravel Jobs + Queues for sending emails at scale?', 'options' => ['The request/response cycle is not blocked waiting for the email to send', 'Emails are guaranteed to be delivered instantly', 'It removes the need for a mail driver', 'It automatically retries failed logins'], 'correct' => 0],
                ['topic' => 'Database', 'q' => 'Why might you choose Redis over the database driver for Laravel cache and sessions in a high-traffic app?', 'options' => ['Redis is an in-memory store, offering much faster read/write than a relational database', 'Redis provides ACID transactions', 'Redis replaces Eloquent entirely', 'Redis is required for Blade to compile'], 'correct' => 0],
                ['topic' => 'Security', 'q' => 'What is the purpose of rate limiting (e.g. via RateLimiter) on a public-facing Laravel endpoint?', 'options' => ['To prevent abuse by limiting how many requests a client can make in a time window', 'To speed up database queries', 'To encrypt request payloads', 'To cache responses permanently'], 'correct' => 0],
                ['topic' => 'Architecture', 'q' => 'What is the benefit of firing a domain Event (e.g. OrderCompleted) rather than calling side-effect logic directly in a controller?', 'options' => ['It decouples side effects (emails, notifications) from the core action, keeping the controller focused and making listeners easy to add/remove', 'It makes the code run faster', 'It is required for Eloquent to work', 'It replaces the need for migrations'], 'correct' => 0],
                ['topic' => 'Queues', 'q' => 'What is the primary purpose of Laravel Horizon?', 'options' => ['A dashboard and configuration system for monitoring Redis queues', 'A load balancer', 'A caching driver', 'A database migration tool'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What does Laravel Octane primarily improve?', 'options' => ['Application performance by keeping the app booted in memory using servers like Swoole/RoadRunner', 'Database query syntax', 'Blade compilation only', 'Email delivery speed'], 'correct' => 0],
                ['topic' => 'Architecture', 'q' => 'In a multi-tenant Laravel application, what is a common strategy for isolating tenant data?', 'options' => ['Separate databases per tenant, or a shared database with a tenant_id column and global scopes', 'Storing all tenants in the same row', 'Using only session variables', 'Disabling Eloquent entirely'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What is an "N+1 query problem" in the context of Eloquent?', 'options' => ['When a query triggers one additional query per related record instead of a single eager-loaded query', 'When a migration fails to run', 'When a route matches multiple controllers', 'When more than one queue worker runs simultaneously'], 'correct' => 0],
                ['topic' => 'Database', 'q' => 'What is the benefit of using database transactions (DB::transaction()) when performing multiple related writes?', 'options' => ['Ensures all writes succeed or none are applied, maintaining data consistency', 'Makes queries run faster', 'Automatically caches the result', 'Encrypts the data'], 'correct' => 0],
                ['topic' => 'API', 'q' => 'Which approach would you use to version and safely evolve a public API without breaking existing clients?', 'options' => ['API versioning via route prefixes/namespaces (e.g. /api/v1, /api/v2)', 'Blade components', 'Middleware groups alone', 'Service providers alone'], 'correct' => 0],
                ['topic' => 'DevOps', 'q' => 'What is a key consideration when deploying a Laravel app with zero downtime?', 'options' => ['Using a strategy like atomic symlink swaps so the old version keeps serving until the new one is ready', 'Always restarting the server manually mid-deploy', 'Deleting the old release before the new one is ready', 'Skipping migrations during deploy'], 'correct' => 0],
                ['topic' => 'Security', 'q' => "Why might you use Laravel Sanctum's SPA authentication instead of exposing a bearer token to JavaScript for a first-party single-page app?", 'options' => ['It uses secure, httpOnly session cookies, reducing XSS token-theft risk', "It's the only way to authenticate any API in Laravel", 'It removes the need for CSRF protection', 'It works only with mobile apps'], 'correct' => 0],
                ['topic' => 'Eloquent', 'q' => "What is the purpose of the hidden property on an Eloquent model?", 'options' => ["To exclude specific attributes (e.g. password) from the model's array/JSON representation", 'To hide the model from Eloquent\'s query builder', 'To disable mass assignment', 'To prevent the model from being soft-deleted'], 'correct' => 0],
                ['topic' => 'Caching', 'q' => "When would you use Laravel's Cache::remember() method?", 'options' => ["To fetch a value from cache, or compute and store it if it doesn't exist yet, in one call", 'To permanently delete a cache key', 'To clear the entire cache', 'To lock a queue job'], 'correct' => 0],
                ['topic' => 'Database', 'q' => 'What is a common cause of deadlocks in a high-concurrency Laravel application using MySQL?', 'options' => ['Multiple transactions acquiring row locks on the same rows in a different order', 'Using Eloquent instead of raw SQL', 'Having too many routes defined', 'Using Blade components'], 'correct' => 0],
                ['topic' => 'Architecture', 'q' => "What is the purpose of Laravel's Pipeline pattern (Illuminate\\Pipeline), used internally by middleware?", 'options' => ['To pass an object through a series of "pipes" (classes) that can each modify or act on it', 'To handle database migrations', 'To manage queue priorities', 'To compile Blade templates'], 'correct' => 0],
                ['topic' => 'Architecture', 'q' => 'In a CQRS-inspired approach within a Laravel application, what is typically separated?', 'options' => ['The logic for writing/mutating data (commands) from the logic for reading data (queries)', 'Controllers from routes only', 'Migrations from seeders', 'Blade views from CSS'], 'correct' => 0],
                ['topic' => 'Testing', 'q' => 'What is a key benefit of using Event::fake() when testing code that dispatches Events?', 'options' => ['You can assert an event was dispatched without needing the listener\'s side effects to actually run', 'Events run faster than direct method calls', 'Events bypass validation entirely', 'Events cannot be tested'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What does php artisan optimize typically do in a production deployment?', 'options' => ['Caches configuration, routes, and events to speed up the framework\'s bootstrapping', 'Optimizes database indexes automatically', 'Minifies Blade templates', 'Compresses images in storage'], 'correct' => 0],
            ],
        ];

        foreach ($data as $levelSlug => $questions) {
            $level = QuizLevel::where('slug', $levelSlug)->first();

            if (! $level) {
                continue;
            }

            foreach ($questions as $item) {
                $question = Question::firstOrCreate(
                    [
                        'quiz_technology_id' => $technology->id,
                        'quiz_level_id' => $level->id,
                        'question_text' => $item['q'],
                    ],
                    [
                        'topic' => $item['topic'],
                        'status' => true,
                    ]
                );

                if ($question->options()->exists()) {
                    continue;
                }

                foreach ($item['options'] as $index => $optionText) {
                    $question->options()->create([
                        'option_text' => $optionText,
                        'is_correct' => $index === $item['correct'],
                        'sort_order' => $index,
                    ]);
                }
            }
        }
    }
}
