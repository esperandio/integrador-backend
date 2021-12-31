## Requirements

- Create group - OK;
- Create user - OK;
- Sign in - OK;
- Import client events;

## To check

- Repositories Exceptions
 - NotAllowed
 - Existing
 - NotFound

## Roadmap

- Entities (including PHPUnit)
- Use cases (including PHPUnit with Doubles)
- External
 - Encoder (PHP native password hash)
 - Repositories (PDO)
 - Token manager (JWT)
- Presenter
 - Controllers

## Run Composer

```
docker run --rm --interactive --tty --volume $PWD:/app composer <command>
```

### Slim

```
https://github.com/slimphp/Slim
https://www.slimframework.com/docs/v4/concepts/life-cycle.html
```