# Plugin: TableOperations

[Back to Plugins](Plugins.html)

The TableOperations plugin inserts context-sensitive buttons into the toolbar to enable working with tables, for example inserting rows, columns, merging, splitting etc.

The plugin was developed by [http://dynarch.com Mihai Bazon], sponsored by the American Bible Society.

## Configuration

**See the [NewbieGuide](NewbieGuide#ProvideSomeConfiguration.html) for how to set configuration values in general, the below configuration options are available for this plugin.**

Configuration of this plugin is not normally required, however there exist some options if you wish to customise it's function...

   
  `xinha_config.TableOperations.showButtons = (bool);`::
    Show the toolbar buttons, default true
  `xinha_config.TableOperations.tabToNext = (bool);`::
    Tab in a cell to move to the next cell (shift-tab for previous), default true
  `xinha_config.TableOperations.dblClickOpenTableProperties = (bool);`::
    Double-Click a cell to open the properties, default false.  Note this can be a but unintuitive if enabled, hence off by default.
  `xinha_config.TableOperations.toolbarLayout = ('compact' or 'full');`::
    Adjusts the way buttons are shown in the tool bar, default 'compact'
  `xinha_config.TableOperations.noFrameRulesOptions = (bool);`::
    Disable "Frame and Border" options in the table properties, default true.  Note that these rules can be confusing, hence off by default.
  `xinha_config.TableOperations.addToolbarLineBreak = (bool);`::
    Adds a 'linebreak' in the toolbar to put the table buttons on a new "bar", default true.
