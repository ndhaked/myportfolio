<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuizLevel;
use App\Models\QuizTechnology;
use Illuminate\Database\Seeder;

class NodeJsQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $technology = QuizTechnology::where('slug', 'nodejs')->first();

        if (! $technology) {
            return;
        }

        $data = [
            'starter' => [
                ['topic' => 'Basics', 'q' => 'What is Node.js?', 'options' => ["A JavaScript runtime built on Chrome's V8 engine for running JS outside the browser", 'A CSS framework', 'A database', 'A front-end library like React'], 'correct' => 0],
                ['topic' => 'Tooling', 'q' => 'Which command initializes a new Node.js project with a package.json file?', 'options' => ['npm init', 'node init', 'npm start', 'node create'], 'correct' => 0],
                ['topic' => 'Tooling', 'q' => 'What is npm?', 'options' => ['Node Package Manager, used to install and manage JavaScript packages', 'A Node.js testing framework', 'A database driver', 'A JavaScript compiler'], 'correct' => 0],
                ['topic' => 'Modules', 'q' => 'Which built-in Node.js module is used to work with the file system?', 'options' => ['fs', 'http', 'path', 'os'], 'correct' => 0],
                ['topic' => 'Modules', 'q' => 'What does require() do in a CommonJS Node.js module?', 'options' => ['Imports a module so its exports can be used', 'Declares a variable', 'Starts the server', 'Installs a package'], 'correct' => 0],
                ['topic' => 'Tooling', 'q' => "Which file lists a Node.js project's dependencies and scripts?", 'options' => ['package.json', 'node.config.js', 'dependencies.json', 'index.json'], 'correct' => 0],
                ['topic' => 'Modules', 'q' => 'Which built-in module allows creating an HTTP server in Node.js?', 'options' => ['http', 'fs', 'path', 'url'], 'correct' => 0],
                ['topic' => 'Tooling', 'q' => 'What is the purpose of the node_modules folder?', 'options' => ['It stores the installed npm packages/dependencies for the project', 'It stores compiled binaries only', 'It stores environment variables', "It stores the application's source code exclusively"], 'correct' => 0],
                ['topic' => 'Tooling', 'q' => 'What does "npm install" (with no package name) do?', 'options' => ['Installs all dependencies listed in package.json', 'Installs Node.js itself', 'Updates Node.js to the latest version', 'Removes all installed packages'], 'correct' => 0],
                ['topic' => 'Frameworks', 'q' => 'What is Express.js commonly used for in a Node.js application?', 'options' => ['A minimal web framework for building HTTP servers and APIs', 'A database ORM', 'A CSS preprocessor', 'A testing framework only'], 'correct' => 0],
                ['topic' => 'Concurrency', 'q' => 'Is Node.js single-threaded or multi-threaded by default for JavaScript execution?', 'options' => ['Single-threaded (using an event loop for concurrency)', 'Always multi-threaded like Java', 'It has no threading model', 'It requires manual thread creation for any code to run'], 'correct' => 0],
                ['topic' => 'Configuration', 'q' => 'What does the .env file typically store in a Node.js project?', 'options' => ['Environment-specific configuration values and secrets', 'Compiled JavaScript output', 'npm package versions only', 'HTML templates'], 'correct' => 0],
            ],
            'intermediate' => [
                ['topic' => 'Event Loop', 'q' => 'What is the Node.js event loop responsible for?', 'options' => ['Handling asynchronous operations by processing the callback/task queue without blocking the main thread', 'Compiling JavaScript to machine code', 'Managing CSS animations', 'Rendering HTML'], 'correct' => 0],
                ['topic' => 'Async', 'q' => 'What is "callback hell" in Node.js/JavaScript?', 'options' => ['Deeply nested callbacks that make asynchronous code hard to read and maintain', 'A server crash caused by too many requests', 'A type of memory leak', 'A security vulnerability specific to Express'], 'correct' => 0],
                ['topic' => 'Async', 'q' => 'What do Promises in JavaScript help solve?', 'options' => ['Managing asynchronous operations more cleanly than nested callbacks, with .then()/.catch() chaining', 'Managing CSS styling', 'Compiling TypeScript', 'Handling only synchronous code'], 'correct' => 0],
                ['topic' => 'Async', 'q' => 'What does async/await do in JavaScript?', 'options' => ['Provides syntax to write asynchronous code that reads like synchronous code, built on top of Promises', 'Makes code run on multiple threads', 'Replaces the need for a server', 'Converts JavaScript to another language'], 'correct' => 0],
                ['topic' => 'Express', 'q' => 'What is middleware in the context of an Express.js application?', 'options' => ['Functions with access to the request/response objects that can execute code, modify them, or end the cycle before the next handler', 'A database connection pool', 'A CSS framework', 'A frontend routing library'], 'correct' => 0],
                ['topic' => 'Tooling', 'q' => 'What is the purpose of the package-lock.json file?', 'options' => ['Locks the exact versions of installed dependencies for consistent installs across environments', 'Stores compiled JavaScript', "Stores the application's environment variables", 'Replaces package.json entirely'], 'correct' => 0],
                ['topic' => 'Configuration', 'q' => 'What is a common way to handle environment variables securely in a Node.js app?', 'options' => ['Using a library like dotenv to load them from a .env file excluded from version control', 'Hardcoding them directly in source files', 'Storing them in package.json', 'Committing them to a public repository'], 'correct' => 0],
                ['topic' => 'Tooling', 'q' => 'What is the difference between dependencies and devDependencies in package.json?', 'options' => ['dependencies are needed in production, devDependencies are only needed during development', 'They are functionally identical', 'devDependencies are installed automatically in production', 'dependencies are optional'], 'correct' => 0],
                ['topic' => 'API', 'q' => 'What does REST stand for in the context of a Node.js REST API?', 'options' => ['Representational State Transfer', 'Remote Execution State Transfer', 'Reliable Endpoint Service Transfer', 'Rapid Estimation of Server Traffic'], 'correct' => 0],
                ['topic' => 'Security', 'q' => 'What is the purpose of JWT (JSON Web Tokens) in a Node.js API?', 'options' => ['To securely transmit claims (e.g. user identity) between parties as a compact, signed token, for stateless authentication', 'To style API responses', 'To compress JSON payloads', 'To define database schemas'], 'correct' => 0],
                ['topic' => 'Operations', 'q' => 'What is the purpose of a Node.js process manager like PM2?', 'options' => ['Keeping a Node.js application running in production, restarting it on crashes, and managing logs/clustering', 'Compiling TypeScript', 'Managing CSS', 'Writing unit tests'], 'correct' => 0],
                ['topic' => 'Security', 'q' => 'What does CORS (Cross-Origin Resource Sharing) middleware handle in an Express app?', 'options' => ['Controlling which origins are allowed to make requests to the API from a browser', 'Compressing responses', 'Caching database queries', 'Encrypting request bodies'], 'correct' => 0],
                ['topic' => 'Streams', 'q' => 'What is the purpose of Node.js Streams?', 'options' => ['Processing data (e.g. large files) incrementally in chunks rather than loading it all into memory at once', 'Styling terminal output', 'Managing environment variables', 'Handling routing only'], 'correct' => 0],
                ['topic' => 'Testing', 'q' => 'Which testing framework is commonly used for unit testing in Node.js?', 'options' => ['Jest (or Mocha)', 'Selenium only', 'Webpack', 'Babel'], 'correct' => 0],
                ['topic' => 'Scaling', 'q' => 'What is the purpose of the cluster module in Node.js?', 'options' => ['Allows a Node.js app to take advantage of multi-core systems by forking multiple worker processes', 'Clusters database records', 'Compiles code faster', 'Manages CSS media queries'], 'correct' => 0],
                ['topic' => 'Database', 'q' => 'What is an ORM like Sequelize or Prisma used for in a Node.js app?', 'options' => ['Mapping JavaScript objects to database records, abstracting raw SQL queries', 'Styling HTML templates', 'Managing HTTP routing exclusively', 'Compiling TypeScript'], 'correct' => 0],
                ['topic' => 'API', 'q' => 'What HTTP status code would a well-designed REST API return for a successfully created resource?', 'options' => ['201 Created', '200 OK only', '404 Not Found', '500 Internal Server Error'], 'correct' => 0],
            ],
            'senior' => [
                ['topic' => 'Concurrency', 'q' => 'Since Node.js is single-threaded for JS execution, how does it handle CPU-intensive tasks without blocking the event loop?', 'options' => ['Offloading them to worker threads, child processes, or external services rather than running them synchronously on the main thread', 'It automatically becomes multi-threaded', 'It cannot handle them at all', 'It pauses all other requests indefinitely by design'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What is a memory leak in a long-running Node.js server process typically caused by?', 'options' => ['References to objects (e.g. in closures, caches, or event listeners) that are never released, preventing garbage collection', 'Using async/await', 'Having too many routes', 'Using Express instead of a raw HTTP server'], 'correct' => 0],
                ['topic' => 'Scaling', 'q' => 'What is the purpose of horizontally scaling a Node.js application (e.g. with the cluster module or multiple containers)?', 'options' => ['Running multiple instances to handle more concurrent load, since each Node.js process only uses one CPU core for JS execution', 'Making a single process run faster', 'Reducing memory usage to zero', 'Removing the need for a database'], 'correct' => 0],
                ['topic' => 'Streams', 'q' => 'What is backpressure in the context of Node.js Streams?', 'options' => ['A mechanism to prevent a fast data producer from overwhelming a slower consumer by pausing/resuming the flow', 'A type of network firewall', 'A caching strategy', 'A database locking mechanism'], 'correct' => 0],
                ['topic' => 'Deployment', 'q' => 'What is a common strategy for achieving zero-downtime deployments of a Node.js application?', 'options' => ['Using a process manager or orchestrator to gracefully swap old processes for new ones', 'Always stopping the server manually before deploying', 'Deleting the old code before starting the new version', 'Restarting the server randomly during peak traffic'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => "Why is it important to avoid synchronous (blocking) file system calls like fs.readFileSync in a high-throughput Node.js server's request handler?", 'options' => ['They block the single event loop thread, delaying all other concurrent requests until the operation completes', 'They are deprecated and throw errors', 'They only work in the browser', 'They automatically crash the process'], 'correct' => 0],
                ['topic' => 'Architecture', 'q' => 'What is the benefit of using a message queue (e.g. RabbitMQ, Redis, Kafka) alongside a Node.js API?', 'options' => ['Decoupling and deferring time-consuming work to be processed asynchronously outside the request/response cycle', 'Replacing the need for a database entirely', 'Making all code synchronous', 'Compiling JavaScript faster'], 'correct' => 0],
                ['topic' => 'Security', 'q' => 'What is a common security concern when using eval() or dynamically constructing code from user input in Node.js?', 'options' => ['It can allow arbitrary code execution if untrusted input reaches it, a serious injection vulnerability', 'It only affects browser-side JavaScript', 'It always improves performance', 'It is required for JSON parsing'], 'correct' => 0],
                ['topic' => 'Deployment', 'q' => 'What is the purpose of graceful shutdown handling (e.g. listening for SIGTERM) in a containerized Node.js application?', 'options' => ['Allowing in-flight requests to finish and connections to close cleanly before the process exits', "Speeding up the container's build time", 'Preventing the app from ever restarting', 'Disabling all logging'], 'correct' => 0],
                ['topic' => 'Tooling', 'q' => 'What is the main advantage of using TypeScript in a large Node.js codebase?', 'options' => ['Static typing catches many errors at compile time and improves maintainability/tooling in large codebases', 'It makes JavaScript run natively faster than plain JS at runtime', 'It removes the need for testing', 'It replaces Node.js entirely'], 'correct' => 0],
                ['topic' => 'Security', 'q' => 'What is a common approach to rate-limiting a public Node.js API to prevent abuse?', 'options' => ['Using middleware (e.g. token bucket/sliding window) backed by an in-memory or Redis store to cap requests per client', 'Disabling the API entirely during high traffic', "Increasing the server's RAM only", 'Removing all authentication'], 'correct' => 0],
                ['topic' => 'Scaling', 'q' => 'Why might you use Redis for session storage in a horizontally-scaled Node.js application (multiple server instances)?', 'options' => ['It provides a centralized, fast, shared store so any instance can read/write the same session data', "It's the only way to use cookies", 'It replaces the need for HTTPS', 'It removes the need for authentication'], 'correct' => 0],
                ['topic' => 'Reliability', 'q' => 'What is a common cause of an "unhandled promise rejection" crash in a Node.js app?', 'options' => ['A rejected Promise (e.g. a failed async operation) with no .catch() or try/catch to handle the error', 'Using too many await keywords', 'Having too many routes defined', 'Using CommonJS instead of ES modules'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What is the benefit of connection pooling for a database client used in a high-traffic Node.js API?', 'options' => ['Reusing a limited set of open database connections instead of opening/closing one per request, reducing overhead', 'Encrypting all database traffic automatically', 'Making queries run in parallel by default', 'Removing the need for indexes'], 'correct' => 0],
                ['topic' => 'API Design', 'q' => 'What does idempotency mean for an API endpoint, and why does it matter for a Node.js payment/webhook handler?', 'options' => ['Calling the same request multiple times produces the same result without unintended side effects — critical for safely retrying webhooks', 'The endpoint can only be called once ever', 'The endpoint always returns a random response', 'It refers to how fast the endpoint responds'], 'correct' => 0],
                ['topic' => 'Security', 'q' => 'What is a key reason to validate and sanitize all incoming request data in a Node.js API, even if the frontend already validates it?', 'options' => ['The API can be called directly (bypassing the frontend), so server-side validation is the actual security boundary', 'Frontend validation is always sufficient on its own', 'Validation slows down the event loop unacceptably', 'Node.js validates all input automatically'], 'correct' => 0],
                ['topic' => 'Observability', 'q' => 'What is the purpose of structured logging (e.g. JSON logs with request IDs) in a production Node.js service?', 'options' => ['Making logs easier to search, filter, and correlate across a distributed system, especially for debugging under load', 'Reducing the size of the codebase', 'Replacing the need for monitoring tools entirely', 'Automatically fixing bugs'], 'correct' => 0],
            ],
        ];

        $this->seedQuestions($technology, $data);
    }

    protected function seedQuestions(QuizTechnology $technology, array $data): void
    {
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
                    ['topic' => $item['topic'], 'status' => true]
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
