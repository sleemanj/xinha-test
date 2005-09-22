<?PHP
  $LocalPluginPath = dirname(dirname(__FILE__)).'\plugins';
  $LocalSkinPath = dirname(dirname(__File__)).'\skins';
?>  
<html>
<head>

  <!--------------------------------------:noTabs=true:tabSize=2:indentSize=2:--
    --  Xinha example menu.  This file is used by full_example.html within a
    --  frame to provide a menu for generating example editors using
    --  full_example-body.html, and full_example.js.
    --
    --  $HeadURL$
    --  $LastChangedDate$
    --  $LastChangedRevision$
    --  $LastChangedBy$
    --------------------------------------------------------------------------->

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Example of Xinha</title>
  <link rel="stylesheet" href="full_example.css" />
  <style type="text/css">
    h1 {font: bold 22px "Staccato222 BT", cursive;}
    form, p {margin: 0px; padding: 0px;}
    label { display:block;}
  </style>
  <script language="JavaScript" type="text/javascript">
  function _onResize() {
    var sHeight;
    if (window.innerHeight) sHeight = window.innerHeight;
    else if (document.body && document.body.offsetHeight) sHeight = document.body.offsetHeight;
    else return;
    if (sHeight>270) {
      sHeight = sHeight - 245;
    } else {
      sHeight = 30
    }  
    var div = document.getElementById("div_plugins");
    div.style.height = sHeight + "px";
  }
  
function Dialog(url, action, init) {
	if (typeof init == "undefined") {
		init = window;	// pass this window object by default
	}
	Dialog._geckoOpenModal(url, action, init);
};

Dialog._parentEvent = function(ev) {
	setTimeout( function() { if (Dialog._modal && !Dialog._modal.closed) { Dialog._modal.focus() } }, 50);
	if (Dialog._modal && !Dialog._modal.closed) {
		agt = navigator.userAgent.toLowerCase();
		is_ie = ((agt.indexOf("msie") != -1) && (agt.indexOf("opera") == -1));
		if (is_ie) {
		 	ev.cancelBubble = true;
			ev.returnValue = false;
		} else {
			ev.preventDefault();
			ev.stopPropagation();
		}
	}
};


// should be a function, the return handler of the currently opened dialog.
Dialog._return = null;

// constant, the currently opened dialog
Dialog._modal = null;

// the dialog will read it's args from this variable
Dialog._arguments = null;

Dialog._geckoOpenModal = function(url, action, init) {
	var dlg = window.open(url, "hadialog",
			      "toolbar=no,menubar=no,personalbar=no,width=10,height=10," +
			      "scrollbars=no,resizable=yes,modal=yes,dependable=yes");
	Dialog._modal = dlg;
	Dialog._arguments = init;

	// capture some window's events
	function capwin(w) {
//		HTMLArea._addEvent(w, "click", Dialog._parentEvent);
//		HTMLArea._addEvent(w, "mousedown", Dialog._parentEvent);
//		HTMLArea._addEvent(w, "focus", Dialog._parentEvent);
	};
	// release the captured events
	function relwin(w) {
//		HTMLArea._removeEvent(w, "click", Dialog._parentEvent);
//		HTMLArea._removeEvent(w, "mousedown", Dialog._parentEvent);
//		HTMLArea._removeEvent(w, "focus", Dialog._parentEvent);
	};
	capwin(window);
	// capture other frames
	for (var i = 0; i < window.frames.length; capwin(window.frames[i++]));
	// make up a function to be called when the Dialog ends.
	Dialog._return = function (val) {
		if (val && action) {
			action(val);
		}
		relwin(window);
		// capture other frames
		for (var i = 0; i < window.frames.length; relwin(window.frames[i++]));
		Dialog._modal = null;
	};
};

  function fExtended () {
   	var outparam = { width: document.getElementById("width").value,
                     height: document.getElementById("height").value,
                     sizeIncludesBars: document.getElementById("sizeIncludesBars").value,
                     statusBar: document.getElementById("statusBar").value,
                     mozParaHandler: document.getElementById("mozParaHandler").value,
                     undoSteps: document.getElementById("undoSteps").value,
                     baseHref: document.getElementById("baseHref").value,
                     stripBaseHref: document.getElementById("stripBaseHref").value,
                     stripSelfNamedAnchors: document.getElementById("stripSelfNamedAnchors").value,
                     only7BitPrintablesInURLs: document.getElementById("only7BitPrintablesInURLs").value,
                     sevenBitClean: document.getElementById("sevenBitClean").value,
                     killWordOnPaste: document.getElementById("killWordOnPaste").value,
                     flowToolbars: document.getElementById("flowToolbars").value,
                     CharacterMapMode: document.getElementById("CharacterMapMode").value,
                     ListTypeMode: document.getElementById("ListTypeMode").value
                   };
	  Dialog("Extended.html", function(param) {
      if(param) {
		    document.getElementById("width").value = param["width"];
		    document.getElementById("height").value = param["height"];
        document.getElementById("sizeIncludesBars").value = param["sizeIncludesBars"];
        document.getElementById("statusBar").value = param["statusBar"];
        document.getElementById("mozParaHandler").value = param["mozParaHandler"];
        document.getElementById("undoSteps").value = param["undoSteps"];
        document.getElementById("baseHref").value = param["baseHref"];
        document.getElementById("stripBaseHref").value = param["stripBaseHref"];
        document.getElementById("stripSelfNamedAnchors").value = param["stripSelfNamedAnchors"];
        document.getElementById("only7BitPrintablesInURLs").value = param["only7BitPrintablesInURLs"];
        document.getElementById("sevenBitClean").value = param["sevenBitClean"];
        document.getElementById("killWordOnPaste").value = param["killWordOnPaste"];
        document.getElementById("flowToolbars").value = param["flowToolbars"];
     		document.getElementById("CharacterMapMode").value = param["CharacterMapMode"];
        document.getElementById("ListTypeMode").value = param["ListTypeMode"];
		  }
		}, outparam );
  }

  window.onresize = _onResize;
  window.onload = _onResize;
  </script>
