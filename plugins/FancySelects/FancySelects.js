/**
  = WebKit Image Resizer =
  
  The WebKit based (or similar) browsers, including Chrome (and Edge)
  don't support drag-to-size images or tables, which is a pain.
  
  This plugin implements the EditorBoost jQuery resizing plugin
    http://www.editorboost.net/Webkitresize/Index
  jQuery is required, naturally, if it's not already loaded 
  then we will load our own version, so ensure you load your version
  first if you need a newer one (then this might break, but oh well).
  
  == Usage ==._
  Instruct Xinha to load the WebKitImageResuze plugin (follow the NewbieGuide),
  you can load this plugin even in non WebKit browsers, it will do 
  nothing (no harm, no benefit).
  
  == Caution ==
  This only works acceptably in either:
    Standards Mode  (eg Doctype <!DOCTYPE html> )
    Quirks Mode     (eg no doctype              )
    
  it does not work great in "Almost Standards Mode" because scrolling throws
  the resize border out of place, ,that's ok if you don't need to scroll, 
  either because your text is small, or you are in FullScreen mode or 
  something, but anyway.
  
 
 * @author $Author$
 * @version $Id$
 * @package WebKitResize
 */


FancySelects._pluginInfo = {
  name          : "Fancy Select Boxes (jQuery select2)",
  version       : "1.0",
  developer     : "Select2 Authors, James Sleeman (Xinha)",
  developer_url : "https://select2.org/",
  license       : "MIT"
};

// The options here are as for the 'width' configuration option
// of jQuery Select2 - https://select2.org/appearance
// If you don't use specific sizes here, then it works fine, but 
// can "jump around" in the tool bar if it changes size with selection
Xinha.Config.prototype.FancySelects = {
  widths: {
    'formatblock' : '90px',
    'fontname'    : '130px',
    'fontsize'    : '80px',
    'DynamicCSS-class' : '130px',
    'langmarks'  : '110px'
  }
};

Xinha.loadLibrary('jQuery')
  .loadStyle('select2-4.0.6-rc.1-dist/css/select2.css','FancySelects')
  .loadScript('select2-4.0.6-rc.1-dist/js/select2.js', 'FancySelects')
  .loadStyle('FancySelects.css',                       'FancySelects')
  .loadScriptIf(_editor_lang != 'en', 'select2-4.0.6-rc.1-dist/js/i18n/'+_editor_lang+'.js', 'FancySelects');
  
function FancySelects(editor)
{
    this.editor = editor;
}

FancySelects.prototype.onGenerateOnce = function()
{
  // Be sure we wait until jQuery is loaded
  if(!(jQuery && jQuery.fn && jQuery.fn.select2 && jQuery('.toolbarElement select').length))
  {
    var self = this;
    window.setTimeout(function(){self.onGenerateOnce()}, 500);
    return;
  }
  
  var editor = this.editor;

  function formatFontName(opt)
  {
    if(!opt.id) return opt.text;
    
    if(opt.id.match(/wingdings|webdings/i))
    {
      return jQuery('<span>'+opt.text+'</span> <span style="font-family:'+opt.id+'";" title="'+opt.text+'">*(JL</span>');
    }
    else
    {
      return jQuery('<span style="font-family:'+opt.id+'";" title="'+opt.text+'">'+opt.text+'</span>');
    }
  }
  
  function formatFontSize(opt)
  {
    if(!opt.id) return opt.text;
   return jQuery('<font size="'+opt.id+'";" title="'+opt.text+'">'+opt.text+'</font>');
  }
  
  jQuery('.toolbarElement select').each(function(i,e){
    var txt = e.name;
    var el  = e;
    
    var width = 'resolve';
    if(typeof editor.config.FancySelects.widths[txt] != 'undefined')
    {
      width = editor.config.FancySelects.widths[txt];
    }
    
    switch(txt)
    {
      case 'fontname':
        jQuery(e).select2({dropdownAutoWidth: true, theme: 'default', templateResult: formatFontName, width: width});
        break;
      case 'fontsize':
        jQuery(e).select2({dropdownAutoWidth: true, theme: 'default', templateResult: formatFontSize, width: width});
        break;
      default:
        jQuery(e).select2({dropdownAutoWidth: true, theme: 'default', width: width});
    }
    
    jQuery(e).on('select2:select', function(){
      editor._comboSelected(el, txt);
    });
    
  });
};

FancySelects.prototype.onUpdateToolbar = function()
{
    var editor = this;
    jQuery('.toolbarElement select').each(function(i,e){
      
      if(e.name.match(/CSS-class/))
      {
        
      }
      
      jQuery(e).trigger('change');
    });
};
