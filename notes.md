# Symfony Certification - map and links
 #szkolenia/symfony

## 1. PHP and Web Security
### PHP 5.3 to PHP 5.6 API
[PHP 5.3 new features](http://php.net/manual/en/migration53.new-features.php)
- namespaces
- late static binding
- closures
- __callStatic(), __invoke()
- nowdoc
- constant can be defined outside a class
- ?: operator
- exceptions can be nested

[PHP 5.4 new features](http://php.net/manual/en/migration54.new-features.php)
- traits
- short array syntax
- Function array dereferencing
- closures support $this
- Class member access on instantiation e.g. (new Foo)->bar()
- Class::{expr}()

[PHP 5.5 new features](http://php.net/manual/en/migration55.new-features.php)
- generators
- finally
- new password hashing API
- foreach support list()
- empty() supports arbitrary expressions
- array and string literal dereferencing
- Class name resolution via ::class

[PHP 5.6 new features](http://php.net/manual/en/migration56.new-features.php)
- Constant expressions
- Variadic functions …
- Argument unpacking via …
- ** operator
- use function and use const
- UTF-8 as default encoding
- magic method __debugInfo()

### Object Oriented Programming
[PHP: Classes and Objects - Manual](http://php.net/manual/en/language.oop5.php)
- class name starts with a letter or underscore, followed by any number of letters, numbers, or underscores
- nazwa nie może być zarezerwowanym słowem [PHP: List of Keywords - Manual](http://php.net/manual/en/reserved.keywords.php) - nic co jest konstruktem językowym, szczególnie: array(), die(), empty(), isset(), list(), unset()
- rzucenie wyjątku w konstruktorze powoduje, że obiekt nie zostanie utworzony; zwrócenie `false` nie spowoduje, że obiekt nie zostanie utworzony
- nowe obiekty można tworzyć przez `new $obj1` albo w metodzie statycznej użyć `return new static` albo `self`
- atrybut i metoda mogą mieć te same nazwy
- można do atrybutu włożyć funkcję anonimową, ale żeby ją uruchomić trzeba najpierw przypisać do zmiennej (od 7.0 już nie)
- można przykrywać atrybuty i metody (statyczne też)
- przykrywając metodę robimy to przez nazwę
- When overriding methods, the parameter signature should remain the same or PHP will generate an E_STRICT level error. This does not apply to the constructor, which allows overriding with different parameters.
- domyślna wartość atrybutu musi być znana w czasie kompilacji
- deklarując atrybut trzeba podać widoczność (public, private, protected)
- obiekty tej samej klasy mają dostęp do prywatnych metod i atrybutów innych obiektów
- do PHP 7.1 nie wskazujemy widoczności stałych (public, private, protected); są domyślnie publiczne
- uruchamianie niestatycznych metod jako statyczne powoduje warning E_STRICT
- do 5.4 sygnatura konstruktorów przy dziedziczeniu mogła być inna, od 5.4 musi być taka sama
- przy implementacji klasy abstrakcyjnej można w metodzie dodawać opcjonalne argumenty
- do 5.3.9 nie można było implementować kilku interfejsów jeżeli metoda w obu nazywała się tak samo. Później można, ale sygnatura musi być zgodna.
- przy implementacji interfejsu jeżeli jest w nim stała, to nie można jej przykryć przy implementacji
- możemy iterować po obiekcie, wrzucić go w foreach - wtedy przechodzimy po publicznych atrybutach, jeśli to zrobimy w metodzie, to przejdziemy po wszystkich atrybutach (private i protected też)
- == sprawdza klasę i wartości poszczególnych atrybutów, === sprawdza czy po obu stronach jest referencja do tej samej instancji (obie zmienne muszą wskazywać na ten sam obiekt)
- przy deklaracji atrybutu można używać `var` , ale to pozostałość z dawnych czasów. Bez użycia modyfikatora będzie `public`
- przy uruchomieniu `exit` i `die` zostaną uruchomione deskturktowy i [PHP: register_shutdown_function - Manual](http://php.net/manual/en/function.register-shutdown-function.php)

### Namespace
[PHP: Name resolution rules - Manual](http://php.net/manual/en/language.namespaces.rules.php)
- W pliku przed deklaracją `namespace` może się tylko pojawić `declare`.
- Namespace wpływa na: klasy, interfejsy, funkcje, stałe, traity.
- Globalny namespace można deklarować przez `namespace {}`.
- aliasować `use` możemy klasę, interfejs, namespace, od 5.6 funkcje i stałe.
- `use` musi być in the outermost scope of a file, bo import jest robiony w czasie kompilacji a nie run-time
- fallback jest przy funkcjach i stałych, przy klasach nie, czyli proszenie o klasę w namespace jak jej nie ma spowoduje błąd, ale w przypadku funkcji czy stałej będzie fallback do globalnego zasięgu; to rozwiązanie nazwy jest robione w run-time.
- nie można zagnieżdżać namespaców `namespace A { namespace B {} }`

### Interfaces
[PHP: Object Interfaces - Manual](http://php.net/manual/en/language.oop5.interfaces.php)
- wszystkie metody muszą być publiczne
- interfejsy mogą dziedziczyć
- mogą mieć stałe, ale nie mogą być nadpisane przy dziedziczeniu interfejsów.
- jak będzie stała w interfejsie to przy implementacji jest widoczna jako stała w klasie, ale nie można jej nadpisać
- można w interfejsie określać metody statyczne
- interfejsy mogą dziedziczyć po wielu interfejsach na raz (jest wielodziedziczenie)
- klasy mogą implementować wiele interfejsów
- przy implementacji interfejsu nazwa metody, argumenty, typehinty muszą się zgadzać, wartości domyślne mogą być inne; można dokładać argumenty z wartością domyślną

### Anonymous functions and closures
[PHP: Anonymous functions - Manual](http://php.net/manual/en/functions.anonymous.php)
> An anonymous function is just a function that has no name; nothing more. A closure is a function that captures the state of the surrounding environment.
W php chyba to jest to samo.
Anonymous functions are implemented using the Closure class.

### Abstract classes
[PHP: Class Abstraction - Manual](http://php.net/manual/en/language.oop5.abstract.php)
sf-playground/class.abstract.php

### Exception and error handling
#### Exceptions
- każdy `try` musi mieć co najmniej jeden `catch` lub `finally`. Może być tylko finally na przykład.
- możemy rzucać tylko obiektami, które dziedziczą po `\Exception`
- można dalej rzucać wyjątek w bloku `catch`
- PHP idzie po kolei przez bloki `catch` i jak jest dopasowanie to wchodzi i nie idzie do kolejnych, najgorzej jak pierwszy da się catch z `Exception` to wtedy zawsze tam wejdzie.

#### Error handling
- [PHP: Basics - Manual](http://php.net/manual/en/language.errors.basics.php) [PHP: Exceptions - Manual](http://php.net/manual/en/language.exceptions.php)
- default `error_reporting = E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED`
- `display_errors` może być `on/off`, ale można też dać `stderr` i tam będą wyświetlane błędy, a nie ma `stdout`
- `log_errors = 1/0` włącza logowanie błędów do `error_log` - ten zwykle jest jakimś plikiem dostępnym do zapisu przez użytkownika serwera, ale można ustawić `syslog` i wtedy będzie zapisywane do logów systemowych
- `set_error_handler` - można wskazać funkcję (`callable`) jaka ma być uruchamiana przy określonych rodzajach błędów [PHP: set_error_handler - Manual](http://php.net/manual/en/function.set-error-handler.php)

### Traits
[PHP: Traits - Manual](http://php.net/manual/en/language.oop5.traits.php)
- nie da się zrobić instancji samego traitu
- kolejność przykrywnia: metoda w klasie, trait, metoda z rodzica
- w traitach można robić dziedziczenie, używamy samego `use` i dalej możemy określać widoczność
- w traitach mogą być metody abstrakcyjne, ale nie mogą być `private`
- w traitach można definiować atrybuty (mogą być prywatne) i stałe
- jak trait ma atrybut to w klasie może być zdefiniowany o takiej samej nazwie i wartości początkowej, inaczej plunie błędem
- w traitach można definiować zmienne statyczne (w metodach) i atrybuty statyczne

### PHP extensions
W zasadzie Symfony Standard Edition używa tylko `json` i `ctype` - dobrze by było sprawdzić czy używa innych.

### SPL (Standard PHP Library)
[PHP: SPL - Manual](http://php.net/manual/en/book.spl.php)
#### Datastructures
- Doubly Linked Lists
	- [PHP: SplDoublyLinkedList - Manual](http://php.net/manual/en/class.spldoublylinkedlist.php)
		- iterator mode default: `SplDoublyLinkedList::IT_MODE_FIFO | SplDoublyLinkedList::IT_MODE_KEEP`
		- `pop/push` - na końcu; `shift/unshift` - na początku
	- [PHP: SplStack - Manual](http://php.net/manual/en/class.splstack.php)
		- `SplDoublyLinkedList` with  an iteration mode `IT_MODE_LIFO` and `IT_MODE_KEEP`
	- [PHP: SplQueue - Manual](http://php.net/manual/en/class.splqueue.php)
		- mamy dodatkowe dwie metody do dodawania do kolejki i zdejmowania z kolejki
- Heaps
	- [PHP: SplHeap - Manual](http://php.net/manual/en/class.splheap.php)
		- musimy zaimplementować metodę `compare`
		- można wrzucać tam cokolwiek
	- [PHP: SplMaxHeap - Manual](http://php.net/manual/en/class.splmaxheap.php)
		- zaimplementowana metoda `compare`, że największy u góry
	- [PHP: SplMinHeap - Manual](http://php.net/manual/en/class.splminheap.php)
		- zaimplementowana metoda `compare`, że najmniejszy u góry
	- [PHP: SplPriorityQueue - Manual](http://php.net/manual/en/class.splpriorityqueue.php)
		- zaimplementowana metoda `compare`. Działa w zasadzie jak MaxHeap, ale przy `insert` od razu podaje się priority jako drugi argument
- Arrays
	- [PHP: SplFixedArray - Manual](http://php.net/manual/en/class.splfixedarray.php)
		- stała długość, klucze numeryczne (0+), szybsze niż zwykła tablica
		- długość można zmieniać (powiększać, zmniejszać)
- Map
	- [PHP: SplObjectStorage - Manual](http://php.net/manual/en/class.splobjectstorage.php)
		- pozwala przechowywać obiekty razem z innymi danymi
		- można przekazywać obiekt jako `$map[$o1]`
#### Iterators
- `AppendIterator` - kontener na iteratory, gdzie iteruje się później przez wszystkie
- `ArrayIterator` - This iterator allows to unset and modify values and keys while iterating over Arrays and Objects.
- `CachingIterator` - pozwala na cachowanie, nie ma w kodzie sf.
- `CallbackFilterIterator` - przy iteracji będzie uruchamiany `callback` i jak zwróci `true` to wtedy ten element przechodzi.
- `DirectoryIterator` - The DirectoryIterator class provides a simple interface for viewing the contents of filesystem directories.
- `EmptyIterator` - pusty iterator, chyba raczej po to, że jak trzeba zwrócić iterator, a nie ma nic sensownego, to wtedy tego można użyć
- `FilesystemIterator` - różnica do `DirectoryIterator` jest taka, ża Filesystem przy iteracji zwraca obiekt `SplFileInfo`, a Directory obiekt `DirectoryIterator`, który dziedziczy po SplFileInfo i ma kilka dodatkowych rzeczy, jak `->isDot()`.
- `FilterIterator` - podobny jak `CallbackFilterIterator` tylko, że trzeba w nim zaimplementować metodę `accept`.
- `GlobIterator` - działa jak funkcja `glob()`.
- `InfiniteIterator` - pozwala iterować w nieskończoność po przekazanym w konstruktorze iteratorze bez konieczności robienia `rewind()`.
- `IteratorIterator` - pozwala iterować po przekazanym w konstruktorze iteratorze, trochę tak jakbyśmy chcieli zmienić jego domyślne działanie.
- `LimitIterator` - pozwala iterować po przekazanym iteratorze wskazaną, ograniczoną liczbę razy
- `MultipleIterator` - pozwala iterować po wielu zapiętych iteratorach, ale tak, że w każdej iteracji dostajemy wszystkie aktualne iteracji ze wszystkich zapiętych iteratorów. Wtedy zarówno w kluczu jak i w wartości mamy tablicę wziętą z wszystkich iteratorów.
- `NoRewindIterator` - iterator, którego nie można przewinąć, wywołanie metody `rewind` nie rzuca żadnym błędem, po prostu nie działa.
- `ParentIterator` - This extended FilterIterator allows a recursive iteration using RecursiveIteratorIterator that only shows those elements which have children.
- `RecursiveArrayIterator` - pozwala na rekursywną iterację po tablicy.
- reszta iteratorów rekursywnych działa analogicznie
- `RegexIterator` - działa jak filter czy callback, ale od razu podajemy wyrażenie regularne do testów.

#### Interfaces
- `Countable` - do użytku z funkcją `count()`
- `OuterIterator` - Classes implementing OuterIterator can be used to iterate over iterators; implementuje te same metody co zwykły iterator.
- `RecursiveIterator` - Classes implementing RecursiveIterator can be used to iterate over iterators recursively; dziedziczy po `Iterator` i dodaje metody `getChildren`, `hasChildren`.
- `SeekableIterator` -   dziedziczy po `Iterator` i dodaje metodę `seek`

#### Exception
SPL Exceptions Class Tree
- `LogicException` (extends `Exception`) - Exception that represents error in the program logic. This kind of exception should lead directly to a fix in your code.
	* `BadFunctionCallException` - Exception thrown if a callback refers to an undefined function or if some arguments are missing.
		* `BadMethodCallException` - Exception thrown if a callback refers to an undefined method or if some arguments are missing.
	* `DomainException` - Exception thrown if a value does not adhere to a defined valid data domain.
	* `InvalidArgumentException` - Exception thrown if an argument is not of the expected type.
	* `LengthException` - Exception thrown if a length is invalid.
	* `OutOfRangeException` - Exception thrown when an illegal index was requested. This represents errors that should be detected at compile time.

* `RuntimeException` (extends Exception) - Exception thrown if an error which can only be found on runtime occurs.
	* `OutOfBoundsException` - Exception thrown if a value is not a valid key. This represents errors that cannot be detected at compile time.
	* `OverflowException` - Exception thrown when adding an element to a full container.
	* `RangeException` - Exception thrown to indicate range errors during program execution. Normally this means there was an arithmetic error other than under/overflow. This is the runtime version of DomainException.
	* `UnderflowException` - Exception thrown when performing an invalid operation on an empty container, such as removing an element.
	* `UnexpectedValueException` - Exception thrown if a value does not match with a set of values. Typically this happens when a function calls another function and expects the return value to be of a certain type or value not including arithmetic or buffer related errors.

#### SPL functions
* `class_implements` — Return the interfaces which are implemented by the given class or interface
* `class_parents` — Return the parent classes of the given class
* `class_uses` — Return the traits used by the given class
* `iterator_apply` — Call a function for every element in an iterator
* `iterator_count` — Count the elements in an iterator
* `iterator_to_array` — Copy the iterator into an array
* `spl_autoload_call` — Try all registered __autoload() function to load the requested class
* `spl_autoload_extensions` — Register and return default file extensions for spl_autoload
* `spl_autoload_functions` — Return all registered __autoload() functions
* `spl_autoload_register` — Register given function as __autoload() implementation
* `spl_autoload_unregister` — Unregister given function as __autoload() implementation
* `spl_autoload` — Default implementation for __autoload()
* `spl_classes` — Return available SPL classes
* `spl_object_hash` — Return hash id for given object

#### File handling
* `SplFileInfo` - The SplFileInfo class offers a high-level object oriented interface to information for an individual file.
* `SplFileObject` - The SplFileObject class offers an object oriented interface for a file.
* `SplTempFileObject` - The SplTempFileObject class offers an object oriented interface for a temporary file.

#### Others
* `ArrayObject` - This **class** allows objects to work as arrays.
* `SplObserver` - The SplObserver **interface** is used alongside SplSubject to implement the [Observer pattern - Wikipedia](https://en.wikipedia.org/wiki/Observer_pattern)
* `SplSubject` - The SplSubject **interface** is used alongside SplObserver to implement the Observer Design Pattern.

### Web security (XSS, CSRF, etc.)
[CSRF](http://sekurak.pl/czym-jest-podatnosc-csrf-cross-site-request-forgery/)
[XSS](http://sekurak.pl/czym-jest-xss/)
[SQL Injection](http://sekurak.pl/czym-jest-sql-injection/)

### Różne
- typehint `callable` łapie wszystko co da się uruchomić: domknięcie, nazwa funkcji, tablica (obiekt->metoda), create_function,.
- `print` zawsze zwraca 1, `printf` zwraca liczbę wyświetlonych znaków
- `php -l` sprawdza jeden plik
- PHAR: stub, manifest, file contents, signature. [Introduction to the PHAR formatServerGrove](http://blog.servergrove.com/2015/07/30/introduction-phar-format/) [Packaging Your Apps with Phar — SitePoint](https://www.sitepoint.com/packaging-your-apps-with-phar/)
- przy uruchomieniu `exit` i `die` zostaną uruchomione deskturktowy i [PHP: register_shutdown_function - Manual](http://php.net/manual/en/function.register-shutdown-function.php)
- aktualna wersja PHP: `php -v`, `phpinfo()`, `phpversion()`, `PHP_VERSION`
- `include` normalnie zwraca true/false jak się wczytać plik, ale można w pliku dać return i do tego zewaluuje się `include` [PHP: include - Manual](http://php.net/manual/en/function.include.php); z `require` działa tak samo; jak nie można wczytać pliku `include` generuje `E_WARNING`, `require` generuje `E_COMPILE_ERROR`.

#### Domyślne interfejsy
- [PHP: Traversable - Manual](http://php.net/manual/en/class.traversable.php) - do użycia z `foreach`, ale nie może być bezpośrednio implementowany tylko za pośrednictwem `IteratorAggregate` lub `Iterator`.
- [PHP: Iterator - Manual](http://php.net/manual/en/class.iterator.php) - do iteracji; metody `next`, `key`, `rewind`, `valid`, `current`
- [PHP: IteratorAggregate - Manual](http://php.net/manual/en/class.iteratoraggregate.php) - Interface to create an external Iterator.
- [PHP: ArrayAccess - Manual](http://php.net/manual/en/class.arrayaccess.php) - Interface to provide accessing objects as arrays; metody `offsetGet`, `offsetSet`, `offsetUnset`, `offsetExists`
- [PHP: Serializable - Manual](http://php.net/manual/en/class.serializable.php)
	- implementujemy metody `serialize`, `unserialize`
	- nie potrzebne są już metody `__sleep`, `__wakeup`
	- przy `serialize` NIE jest wywoływany `__destruct` a przy `unserialize` NIE jest wywoływany `__construct`
- [PHP: Closure - Manual](http://php.net/manual/en/class.closure.php) - opisane wyżej

#### Generators
- [PHP: Generator - Manual](http://php.net/manual/en/class.generator.php)
- można zrobić generator albo klasa może implementować interfejs `Iterator`
- generator nie może być przewinięty (klasa implementująca tak, metoda rewind), przez generator nie można iterować kilka razy, trzeba wywołać funkcję generatora od nowa
- generator to normalna funkcja, która może zwracać coś kilka razy `yield` zamiast `return`
- implementuje klasę wewnętrzną `Generator` i generalnie nie można jej po prostu uruchomić, można używać w `foreach`
- generator nie może zwracać wartości przez `return` bo będzie błąd kompilacji, ale użycie pustego returna zatrzyma generator
- `yield` wypluwa wartość i wstrzymuje wykonanie generatora do próby pobrania następnej wartości
- jeżeli `yield` jest częścią wyrażenia to w PHP 5 musi być w nawiasach, w 7 nie `$data = (yield $value);`
- `yield` może też wypluć nulla, można wypluć referencję

## 2. HTTP
### Client / Server interaction
### Status codes
### HTTP request
### HTTP response
### HTTP methods
[Hypertext Transfer Protocol - Wikipedia](https://en.wikipedia.org/wiki/Hypertext_Transfer_Protocol)

Metody:
- GET - nie powinien zmieniać danych
- HEAD - robi to same co GET, ale ciało jest puste. Generalnie chodzi o to, żeby zobaczyć jakimi nagłówkami odpowie serwer bez przesyłania treści.
- OPTIONS - odpowiada jakie metody są dozwolone dla danego URLa, odpowiedź w nagłówku: `Allow: GET,HEAD,POST,OPTIONS,TRACE`
- TRACE - dostajemy w odpowiedzi od serwera request, który do niego wysłaliśmy, żeby na przykład sprawdzić czy coś zostało dodane przez jakiś serwer pośredniczący, np. proxy.
- POST - to co przesyłamy powinno być nowym podrzędnym elementem adresu, do którego idzie żądanie

**Safe Methods**: takie, które nie powodują zmian i wysłanie kilku żądań tą samą metodą zawsze powinno dać ten sam efekt: **GET**, **HEAD**, **OPTIONS**, **TRACE**.

### Cookies
### Caching
### Content negotiation
### Language detection

## 3. Symfony Architecture
### Symfony Standard Edition
### License
### Components
### Bundles
### Bridges
### Configuration
### Code organization
### Request handling
### Exception handling
### Event dispatcher and kernel events
### Official best practices
### Release management
### Backward compatibility promise
### Deprecations best practices

## 4. Standardization
### Release management and roadmap schedule
### Framework interoperability and PSRs
### Naming conventions
### Coding standards
### Third-party libraries integration
### Composer packages handling
### Development best practices
### Framework overloading
### Semantic versioning

## 5. Bundles
### Naming conventions
### Code organization
### Controllers
### The views
### The resources
### Overriding default error pages
### Bundle inheritance
### Event dispatcher and kernel events
### Semantic configuration and compiler passes

## 6. Controllers
### Naming conventions
### The base Controller class
### The request
### The response
### The cookies
### The session
### The flash messages
### HTTP redirects
### Internal redirects
### Generate 404 pages
### File upload
### Built-in internal controllers

## 7. Routing
### Configuration (YAML, XML, PHP & annotations)
### Restrict URL parameters
### Set default values to URL parameters
### Generate URL parameters
### Trigger redirects
### Special internal routing attributes
### Domain name matching
### Conditional request matching
### HTTP methods matching
### User's locale guessing
### Router debugging

## 8. Templating with Twig
### Auto escaping
### Template inheritance
### Global variables
### Filters and functions
### Template includes
### Loops and conditions
### URLs generation
### Controller rendering
### Translations and pluralization
### String interpolation
### Assets management
### Debugging variables

## 9. Forms
### Forms creation
### Forms handling
### Form types
### Forms rendering with Twig
### Forms theming
### CSRF protection
### Handling file upload
### Built-in form types
### Data transformers
### Form events
### Form type extensions

## 10. Data Validation
### PHP object validation
### Built-in validation constraints
### Validation scopes
### Validation groups
### Group sequence
### Custom callback validators
### Violations builder

## 11. Dependency Injection
### Service container
### Built-in services
### Configuration parameters
### Services registration
### Tags
### Semantic configuration
### Factories
### Compiler passes
### Services autowiring

## 12. Security
### Authentication
### Authorization
### Configuration
### Providers
### Firewalls
### Users
### Passwords encoders
### Roles
### Access Control Rules
### Guard authenticators
### Voters and voting strategies

## 13. HTTP Caching
### Cache types (browser, proxies and reverse-proxies)
### Expiration (Expires, Cache-Control)
### Validation (ETag, Last-Modified)
### Client side caching
### Server side caching
### Edge Side Includes

## 14. Console
### Built-in commands
### Custom commands
### Configuration
### Options and arguments
### Input and Output objects
### Built-in helpers
### Console events
### Verbosity levels

## 15. Automated Tests
### Unit tests with PHPUnit
### Functional tests with PHPUnit
### Client object
### Crawler object
### Profile object
### Framework objects access
### Client configuration
### Request and response objects introspection
### PHPUnit bridge
### Handling legacy deprecated code

## 16. Miscellaneous
### Error handling
### Code debugging
### Deployment best practices
### Process and Serializer components
### Data collectors
### Web Profiler and Web Debug Toolbar
### Internationalization and localization