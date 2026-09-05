<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuizLevel;
use App\Models\QuizTechnology;
use Illuminate\Database\Seeder;

class MySqlQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $technology = QuizTechnology::where('slug', 'mysql')->first();

        if (! $technology) {
            return;
        }

        $data = [
            'starter' => [
                ['topic' => 'Querying', 'q' => 'Which SQL statement is used to retrieve data from a database?', 'options' => ['SELECT', 'GET', 'FETCH', 'RETRIEVE'], 'correct' => 0],
                ['topic' => 'Data Types', 'q' => 'Which MySQL data type is best suited for storing whole numbers?', 'options' => ['INT', 'VARCHAR', 'TEXT', 'BLOB'], 'correct' => 0],
                ['topic' => 'Constraints', 'q' => 'What does the PRIMARY KEY constraint ensure?', 'options' => ['Each row has a unique, non-null identifier', 'The column allows duplicate values', 'The column can be null', 'The table has no indexes'], 'correct' => 0],
                ['topic' => 'Querying', 'q' => 'Which clause is used to filter individual rows in a SELECT query?', 'options' => ['WHERE', 'FILTER', 'HAVING', 'ORDER BY'], 'correct' => 0],
                ['topic' => 'Querying', 'q' => 'Which command is used to add a new row to a table?', 'options' => ['INSERT INTO', 'ADD ROW', 'CREATE ROW', 'APPEND'], 'correct' => 0],
                ['topic' => 'Basics', 'q' => 'What does SQL stand for?', 'options' => ['Structured Query Language', 'Sequential Query Logic', 'Structured Question Language', 'Simple Query Language'], 'correct' => 0],
                ['topic' => 'Schema', 'q' => 'Which command permanently removes a table and its structure from a database?', 'options' => ['DROP TABLE', 'DELETE TABLE', 'REMOVE TABLE', 'TRUNCATE DATABASE'], 'correct' => 0],
                ['topic' => 'Schema', 'q' => 'Which command removes all rows from a table but keeps its structure?', 'options' => ['TRUNCATE TABLE', 'DROP TABLE', 'DELETE DATABASE', 'CLEAR TABLE'], 'correct' => 0],
                ['topic' => 'Schema', 'q' => 'Which MySQL command creates a new database?', 'options' => ['CREATE DATABASE', 'NEW DATABASE', 'MAKE DATABASE', 'ADD DATABASE'], 'correct' => 0],
                ['topic' => 'Querying', 'q' => 'What is the purpose of the ORDER BY clause?', 'options' => ['To sort the result set by one or more columns', 'To filter rows', 'To group rows', 'To join tables'], 'correct' => 0],
                ['topic' => 'Querying', 'q' => 'Which operator combines multiple conditions where both must be true?', 'options' => ['AND', 'OR', 'NOT', 'XOR'], 'correct' => 0],
                ['topic' => 'Querying', 'q' => 'What does the LIMIT clause do in a MySQL query?', 'options' => ['Restricts the number of rows returned by a query', 'Restricts the number of columns', 'Sets a maximum value for a column', 'Limits database size'], 'correct' => 0],
            ],
            'intermediate' => [
                ['topic' => 'Relationships', 'q' => 'What is the purpose of a FOREIGN KEY constraint?', 'options' => ["To enforce a link between data in two tables, referencing another table's primary key", 'To make a column unique', 'To auto-increment a column', 'To encrypt a column'], 'correct' => 0],
                ['topic' => 'Joins', 'q' => 'Which JOIN type returns only rows that have matching values in both tables?', 'options' => ['INNER JOIN', 'LEFT JOIN', 'RIGHT JOIN', 'CROSS JOIN'], 'correct' => 0],
                ['topic' => 'Joins', 'q' => 'Which JOIN type returns all rows from the left table and matched rows from the right table (NULLs where there is no match)?', 'options' => ['LEFT JOIN', 'INNER JOIN', 'RIGHT JOIN', 'SELF JOIN'], 'correct' => 0],
                ['topic' => 'Aggregation', 'q' => 'What is the purpose of the GROUP BY clause?', 'options' => ['To group rows sharing a value so aggregate functions can be applied per group', 'To sort rows alphabetically', 'To filter individual rows', 'To join two tables'], 'correct' => 0],
                ['topic' => 'Aggregation', 'q' => 'Which clause filters groups after a GROUP BY, rather than individual rows?', 'options' => ['HAVING', 'WHERE', 'FILTER', 'ON'], 'correct' => 0],
                ['topic' => 'Design', 'q' => 'What is database normalization primarily used for?', 'options' => ['Reducing data redundancy and improving data integrity', 'Making queries run faster automatically', 'Encrypting sensitive data', 'Increasing storage size'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What does an INDEX in MySQL primarily improve?', 'options' => ['The speed of data retrieval on the indexed column(s)', 'The speed of INSERT statements only', 'Data encryption', 'Table storage compression'], 'correct' => 0],
                ['topic' => 'Storage Engines', 'q' => 'Which MySQL storage engine supports foreign keys and transactions (the modern default)?', 'options' => ['InnoDB', 'MyISAM', 'MEMORY', 'CSV'], 'correct' => 0],
                ['topic' => 'Transactions', 'q' => 'What is a MySQL transaction primarily used for?', 'options' => ['Grouping multiple statements so they all succeed or all fail together (ACID)', 'Speeding up SELECT queries', 'Compressing table data', 'Creating backups'], 'correct' => 0],
                ['topic' => 'Schema', 'q' => "Which SQL command modifies an existing table's structure (e.g. add a column)?", 'options' => ['ALTER TABLE', 'MODIFY TABLE', 'CHANGE TABLE', 'UPDATE TABLE'], 'correct' => 0],
                ['topic' => 'Constraints', 'q' => 'What does the UNIQUE constraint enforce?', 'options' => ['All values in a column (or set of columns) must be distinct', 'The column must be a primary key', 'The column cannot be indexed', 'The column must be numeric'], 'correct' => 0],
                ['topic' => 'Views', 'q' => 'What is the purpose of a database view in MySQL?', 'options' => ['A stored virtual table based on the result of a SELECT query', 'A physical copy of a table', 'A type of index', 'A backup mechanism'], 'correct' => 0],
                ['topic' => 'Aggregation', 'q' => 'Which function counts the number of rows returned by a query?', 'options' => ['COUNT()', 'SUM()', 'TOTAL()', 'LENGTH()'], 'correct' => 0],
                ['topic' => 'Joins', 'q' => 'What is a self join used for?', 'options' => ['Joining a table to itself, often to compare rows within the same table', 'Joining two unrelated tables', 'Automatically joining all tables in a database', 'Removing duplicate rows'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What does the EXPLAIN statement do in MySQL?', 'options' => ['Shows how MySQL executes a query, useful for performance analysis', 'Explains column data types', 'Documents the schema', 'Translates SQL to another language'], 'correct' => 0],
                ['topic' => 'Data Types', 'q' => 'What is the difference between CHAR and VARCHAR data types?', 'options' => ['CHAR is fixed-length while VARCHAR is variable-length', 'CHAR stores numbers, VARCHAR stores only dates', 'They are functionally identical', 'CHAR is always larger'], 'correct' => 0],
                ['topic' => 'Querying', 'q' => 'Which statement changes existing data in a table?', 'options' => ['UPDATE', 'CHANGE', 'MODIFY', 'SET'], 'correct' => 0],
            ],
            'senior' => [
                ['topic' => 'Performance', 'q' => 'What is the primary benefit of proper indexing on a large, frequently-queried MySQL table?', 'options' => ['Faster lookups on indexed columns, at the cost of slightly slower writes', 'Reduces table size to zero', 'Removes the need for backups', 'Automatically normalizes the schema'], 'correct' => 0],
                ['topic' => 'Indexing', 'q' => 'What is a composite index?', 'options' => ['An index that spans multiple columns, useful for queries that filter/sort on those columns together', 'An index that only works on primary keys', 'An index stored outside the database', 'An index that compresses data'], 'correct' => 0],
                ['topic' => 'Transactions', 'q' => 'What isolation level does InnoDB use by default?', 'options' => ['REPEATABLE READ', 'READ UNCOMMITTED', 'SERIALIZABLE', 'READ COMMITTED'], 'correct' => 0],
                ['topic' => 'Concurrency', 'q' => 'What is a deadlock in MySQL?', 'options' => ["A situation where two or more transactions are waiting on each other's locks, and none can proceed", 'A crashed database server', 'A corrupted index', 'A slow query'], 'correct' => 0],
                ['topic' => 'Scaling', 'q' => 'What is database replication primarily used for?', 'options' => ['Copying data from a master to one or more replicas for read scaling and high availability', 'Compressing the database', 'Encrypting data at rest', 'Formatting the schema'], 'correct' => 0],
                ['topic' => 'Scaling', 'q' => 'What is database sharding?', 'options' => ['Splitting a large database horizontally across multiple servers to distribute load', 'Backing up a database', 'Merging two databases into one', 'Encrypting table columns'], 'correct' => 0],
                ['topic' => 'Indexing', 'q' => 'When would you use a covering index?', 'options' => ['When an index contains all the columns needed to satisfy a query, avoiding a lookup into the full table row', 'When you want to index every column in a table', 'When you need to encrypt an index', 'When a table has no primary key'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => "What is the N+1 query problem in the context of a database-backed application?", 'options' => ['Running one query to fetch a list, then one additional query per item to fetch related data, instead of a single joined/eager query', 'Running exactly 2 queries per request', 'A type of SQL syntax error', 'A database backup strategy'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What is the purpose of database connection pooling?', 'options' => ['Reusing a set of established database connections to avoid the overhead of opening a new connection per request', 'Encrypting connections', 'Load-balancing between databases', 'Compressing query results'], 'correct' => 0],
                ['topic' => 'Performance', 'q' => 'What is a common strategy to optimize a slow query involving a large JOIN across millions of rows?', 'options' => ['Ensure appropriate indexes exist on the join and filter columns, and analyze the query with EXPLAIN', 'Remove all indexes to speed up writes', 'Convert all columns to TEXT', 'Disable the query cache permanently'], 'correct' => 0],
                ['topic' => 'Transactions', 'q' => 'What does ACID stand for in the context of database transactions?', 'options' => ['Atomicity, Consistency, Isolation, Durability', 'Access, Control, Integrity, Data', 'Automatic, Cached, Indexed, Distributed', 'Atomic, Cascading, Indexed, Direct'], 'correct' => 0],
                ['topic' => 'Concurrency', 'q' => 'What is optimistic locking commonly used for?', 'options' => ['Detecting conflicting concurrent updates by checking a version/timestamp column before committing a write', 'Locking a table permanently', 'Encrypting rows during a transaction', 'Preventing all reads during a write'], 'correct' => 0],
                ['topic' => 'Design', 'q' => 'Why might you denormalize part of a MySQL schema in a high-read, low-write system?', 'options' => ['To reduce the number of joins needed and improve read performance, at the cost of some data redundancy', 'To save disk space', 'To enforce stricter data integrity', 'To simplify writing INSERT statements only'], 'correct' => 0],
                ['topic' => 'Monitoring', 'q' => 'What is the purpose of a MySQL slow query log?', 'options' => ['To record queries that exceed a configured execution time threshold, helping identify performance bottlenecks', 'To log every successful query regardless of speed', 'To store backup schedules', 'To log failed login attempts only'], 'correct' => 0],
                ['topic' => 'Scaling', 'q' => 'In a master-replica MySQL setup, what is "replication lag"?', 'options' => ['The delay between a write on the master and that write becoming visible on the replica', 'The time it takes to establish a connection', 'The time to run a backup', 'The delay before a query starts executing'], 'correct' => 0],
                ['topic' => 'Operations', 'q' => 'What is a common approach to handle schema migrations safely on a large production MySQL table with zero downtime?', 'options' => ['Using online schema change patterns (e.g. adding columns as nullable, backfilling in batches) rather than one large blocking ALTER', 'Always taking the database offline during any ALTER TABLE', 'Dropping and recreating the table', 'Running the migration only on Fridays'], 'correct' => 0],
                ['topic' => 'Security', 'q' => 'What is the benefit of using prepared statements over directly concatenating values into SQL queries?', 'options' => ['They prevent SQL injection by separating the query structure from the data', 'They make queries run in parallel automatically', 'They eliminate the need for indexes', 'They compress the query text'], 'correct' => 0],
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
