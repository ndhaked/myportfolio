<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuizLevel;
use App\Models\QuizTechnology;
use Illuminate\Database\Seeder;

class DevOpsQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $technology = QuizTechnology::where('slug', 'devops')->first();

        if (! $technology) {
            return;
        }

        $data = [
            'starter' => [
                ['topic' => 'CI/CD', 'q' => 'What does CI/CD stand for?', 'options' => ['Continuous Integration / Continuous Deployment (or Delivery)', 'Code Integration / Code Deployment', 'Central Infrastructure / Central Database', 'Continuous Iteration / Continuous Debugging'], 'correct' => 0],
                ['topic' => 'Version Control', 'q' => 'What is the primary purpose of version control systems like Git in a DevOps workflow?', 'options' => ['Tracking changes to code over time and enabling collaboration between multiple developers', 'Deploying applications to production', 'Monitoring server uptime', 'Managing DNS records'], 'correct' => 0],
                ['topic' => 'Containers', 'q' => 'What is a container (e.g. Docker) primarily used for?', 'options' => ['Packaging an application with its dependencies so it runs consistently across different environments', 'Storing database backups only', 'Managing DNS records', 'Writing unit tests'], 'correct' => 0],
                ['topic' => 'Containers', 'q' => 'What does the command "docker build" do?', 'options' => ['Builds a Docker image from a Dockerfile', 'Starts a running container', 'Deletes a Docker image', 'Pushes an image to a registry'], 'correct' => 0],
                ['topic' => 'Containers', 'q' => 'What does the command "docker run" do?', 'options' => ['Creates and starts a new container from an image', 'Only builds an image', 'Only stops a container', 'Deletes all images'], 'correct' => 0],
                ['topic' => 'Version Control', 'q' => 'What is the purpose of a .gitignore file?', 'options' => ['Specifying files/folders that Git should not track or commit', 'Listing all files that must be committed', 'Configuring a CI/CD pipeline', 'Defining environment variables'], 'correct' => 0],
                ['topic' => 'Configuration', 'q' => 'What is the purpose of an environment variable in a deployment pipeline?', 'options' => ['Storing configuration that varies between environments without hardcoding it in the source code', "Storing the application's source code", 'Compiling the application', 'Replacing version control'], 'correct' => 0],
                ['topic' => 'IaC', 'q' => 'What is a basic definition of "infrastructure as code" (IaC)?', 'options' => ['Managing and provisioning infrastructure through machine-readable configuration files rather than manual processes', 'Writing application business logic', 'A type of database schema', 'A frontend framework'], 'correct' => 0],
                ['topic' => 'Networking', 'q' => 'What is the purpose of a load balancer in a basic web infrastructure setup?', 'options' => ['Distributing incoming traffic across multiple servers to improve availability and performance', 'Compiling application code', 'Storing application logs', 'Managing DNS records exclusively'], 'correct' => 0],
                ['topic' => 'Monitoring', 'q' => 'What does "uptime monitoring" typically track for a web application?', 'options' => ['Whether the application/server is available and responding to requests', 'The number of lines of code', 'The number of Git commits', 'The size of the database only'], 'correct' => 0],
                ['topic' => 'Security', 'q' => 'What is the purpose of a firewall in basic server security?', 'options' => ['Controlling incoming and outgoing network traffic based on defined security rules', 'Compiling application code', 'Managing Git branches', 'Formatting the database'], 'correct' => 0],
                ['topic' => 'Operations', 'q' => 'What is the purpose of a backup strategy for a production server/database?', 'options' => ['Being able to restore data/state in case of failure, corruption, or accidental deletion', 'Speeding up normal application requests', 'Compiling the application faster', 'Replacing the need for monitoring'], 'correct' => 0],
            ],
            'intermediate' => [
                ['topic' => 'CI/CD', 'q' => 'What is the difference between Continuous Delivery and Continuous Deployment?', 'options' => ['Continuous Delivery means code is always ready to deploy but requires a manual trigger, while Continuous Deployment automatically deploys every change that passes tests', 'They are identical processes', 'Continuous Deployment requires manual approval while Delivery does not', 'Delivery only applies to mobile apps'], 'correct' => 0],
                ['topic' => 'Containers', 'q' => 'What is the purpose of a Dockerfile?', 'options' => ['A script defining the steps to build a Docker image (base image, dependencies, commands)', 'A file storing container logs', 'A database migration file', 'A Kubernetes deployment manifest'], 'correct' => 0],
                ['topic' => 'Containers', 'q' => 'What is Docker Compose primarily used for?', 'options' => ['Defining and running multi-container Docker applications using a single YAML configuration file', 'Building a single Docker image only', 'Managing Git branches', 'Compiling application code'], 'correct' => 0],
                ['topic' => 'Networking', 'q' => 'What is the purpose of a reverse proxy (e.g. Nginx) in front of an application server?', 'options' => ['Forwarding client requests to backend servers, commonly handling SSL termination, load balancing, and caching', 'Compiling the application', 'Storing the database', 'Managing Git commits'], 'correct' => 0],
                ['topic' => 'Orchestration', 'q' => 'What is the purpose of health checks in a container orchestration setup?', 'options' => ['Allowing the orchestrator to detect and restart/replace unhealthy container instances automatically', 'Compiling the application faster', 'Encrypting network traffic', 'Managing DNS records'], 'correct' => 0],
                ['topic' => 'Deployment', 'q' => 'What is a blue-green deployment strategy?', 'options' => ['Running two identical production environments and switching traffic to the new one once verified, enabling quick rollback', 'Deploying only on Mondays and Fridays', 'A database backup schedule', 'A type of load testing'], 'correct' => 0],
                ['topic' => 'CI/CD', 'q' => 'What is the purpose of a CI pipeline running automated tests on every pull request?', 'options' => ['Catching bugs/regressions early before code is merged, improving code quality and confidence', 'Automatically deploying to production regardless of test results', 'Replacing the need for code review entirely', 'Compiling documentation'], 'correct' => 0],
                ['topic' => 'Access', 'q' => 'What does SSH commonly provide for managing a remote server?', 'options' => ['A secure, encrypted way to remotely access and execute commands on a server', 'A way to compile code faster', 'A database connection protocol', 'A frontend framework'], 'correct' => 0],
                ['topic' => 'Security', 'q' => 'What is the purpose of a secrets manager (e.g. Vault, AWS Secrets Manager) in a DevOps pipeline?', 'options' => ['Securely storing and controlling access to sensitive credentials rather than hardcoding them', 'Managing Git branches', 'Compiling application code', 'Load-balancing traffic'], 'correct' => 0],
                ['topic' => 'Orchestration', 'q' => 'What is the purpose of container orchestration tools like Kubernetes?', 'options' => ['Automating the deployment, scaling, and management of containerized applications across a cluster of machines', 'Compiling Docker images faster', 'Writing unit tests', 'Managing DNS records only'], 'correct' => 0],
                ['topic' => 'Environments', 'q' => 'What is the purpose of a staging environment in a deployment pipeline?', 'options' => ['A production-like environment used to test changes before they are released to real users', 'The environment developers write code in locally', 'A backup of the production database only', 'A type of load balancer'], 'correct' => 0],
                ['topic' => 'Observability', 'q' => 'What is log aggregation (e.g. using the ELK stack) used for?', 'options' => ['Collecting and centralizing logs from multiple servers/services for easier searching, monitoring, and debugging', 'Compiling application code', 'Managing Git repositories', 'Load-balancing traffic'], 'correct' => 0],
                ['topic' => 'CI/CD', 'q' => 'What is the purpose of a webhook in a CI/CD context (e.g. triggered on a git push)?', 'options' => ['Automatically notifying/triggering an external system (like a CI pipeline) when a specific event occurs', 'Encrypting the repository', 'Compiling code locally only', 'Managing user permissions'], 'correct' => 0],
                ['topic' => 'Deployment', 'q' => 'What does "rolling back" a deployment mean?', 'options' => ['Reverting to a previous, known-good version of the application after a problematic release', 'Restarting the server without any code change', 'Deleting the entire application', 'Merging multiple branches together'], 'correct' => 0],
                ['topic' => 'Configuration', 'q' => 'What is the purpose of environment-specific configuration files (e.g. .env.staging, .env.production)?', 'options' => ['Allowing the same codebase to run with different settings depending on which environment it is deployed to', "Storing the application's source code", 'Replacing version control', 'Compiling the application'], 'correct' => 0],
                ['topic' => 'Observability', 'q' => 'What is infrastructure monitoring/alerting (e.g. via Prometheus/Grafana) primarily used for?', 'options' => ['Tracking system metrics (CPU, memory, response times) and notifying teams when thresholds are breached', 'Compiling application code', 'Managing Git branches', 'Writing documentation'], 'correct' => 0],
                ['topic' => 'Containers', 'q' => 'What is the benefit of using a container registry (e.g. Docker Hub, ECR)?', 'options' => ['Storing and distributing versioned container images so they can be pulled and deployed consistently across environments', 'Compiling source code', 'Managing DNS records', 'Writing automated tests'], 'correct' => 0],
            ],
            'senior' => [
                ['topic' => 'IaC', 'q' => 'What is the purpose of Infrastructure as Code tools like Terraform in managing cloud infrastructure?', 'options' => ['Declaratively defining and provisioning infrastructure in version-controlled configuration, enabling repeatable and auditable changes', 'Compiling application source code', 'Writing unit tests', 'Managing Git branches only'], 'correct' => 0],
                ['topic' => 'Deployment', 'q' => 'What is a canary deployment strategy?', 'options' => ['Gradually rolling out a change to a small subset of users/servers first, monitoring for issues before a full rollout', 'Deploying to all servers simultaneously with no monitoring', 'A type of database backup', 'A load testing tool'], 'correct' => 0],
                ['topic' => 'IaC', 'q' => 'Why is idempotency an important property for infrastructure automation scripts (e.g. Ansible playbooks, Terraform)?', 'options' => ['Running the same script multiple times produces the same end state without unintended side effects, making automation safe to re-run', 'It means the script can only run once ever', 'It refers to how fast the script executes', 'It means the script requires no configuration'], 'correct' => 0],
                ['topic' => 'Microservices', 'q' => 'What is the purpose of a service mesh (e.g. Istio, Linkerd) in a microservices architecture?', 'options' => ['Managing service-to-service communication concerns like traffic routing, retries, load balancing, and observability at the infrastructure layer', 'Compiling microservice code', 'Replacing the need for containers', 'Managing DNS records only'], 'correct' => 0],
                ['topic' => 'Architecture', 'q' => 'What is a key benefit of immutable infrastructure (e.g. replacing servers instead of patching them in place)?', 'options' => ['Reduces configuration drift and makes deployments more predictable and reproducible', 'It makes servers permanently unavailable', 'It removes the need for monitoring', 'It requires manual patching of every server'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What is the purpose of a Content Delivery Network (CDN) in a production architecture?', 'options' => ['Caching and serving static assets from servers geographically closer to users, reducing latency and origin server load', 'Compiling application code', 'Managing database transactions', 'Replacing the need for a web server'], 'correct' => 0],
                ['topic' => 'Operations', 'q' => 'What is "configuration drift" in infrastructure management?', 'options' => ["Gradual, unintended divergence between a server's actual configuration and its intended/documented configuration over time", 'A type of network latency', 'A database replication delay', 'A CI pipeline failure'], 'correct' => 0],
                ['topic' => 'Scaling', 'q' => 'What is a common approach to achieve horizontal auto-scaling of a containerized application under variable load?', 'options' => ['Using an orchestrator (e.g. Kubernetes Horizontal Pod Autoscaler) to automatically adjust instance count based on metrics like CPU/memory', 'Manually adding servers only during scheduled maintenance windows', 'Always running a fixed number of instances regardless of load', 'Disabling monitoring during high traffic'], 'correct' => 0],
                ['topic' => 'Security', 'q' => 'What is the principle of least privilege in the context of DevOps security?', 'options' => ['Granting users/services only the minimum permissions necessary to perform their function, reducing the blast radius of a compromise', 'Granting all users admin access for convenience', 'Disabling all authentication', 'Giving every service the same credentials'], 'correct' => 0],
                ['topic' => 'Deployment', 'q' => 'What is a common strategy for managing database schema migrations safely as part of a zero-downtime deployment pipeline?', 'options' => ['Applying backward-compatible migrations (e.g. additive changes) before deploying new application code that depends on them', 'Always taking the application offline for any schema change', 'Running migrations only after rolling back the previous deployment', 'Skipping migrations in production entirely'], 'correct' => 0],
                ['topic' => 'Observability', 'q' => 'What is the purpose of distributed tracing (e.g. Jaeger, OpenTelemetry) in a microservices architecture?', 'options' => ['Tracking a single request as it flows across multiple services, helping diagnose latency and failures in complex systems', 'Compiling microservice code faster', 'Replacing the need for logging', 'Managing DNS records'], 'correct' => 0],
                ['topic' => 'Orchestration', 'q' => 'Why is it important to define resource limits (CPU/memory) for containers in a shared Kubernetes cluster?', 'options' => ['Preventing a single misbehaving container from starving other containers of resources on the same node', 'It has no real effect on cluster behavior', 'It only affects billing', 'It disables auto-scaling'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What is a common cause of "noisy neighbor" problems in a shared cloud/container environment?', 'options' => ['One workload consuming a disproportionate share of shared resources (CPU, disk I/O, network), degrading performance for others', 'Using too many Git branches', 'Having too many DNS records', 'Using HTTPS instead of HTTP'], 'correct' => 0],
                ['topic' => 'Reliability', 'q' => 'What is the purpose of a disaster recovery (DR) plan in production operations?', 'options' => ['Defining processes and infrastructure to restore service after a major outage or catastrophic failure, often with defined RTO/RPO targets', 'A plan for writing unit tests', 'A Git branching strategy', 'A frontend design pattern'], 'correct' => 0],
                ['topic' => 'GitOps', 'q' => 'What is GitOps?', 'options' => ['A practice of using Git as the single source of truth for declarative infrastructure and application configuration, with automated syncing to the target environment', 'A Git hosting provider', 'A type of database migration', 'A frontend testing framework'], 'correct' => 0],
                ['topic' => 'Deployment', 'q' => 'Why might a team implement feature flags as part of their deployment strategy?', 'options' => ['To decouple code deployment from feature release, enabling safer rollouts, A/B testing, and quick disabling of a feature without a full rollback', 'To permanently disable features', 'To replace version control', 'To speed up compilation'], 'correct' => 0],
                ['topic' => 'Security', 'q' => 'What is a key security consideration when building CI/CD pipelines that have access to production deployment credentials?', 'options' => ['Restricting and auditing which pipelines/branches can trigger production deployments, and avoiding exposing secrets in logs', 'Giving every branch and contributor equal deployment access', 'Storing production credentials in the repository README', 'Disabling all pipeline logging entirely'], 'correct' => 0],
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
