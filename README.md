# Description
This is test task for PHP backend developer vacancy written on Symfony 4.4.

# Installation
To run this project, you need to install [Composer](https://getcomposer.org/), 
move to the root folder (symfony-library)
and then run `composer install` in the terminal.

# Run
To run the project, you can type in the terminal `symfony server:start`,
if you have [symfony cli](https://github.com/symfony/cli) installed.

But for more performance, use Apache with virtual host.

# Making fake data for database
Users: run `./bin/console doctrine:fixtures:load` in the terminal.

Books and authors: clone [this generator](https://github.com/gettmure/php-database-generator), 
move to its root directory (php-database-generator) and run `php src/main.php`;

# SQL Query
Return all books, that have >=2 authors.

Report table:

| Book name     | Authors count |
| ------------- |---------------|
|               |               |


### Native SQL
```sql
--You can test it in the app aswell.

SELECT name, count
FROM books
INNER JOIN
    (SELECT book_id, COUNT(*) as count
     FROM book_user GROUP BY book_id
     HAVING COUNT(*) > 1) b
ON books.id = b.book_id
ORDER BY count ASC
```

### Doctrine ORM SQL
```php
--You can test it in the app aswell.

public function findBooksByQueryBuilder() {
    $queryBuilder = $this->createQueryBuilder('book');
    $query = $queryBuilder
        ->innerJoin('book.authors', 'authors')
        ->having('count(authors) > 1')
        ->groupBy('book.id')
        ->orderBy('count(authors)', 'ASC')
        ->getQuery();
     return $query->getResult();
}
```
