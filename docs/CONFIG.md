# Config

```php
c::set('plugin.revisions.limit', false);
c::set('plugin.revisions.path', kirby()->roots()->index() . DS . 'revisions');
```

## Limit

By default there is no limit of how many revisions there can be per page.

**To limit, set a number, like this:**

```php
c::set('plugin.revisions.limit', 2);
```

When a new revision is created, old ones are deleted. It will keep only the newest ones by the limit you have set.

## Path

If you want to change the root `revisions` path for some reason, it's possible. Be aware that you need to add the full path to a directory, not just a directory name.

## Delete

Allow the field to delete the revision when the page is deleted.

```php
c::set('plugin.revisions.delete', true);
```

## Protect the revisions folder

If you do nothing the `revisions` folder is not protected from external requests. That means that they can read your revisions if they know your urls.

There are ways to protect that folder.

### With `.htaccess`

Add a row in your `.htaccess` file, right after `RewriteRule ^site`:

```
# block all files in the revisions folder from being accessed directly
RewriteRule ^revisions/(.*) index.php [L]
```

### With a config value

The `site` folder is already protected in the `.htaccess` file, which means that you can protect it by putting the `revisions` folder inside it.

```
c::set('plugin.revisions.path', kirby()->roots()->site() . DS . 'revisions');
```