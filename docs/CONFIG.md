# Config

```php
c::get('revisions.limit', false);
c::get('revisions.path', kirby()->roots()->index() . DS . 'revisions');
```

## Limit

By default there is no limit of how many revisions there can be per page.

**To limit, set a number, like this:**

```php
c::get('revisions.limit', 2);
```

When a new revision is created, old ones are deleted. It will keep only the newest ones by the limit you have set.

## Path

If you want to change the root `revisions` path for some reason, it's possible. Be aware that you need to add the full path to a directory, not just a directory name.