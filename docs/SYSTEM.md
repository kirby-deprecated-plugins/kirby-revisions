# System

## Folder format

```
/revisions/parent/child/.revisions/en/
```

It contains the following parts:

```
[path]/[page]/[page]/.revisions/[language]/
```

The `.revisions` folder is there to make sure the revisions does not collide with subpages. The `.` is there to make sure that no page can collide with it.

The language folder is only created on multi language environments. It's created because it would be too messy to have all revisions from all languages in the same folder.

## File format

A revision file will look like this:

```
2016-01-01@01.01.01-default.txt
```

It contains the following parts:

```
[year]-[month]-[day]@[hour].[minute].[second]-[template].txt
```

It's as readable, yet unique as possible. Date and time is presented, instead of just a timestamp.

The template name is not inside the content text file. Instead it's added in the filename.