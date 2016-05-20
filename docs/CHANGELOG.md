# Changelog

## 0.4

- Before it did not work for me because of permissions. Now it does. Default permissions on folders are 0755.
- A new config `plugin.revisions.permission` is added which mean you can change the permissions if you want.

## 0.3

- Added namespaces
- Minified css is now generated a swith Gulp and Scss.
- Option added to prevent deletion of revision when a page is deleted.
- Field assets are set as files, not inline.

## 0.2

- Changed prefix from `revisions.` to `plugin.revisions`. Added it to docs.
- Added docs about how to protect the `revisions` folder from external access.
- Prefixed classes more to prevent future collisions with the core.
- Before, if a file or folder was not writable, the panel was hanged. Now, even if a revision could not be saved, renamed or deleted, it will not hang the panel.
- Change some translation details.

## 0.1

- Initial release