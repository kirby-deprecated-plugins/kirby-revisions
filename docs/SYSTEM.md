# System

This is information about the files and folder structure that is created.

![](https://raw.githubusercontent.com/jenstornell/kirby-revisions/master/docs/system.png)

## Folder format

```
/revisions/parent/child/.revisions/en/
```

It contains the following parts:

```
[path]/[page]/[page]/.revisions/[language]/
```

### Path

The path can be change by another path in the config.

### .revisions

The `.revisions` folder is there to make sure the revisions does not collide with subpages. The `.` is there to make sure that no page can collide with it.

### Language

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

### Date and time

It's as readable, yet unique as possible. Date and time are presented, instead of just a timestamp.

### Template

The template name is not inside the content text file. Instead it's added in the filename.