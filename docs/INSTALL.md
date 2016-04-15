# Installation

## Plugin

1. Put the `revisions` folder into the `/site/plugins` folder.
1. Save or create a post to test it. If it works it will create a new folder in your root called `revisions`, unless you have set something else in your config.

## Field

You need to install the plugin for the field to be installed.

**In your blueprint, use the type `revisions` like this:**

```yaml
fields:
  name:
    label: Revisions
    type: revisions
```

Go to a page and save it and see if a revision appear.