</head>

<body>
  <form action="ext_example-body.html" target="body">
  <h1>Xinha Example</h1>
    <fieldset>
      <legend>Settings</legend>
        <label>
          Number of Editors: <input type="text" name="num" value="1" style="width:25;" maxlength="2"/>
        </label>
        <label>
          Language:
          <select name="lang">
          <option value="en">English</option>
          <option value="de">German</option>
          <option value="fr">French</option>
          <option value="it">Italian</option>
          <option value="no">Norwegian</option>
          <option value="pl">Polish</option>
          </select>
        </label>
        <label>
          Skin:
          <select name="skin">
          <option value="">-- no skin --</option>
<?php
	$d = @dir($LocalSkinPath);
	while (false !== ($entry = $d->read()))  //not a dot file or directory
	{	if(substr($entry,0,1) != '.')
		{ echo '<option value="' . $entry . '"> ' . $entry . '</option>';
		}
	}
	$d->close();
?>
          </select>
        </label>
        <input type="hidden" id="width" name="width" value="auto" />
        <input type="hidden" id="height" name="height" value="auto" />
        <input type="hidden" id="sizeIncludesBars" name="sizeIncludeBars" value="true" />
        <input type="hidden" id="statusBar" name="statusBar" value="true" />
        <input type="hidden" id="mozParaHandler" name="mozParaHandler" value="best" />
        <input type="hidden" id="undoSteps" name="undoSteps" value="20" />
        <input type="hidden" id="baseHref" name="baseHref" value="null" />
        <input type="hidden" id="stripBaseHref" name="stripBaseHref" value="true" />
        <input type="hidden" id="stripSelfNamedAnchors" name="stripSelfNamedAnchors" value="true" />
        <input type="hidden" id="only7BitPrintablesInURLs" name="only7BitPrintablesInURLs" value="true" />
        <input type="hidden" id="sevenBitClean" name="sevenBitClean" value="false" />
        <input type="hidden" id="killWordOnPaste" name="killWordOnPaste" value="true" />
        <input type="hidden" id="flowToolbars" name="flowToolbars" value="true" />
        <input type="hidden" id="CharacterMapMode" name="CharacterMapMode" value="popup" />
        <input type="hidden" id="ListTypeMode" name="ListTypeMode" value="toolbar" />
        <center><input type="button" value="extended Settings" onClick="fExtended();" /></center>

    </fieldset>
    <fieldset>
      <legend>Plugins</legend>
      <div id="div_plugins" style="width:100%; overflow:auto">
<?php
	$d = @dir($LocalPluginPath);
	while (false !== ($entry = $d->read()))  //not a dot file or directory
	{	if(substr($entry,0,1) != '.')
		{ echo '<label><input type="checkbox" name="plugins" value="' . $entry . '"> ' . $entry . '</label>';
		}
	}
	$d->close();
?>
      </div>
    </fieldset>
    <center><input type="submit" value="reload editor"></center>
  </form>
  <script type="text/javascript">
    top.frames["body"].location.href = document.location.href.replace(/ext_example-menu\.php.*/, 'ext_example-body.html')
  </script>

</body>
</html>