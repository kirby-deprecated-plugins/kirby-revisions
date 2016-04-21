# Installation

## Plugin

1. Put the `revisions` folder into the `/site/plugins` folder.
1. Save or create a post to test it. If it works it will create a new folder in your root called `revisions`, unless you have set something else in your config.

## Field (not required)

You need to install the plugin for the field to be installed.

**In your blueprint, use the type `revisions` like this:**

```yaml
fields:
  revisions:
    label: Previous versions
    type: revisions
```

Go to a page and save it or create a new one. If it works a revision will appear.