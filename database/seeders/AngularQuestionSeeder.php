<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuizLevel;
use App\Models\QuizTechnology;
use Illuminate\Database\Seeder;

class AngularQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $technology = QuizTechnology::where('slug', 'angular')->first();

        if (! $technology) {
            return;
        }

        $data = [
            'starter' => [
                ['topic' => 'Basics', 'q' => 'What is Angular primarily used for?', 'options' => ['Building dynamic single-page web applications (SPAs) with a component-based architecture', 'Styling static HTML pages only', 'Managing databases', 'Running server-side PHP code'], 'correct' => 0],
                ['topic' => 'Tooling', 'q' => 'Which command-line tool is commonly used to create and manage Angular projects?', 'options' => ['Angular CLI (ng)', 'npm CLI only', 'Angular Studio', 'ng-create'], 'correct' => 0],
                ['topic' => 'Components', 'q' => 'What is a Component in Angular?', 'options' => ['A building block that controls a portion of the UI, combining a template, class, and metadata', 'A database table', 'A CSS file only', 'A routing configuration file'], 'correct' => 0],
                ['topic' => 'Basics', 'q' => 'What language are Angular applications primarily written in?', 'options' => ['TypeScript', 'PHP', 'Python', 'Ruby'], 'correct' => 0],
                ['topic' => 'Components', 'q' => "What is a Template in Angular?", 'options' => ["The HTML that defines a component's view", 'A JavaScript testing file', 'A backend API route', 'A database migration'], 'correct' => 0],
                ['topic' => 'Components', 'q' => 'Which decorator defines a class as an Angular Component?', 'options' => ['@Component', '@Injectable', '@NgModule', '@Directive'], 'correct' => 0],
                ['topic' => 'Data Binding', 'q' => 'What is data binding used for in Angular?', 'options' => ["Synchronizing data between a component's class and its template", 'Connecting to a database directly', 'Compiling TypeScript', 'Styling components'], 'correct' => 0],
                ['topic' => 'Directives', 'q' => 'What is the purpose of Angular\'s *ngFor directive?', 'options' => ['Repeating a template element for each item in a collection', 'Conditionally hiding an element', 'Binding a form input', 'Routing to another page'], 'correct' => 0],
                ['topic' => 'Directives', 'q' => 'What is the purpose of Angular\'s *ngIf directive?', 'options' => ['Conditionally including or removing an element from the DOM', 'Looping over a collection', 'Styling an element', 'Fetching data from an API'], 'correct' => 0],
                ['topic' => 'Modules', 'q' => 'What file typically defines the root module of an Angular application?', 'options' => ['app.module.ts', 'app.component.html', 'index.html', 'package.json'], 'correct' => 0],
                ['topic' => 'Services', 'q' => 'What is an Angular Service typically used for?', 'options' => ['Encapsulating reusable business logic or data-fetching code shared across components', 'Defining the visual layout only', 'Styling components with CSS', 'Compiling the application'], 'correct' => 0],
                ['topic' => 'Services', 'q' => 'How does Angular commonly provide a Service to a component?', 'options' => ["Through dependency injection, typically via the component's constructor", 'By copying the service file into every component folder', 'By writing it directly inside index.html', 'By using global JavaScript variables only'], 'correct' => 0],
            ],
            'intermediate' => [
                ['topic' => 'Dependency Injection', 'q' => "What is the purpose of Angular's Dependency Injection system?", 'options' => ["Providing a class's dependencies (like services) to it automatically rather than having it construct them itself", 'Compiling templates faster', 'Styling components', 'Managing routing only'], 'correct' => 0],
                ['topic' => 'RxJS', 'q' => 'What is RxJS commonly used for in Angular applications?', 'options' => ['Handling asynchronous data streams (e.g. HTTP responses, user events) using Observables', 'Styling components with reactive CSS', 'Compiling TypeScript to JavaScript', 'Managing routing exclusively'], 'correct' => 0],
                ['topic' => 'RxJS', 'q' => 'What is the difference between an Observable and a Promise in Angular/RxJS?', 'options' => ['An Observable can emit multiple values over time and is cancellable, while a Promise resolves once with a single value', 'They are functionally identical', 'A Promise can emit multiple values but an Observable cannot', 'Observables only work with HTTP calls'], 'correct' => 0],
                ['topic' => 'HTTP', 'q' => "What is Angular's HttpClient module used for?", 'options' => ['Making HTTP requests to backend APIs from an Angular application', 'Styling HTTP error pages', 'Compiling Angular templates', 'Managing local component state only'], 'correct' => 0],
                ['topic' => 'Routing', 'q' => 'What is the purpose of Angular Routing (RouterModule)?', 'options' => ['Enabling navigation between different views/components within a single-page application', 'Making HTTP requests', 'Styling components', 'Managing forms'], 'correct' => 0],
                ['topic' => 'Routing', 'q' => 'What is a Guard in Angular routing used for?', 'options' => ['Controlling whether a user can navigate to or away from a route (e.g. for authentication checks)', 'Styling route transitions', 'Compiling routes faster', 'Storing route history only'], 'correct' => 0],
                ['topic' => 'Forms', 'q' => 'What is the difference between Template-driven and Reactive forms in Angular?', 'options' => ['Reactive forms are built and managed programmatically in the component class, while template-driven forms rely more on template directives', 'They are the same feature with different names', "Reactive forms don't support validation", 'Template-driven forms only work with buttons'], 'correct' => 0],
                ['topic' => 'Change Detection', 'q' => "What is Angular's change detection mechanism responsible for?", 'options' => ['Detecting when component data changes and updating the DOM/view accordingly', 'Detecting syntax errors at compile time', 'Managing HTTP retries', 'Compressing production builds'], 'correct' => 0],
                ['topic' => 'Lifecycle', 'q' => "What is the purpose of ngOnInit() in an Angular component's lifecycle?", 'options' => ["A lifecycle hook that runs once after the component's inputs are initialized, commonly used for setup logic", 'It runs on every change detection cycle', 'It only runs when the component is destroyed', 'It replaces the constructor entirely'], 'correct' => 0],
                ['topic' => 'Pipes', 'q' => 'What is a Pipe used for in Angular templates?', 'options' => ['Transforming displayed data in a template (e.g. formatting dates, currency) without changing the underlying value', 'Making HTTP requests', 'Defining routes', 'Injecting services'], 'correct' => 0],
                ['topic' => 'Modules', 'q' => 'What is the purpose of Angular Modules (NgModule)?', 'options' => ['Organizing an application into cohesive blocks of functionality, declaring components/directives/pipes and their dependencies', 'Styling the entire application', 'Making HTTP requests', 'Managing the build process only'], 'correct' => 0],
                ['topic' => 'Forms', 'q' => 'What is two-way data binding syntax in Angular (using ngModel)?', 'options' => ['[(ngModel)]', '{{ ngModel }}', '[ngModel]', '(ngModel)='], 'correct' => 0],
                ['topic' => 'Pipes', 'q' => "What is the purpose of Angular's async pipe?", 'options' => ['Automatically subscribing to an Observable or Promise in a template and unwrapping its emitted value', 'Making a component load asynchronously', 'Delaying route navigation', 'Compressing HTTP responses'], 'correct' => 0],
                ['topic' => 'Routing', 'q' => 'What is lazy loading in the context of Angular routing?', 'options' => ['Loading feature modules only when their route is visited, reducing the initial bundle size', 'Loading all modules immediately regardless of use', 'Delaying the entire app\'s startup indefinitely', 'A CSS animation technique'], 'correct' => 0],
                ['topic' => 'HTTP', 'q' => 'What is the purpose of an Angular Interceptor?', 'options' => ['Intercepting outgoing HTTP requests or incoming responses globally, useful for adding auth headers or handling errors', 'Intercepting keyboard events only', 'Styling components before render', 'Compiling templates'], 'correct' => 0],
                ['topic' => 'Components', 'q' => "What is Angular's @Input() decorator used for?", 'options' => ['Passing data from a parent component into a child component', 'Emitting events from a child to a parent', 'Injecting a service', 'Defining a route parameter'], 'correct' => 0],
                ['topic' => 'Components', 'q' => "What is Angular's @Output() decorator used for?", 'options' => ['Emitting custom events from a child component to a parent component, typically using EventEmitter', 'Receiving data from a parent component', "Styling the component's output", 'Injecting a service'], 'correct' => 0],
            ],
            'senior' => [
                ['topic' => 'Performance', 'q' => "What is Angular's Ahead-of-Time (AOT) compilation, and why is it used in production builds?", 'options' => ['Compiling templates to JavaScript during the build rather than in the browser at runtime, improving load performance and catching template errors earlier', 'A way to compile CSS only', 'A testing framework', 'A deprecated feature with no benefit'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What is the OnPush change detection strategy used for in Angular, and why does it help performance?', 'options' => ['It tells Angular to only check a component when its Input references change (or an event fires), reducing unnecessary change detection cycles', 'It disables change detection entirely', 'It forces change detection on every animation frame', 'It only affects routing performance'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What is a common strategy to reduce the initial bundle size of a large Angular application?', 'options' => ['Lazy-loading feature modules and using route-level code splitting', 'Combining all modules into a single eager-loaded bundle', 'Disabling AOT compilation', 'Removing TypeScript types'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => "What is the purpose of Angular's trackBy function with *ngFor?", 'options' => ['Helping Angular identify which items changed, were added, or removed, avoiding unnecessary DOM re-renders', 'Tracking user analytics events', 'Compiling the template faster at build time', 'Styling list items'], 'correct' => 0],
                ['topic' => 'Memory', 'q' => 'What is a memory leak commonly caused by in a long-lived Angular single-page application?', 'options' => ['Subscribing to an Observable (e.g. in ngOnInit) without unsubscribing when the component is destroyed', 'Using the async pipe exclusively', 'Using OnPush change detection', 'Using standalone components'], 'correct' => 0],
                ['topic' => 'Architecture', 'q' => 'Why might a large enterprise Angular application be structured into multiple feature modules with a shared/core module pattern?', 'options' => ['To improve maintainability, enable lazy loading per feature, and enforce clear boundaries between application areas', 'Because Angular requires at least 3 modules to run', 'To avoid using TypeScript', 'Because components cannot be reused otherwise'], 'correct' => 0],
                ['topic' => 'SSR', 'q' => 'What does server-side rendering (SSR) with Angular Universal primarily improve?', 'options' => ['Initial page load performance and SEO, by rendering the initial view on the server before sending it to the browser', 'Database query speed', 'Only offline support', 'Compile-time type checking'], 'correct' => 0],
                ['topic' => 'State Management', 'q' => 'What is a common approach to state management in a large Angular application beyond simple services with Subjects?', 'options' => ['Using a dedicated state management library (e.g. NgRx) implementing a Redux-like pattern', "Storing all state in the browser's URL only", 'Avoiding services entirely and using only template variables', 'Using cookies exclusively for all state'], 'correct' => 0],
                ['topic' => 'Tooling', 'q' => 'What is the benefit of using strict mode in a large Angular/TypeScript codebase?', 'options' => ['Catching more potential type errors at compile time, improving code reliability in a large team', 'Making the app run faster at runtime', 'Removing the need for unit tests', 'Disabling change detection'], 'correct' => 0],
                ['topic' => 'Architecture', 'q' => 'What is a Standalone Component in modern Angular, and what problem does it address?', 'options' => ["A component that doesn't need to be declared in an NgModule, simplifying the module system and reducing boilerplate", 'A component that cannot use services', 'A deprecated Angular 1.x concept', 'A component only used for testing'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'Why is it important to avoid heavy computation directly inside an Angular template expression?', 'options' => ['Template expressions can be re-evaluated on every change detection cycle, so expensive logic there can significantly hurt performance', 'Templates cannot execute any JavaScript expressions at all', 'It causes a compile-time error', 'It only affects unit tests'], 'correct' => 0],
                ['topic' => 'Security', 'q' => 'What is a key security consideration when binding user-generated content with [innerHTML] in Angular?', 'options' => ['Angular sanitizes it by default, but bypassing sanitization can introduce XSS if the content is not trusted', 'innerHTML binding is always completely safe with no risk', 'Angular blocks all HTML rendering entirely', 'It only matters for Angular 1.x applications'], 'correct' => 0],
                ['topic' => 'Internals', 'q' => 'What is the purpose of Zone.js in Angular, and why do some advanced apps run code "outside the Angular zone"?', 'options' => ['Zone.js triggers change detection automatically after async operations; running code outside it avoids unnecessary change detection for things like frequent timers', 'Zone.js only compiles CSS', 'It replaces the need for RxJS entirely', 'It is used exclusively for routing'], 'correct' => 0],
                ['topic' => 'Testing', 'q' => 'What is a common strategy for testing Angular components in isolation?', 'options' => ["Using Angular's TestBed to create a testing module and render the component with mocked dependencies", 'Only testing via manual browser clicks', 'Testing is not possible in Angular', 'Using only end-to-end tests for every component'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What is differential loading in an Angular production build?', 'options' => ['Serving modern JavaScript bundles to modern browsers and legacy-compatible bundles to older browsers', 'Loading different CSS themes per user', 'A database sharding technique', 'A routing strategy for lazy modules only'], 'correct' => 0],
                ['topic' => 'Architecture', 'q' => 'Why might you use a facade service pattern in front of NgRx or other state management in a large Angular app?', 'options' => ['To provide components with a simplified API for interacting with state, decoupling them from the underlying implementation details', 'To bypass all state management entirely', 'Because components cannot inject services directly', 'To disable change detection'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What is a key performance consideration when rendering a very large list (thousands of items) in Angular?', 'options' => ["Using virtual scrolling (e.g. Angular CDK's virtual scroll) to render only the visible items in the viewport", 'Always rendering all items with *ngFor regardless of list size', 'Disabling trackBy', 'Using synchronous HTTP calls for each item'], 'correct' => 0],
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
