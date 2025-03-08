<div id="xavier"><?php
  // TomCat hosted Xavier system, copied from the Xavier index.html setup
  // We are placing the scripts in the BODY, not the HEAD
  // because they will directly add the system to the BODY
  $tomcat = "/xmondrian/demo/xavier";

  function addJs($src, $charsetUTF8 = NULL) {
    $charsetAttr = ($charsetUTF8 ? "charset='utf-8'" : '');
    print("<script type='text/javascript' src='$src' $charsetAttr></script>");
  }

  function addCss($src, $charsetUTF8 = NULL) {
    $charsetAttr = ($charsetUTF8 ? "charset='utf-8'" : '');
    print("<link rel='stylesheet' type='text/css' href='$src'/>");
  }

  addJs("/plugins/acorn/reporting/assets/js/acorn.reporting.olap.init.1.js");
  addCss("$tomcat/lib/mui/css/tooltip.css");

  addJs("$tomcat/lib/d3-4.3.0/d3.v4.3.0.js");
  addJs("$tomcat/lib/dimple-2.3.0/dimple.v2.3.0.js");
  addJs("$tomcat/lib/jszip/jszip.min.js");
  addJs("$tomcat/lib/blob/Blob.js");
  addJs("$tomcat/lib/filesaver/FileSaver.min.js");
  addJs("$tomcat/lib/xmla4js/Xmla.js");
  addJs("$tomcat/lib/mui/js/utilities.js");
  addJs("$tomcat/lib/mui/js/dateutils.js");
  addJs("$tomcat/lib/mui/js/dom.js");
  addJs("$tomcat/lib/mui/js/event.js");
  addJs("$tomcat/lib/mui/js/dnd.js");
  addJs("$tomcat/lib/mui/js/observable.js");
  addJs("$tomcat/lib/mui/js/displayed.js");
  addJs("$tomcat/lib/mui/js/disabled.js");
  addJs("$tomcat/lib/mui/js/timer.js");
  addJs("$tomcat/lib/mui/js/spinner.js");
  addJs("$tomcat/lib/mui/js/dialog.js");
  addJs("$tomcat/lib/mui/js/toolbar.js");
  addJs("$tomcat/lib/mui/js/treenode.js");
  addJs("$tomcat/lib/mui/js/treelistener.js");
  addJs("$tomcat/lib/mui/js/treeselection.js");
  addJs("$tomcat/lib/mui/js/highlighter.js");
  addJs("$tomcat/lib/mui/js/contentarea.js");
  addJs("$tomcat/lib/mui/js/contentpane.js");
  addJs("$tomcat/lib/mui/js/splitpane.js");
  addJs("$tomcat/lib/mui/js/tabpane.js");

  // Datagrid will attempt to add scrollbars to the body
  addJs("$tomcat/lib/mui/js/datagrid.js");
  addJs("$tomcat/resources/js/loadingindicator.js");
  addJs("$tomcat/resources/messages/messages.js");

  addJs("/plugins/acorn/reporting/assets/js/acorn.reporting.olap.init.js");

  addJs("$tomcat/resources/js/xlsxexport.js");
  addJs("$tomcat/resources/js/msgbox.js");
  addJs("$tomcat/resources/js/xmlatreeview.js");
  addJs("$tomcat/resources/js/mdquerydesigner.js");
  // MDPivotTable will attempt to add the same scrollbars as above to the body
  addJs("$tomcat/resources/js/mdpivottable.js");
  addJs("$tomcat/resources/js/xaviertab.js");
  addJs("$tomcat/resources/js/xavierdoctab.js");
  addJs("$tomcat/resources/js/xaviercorrelationmatrixtab.js");
  addJs("$tomcat/resources/js/xaviertabletab.js");
  addJs("$tomcat/resources/js/xavierpivottabletab.js");
  addJs("$tomcat/resources/js/xaviercharttab.js");
  addJs("$tomcat/resources/js/xavierpiecharttab.js");
  addJs("$tomcat/resources/js/xaviergroupedbarcharttab.js");
  addJs("$tomcat/resources/js/xaviertimeseriescharttab.js");
  addJs("$tomcat/resources/js/xaviercombicharttab.js");
  addJs("$tomcat/resources/js/xaviertabpane.js");
  addJs("$tomcat/resources/js/xmlafactory.js");
  addJs("$tomcat/resources/js/xmlametadatafilter.js");
  addJs("$tomcat/resources/js/xavierderivedmeasurefactory.js");
  addJs("$tomcat/resources/js/xavier.js");

  addJs("/plugins/acorn/reporting/assets/js/acorn.reporting.olap.init.2.js");
?></div>
