# Config

```php
c::get('revisions.limit', false);
c::get('revisions.path', kirby()->roots()->index() . DS . 'revisions');
```

## Limit

By default a limit of maximum 2 revisions is set per page. You can change that limit to another number. If you want unlimited number of revisions, set the limit to `false` (boolean).

When a new revision is created, old ones are deleted. It will keep only the newest ones by the limit you have set.

## Path

If you want to change the root `revisions` path for some reason, it's possible. Be aware that you need to add the full path to a directory, not just a directory name.