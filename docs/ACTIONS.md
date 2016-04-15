# Actions

## Summery

**A new revision is created on:**

- Create
- Update
- Rename, if the current language is not the default language.

**A revision is deleted on:**

- Delete

**A revision is renamed on:**

- Rename, if the current language is the default language.

**Nothing will happend on:**

- Sort
- Visible
- Invisible

## Created or updated page

When a page is created or updated a revision is created like this:

```
/revisions/parent/child/.revisions/en/2016-01-01@01.01.01-default.txt
```

## Renamed page

When a page is renamed and if it's the default language, it will be renamed on the revisions side as well. No new revision is created, it will just rename the revision folder to be in sync with the content.

When a page is renamed and if it's not the default language, a new revision will be created, because in this case the slug is inside the content file.

## Deleted page

When a page is deleted, all the revisions for that page are deleted. If the revision has children they will also be deleted.

## Sort or visible / invisible

If you change sort order on a page it creates a domino effect on many other pages. The revisions are therefor, by choice, not aware of sort, visible and invisible.