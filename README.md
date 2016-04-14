# Revisions

Revisions for Kirby CMS. A kind of version backup of the content text files.

## Features

- When page is created, a new revision is created.
- When a page is updated, a new revision is created.
- When a page is deleted, all the revisions for that page are deleted.
- When a page slug is renamed, the revisions folder for that page is renamed.
- When a page sort number changes, nothing happends to the revisions.
- When a page goes visible / invisible, nothing happends to the revisions.
- When using multi language, a language folder is created in the page revision folder.
- A field is included to list the revisions on a page.
- Translations are available.

## Requirements

- Kirby 2.3 beta

## Troubleshooting

If it does not work, make sure there are permissions to create and change files and folders.

Also make sure that files and folders are not open in any application, as the application may lock them from editing.

## Use at own risk!

I don't take any responsibility of things that can go wrong with this plugin. It includes all things for example lost revisions or content. If you are not sure, try it out on a test environment first.

## Advanced

### Folder format

```
/revisions/parent/child/.revisions/en/
```

It contains the following parts:

```
[path]/[page]/[page]/.revisions/[language]/
```

### File format

A revision file will look like this:

```
2016-01-01@01.01.01-default.txt
```

It contains the following parts:

```
[year]-[month]-[day]@[hour].[minute].[second]-[template].txt
```

### Created or updated page

When a page is created or updated a revision is created like this:

```
/revisions/parent/child/.revisions/en/2016-01-01@01.01.01-default.txt
```

### Deleted page

When a page is deleted, all the revisions for that page are deleted. It includes everything. If the revision has children they will also be deleted.

### Sort or visible / invisible

The revisions does not do anything when having pages set to visible, invisible or sorted.

If you have set a page to invisible you probably still want it to be invisible even after restored a revision.

The same thing with sort. It could be really messy trying to rearrange the pages by a restored revision.

### Field

The revisions field will list the revisions of the current page.

It's really basic for the moment. Click a revision and you will se the textfile of it. To reset a revision you need to copy / paste from the file into the panel, or copy the file from the revisions folder to the content folder.

In your blueprint, use the type `revisions` like this:

```yaml
fields:
  name:
    label: Revisions
    type: revisions
```

It would be great if you want to develop an alternative field for it!

### Config

```
c::get('revisions.limit', 2);
c::get('revisions.path', kirby()->roots()->index() . DS . 'revisions');
```

#### Limit

If using limit, only a limited number of revision files are kept for each page. Every time a revision is created it delete old ones.

#### Path

I see no reason for not using `revisions` as folder, but if you want you can change it.