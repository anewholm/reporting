var path = '/xmondrian/demo/xavier'; // document.location.href;
var pathComponents = path.split("/");
var i, pathComponent, n = pathComponents.length;
var xmlaUrl;
for (i = 0; i < n; i++) {
  pathComponent = pathComponents[i];
  if (pathComponent === "xavier") {
    xmlaUrl = pathComponents.slice(0, i);
    xmlaUrl = xmlaUrl.join("/") + "/" + "xmla";
    break;
  }
}

var xavierOptions = {
  //you can add any custom stylesheets here. They will be added at the end of the <head> so you can override the default styles.
  stylesheets: [],
  //false to suppress the toolbar. Useful if you're integrating xavier.
  createToolbar: true,
  //whether to generate a tuple (true) or set for the slicer. Must be true for SAP/HANA
  generateTupleForSlicer: true,
  //Whether one query axis can have items from different hierarchies of the same dimension.
  allowMultipleHierarchiesFromSameDimensionOnOneAxis: false,
  //whether to clear the visualization while waiting on a new query.
  clearVisualizationBeforeExecutingQuery: false,
  //whether to create a splitter between measures and dimensions/hierarchies
  splitterBetweenMeasuresAndDimensions: true,
  //configure whether data source nodes are flattened (hidden) or not
  datasourceNodesInitiallyFlattened: true,
  //determines which field to use as caption for datasource nodes
  useAsDatasourceCaption: ["DataSourceName", "DataSourceDescription"],
  //levelMembersDiscoveryMethod: how to find the members of levels.
  //- "Discover" (Xmla.METHOD_DISCOVER) - use a MDSCHEMA_MEMBERS discover request.
  //- "Execute" (Xmla.METHOD_EXECUTE) - ask for LEVEL.members to find the members.
  //main reason to make this configurable is that there may be performance differences between providers.
  //also, the MDX versio gives more flexibility to filter members (should I ever implement a filter)
  //Finally, SAP HANA sometimes needs input parameters, and while these can be passed to MDX statements,
  //we know not of any way to push input params into discover requests.
  levelMembersDiscoveryMethod: Xmla.METHOD_EXECUTE,
  //initialMeasuresTreeNodeState: Initial state of dimensions Treenode: "collapsed", "expanded", "flattened", "unflattened", "leaf"
  initialMeasuresTreeNodeState: "flattened",
  //initialMeasuresTreeNodeState: "expanded",
  //initialDimensionsTreeNodeState: Initial state of dimensions Treenode: "collapsed", "expanded", "flattened", "unflattened", "leaf"
  initialDimensionsTreeNodeState: "flattened",
  //initialDimensionsTreeNodeState: "expanded",
  //initialHierarchyTreeNodeState: Initial state of hierarchy Treenodes: "collapsed", "expanded", "flattened", "unflattened", "leaf"
  initialHierarchyTreeNodeState: "flattened",
  //loadLevelsImmediately determines whether levels should be immediately discovered after loading a cube.
  //if false, initial loading stops after the hierarchies are discovered, and levels are lazily loaded by expanding a hierarchy node.
  //if true, then levels are loaded immediately after loading the hierarchy nodes.
  //if not specified levels are loaded based on setting of initialHierarchyTreeNodeState
  //loadLevelsImmediately: false,
  //levelCardinalitiesDiscoveryMethod determines how cardinalities of levels are discovered.
  //levelCardinalitiesDiscoveryMethod: Xmla.METHOD_DISCOVER, //get level cardinality estimates from level discovery requests
  levelCardinalitiesDiscoveryMethod: Xmla.METHOD_EXECUTE,  //get exact level cardinalities by running mdx query.
  //levelMembersDiscoveryMethod: how to find the members of levels.
  //- "Discover" (Xmla.METHOD_DISCOVER) - use a MDSCHEMA_MEMBERS discover request.
  //- "Execute" (Xmla.METHOD_EXECUTE) - ask for LEVEL.members to find the members.
  //main reason to make this configurable is that there may be performance differences between providers.
  //also, the MDX versio gives more flexibility to filter members (should I ever implement a filter)
  //Finally, SAP HANA sometimes needs input parameters, and while these can be passed to MDX statements,
  //we know not of any way to push input params into discover requests.
  levelMembersDiscoveryMethod: Xmla.METHOD_EXECUTE,
  //levelMembersDiscoveryMethod: Xmla.METHOD_DISCOVER,
  //defaultMemberDiscoveryMethod determines how captions of default members are discovered.
  //defaultMemberDiscoveryMethod: false,                //don't get default member captions
  defaultMemberDiscoveryMethod: Xmla.METHOD_EXECUTE,  //get default member captions with a MDX query
  //defaultMemberDiscoveryMethod: Xmla.METHOD_DISCOVER, //get default member captions with disover requests
  //if you want to connect to a specific XML/A provider, put its url here
  xmlaUrl: xmlaUrl,
  //showCatalogNodesToolbarButton whether to show a toolbar button to toggle display of catalog nodes.
  showCatalogNodesToolbarButton: true,
  //configure whether catalog nodes are flattened (hidden) or not
  catalogNodesInitiallyFlattened: true,
  //configure whether the tree has a checkbox to toggle display of catalog nodes.
  showCatalogNodesCheckboxDisplayed: false,
  //showHierarchyNodesToolbarButton whether to show a toolbar button to toggle display of hierarchy nodes.
  showHierarchyNodesToolbarButton: true,
  //configure whether the tree has a checkbox to toggle display of hierarchy nodes
  showHierarchyNodesCheckboxDisplayed: false,
  //showDimensionNodesToolbarButton whether to show a toolbar button to toggle display of dimension nodes.
  showDimensionNodesToolbarButton: true,
  //configure whether the tree has a checkbox to toggle display of dimension nodes
  showDimensionNodesCheckboxDisplayed: false,
  //whether to prefix cube names with the catalog name. The prefix is shown only if the catalog nodes are flattened, but this option can be used to suppress prefixes alltogether.
  useCatalogPrefixForCubes: false,
  //whether labels of hierarchy nodes are prefixed by dimension caption. Prefix only shown if the dimension node is flattened. This option can be used to suppress the prefix alltogether.
  useDimensionPrefixForHierarchies: true,
  //whether labels of hierarchy nodes are prefixed by dimension caption. Prefix only shown if the dimension node is flattened. This option can be used to suppress the prefix alltogether.
  useHierarchyPrefixForLevels: true,
  //whether to show the current catalog in the cube pane
  showCurrentCatalog: true,
  //whether to show the current cube in the cube pane
  showCurrentCube: true,
  //configure whether dimension nodes with multiple hierarchies are flattened (hidden) or not
  dimensionNodesInitiallyFlattened: true,
  //Whether property nodes should be rendered in the tree.
  renderPropertyNodes: true,
  //configure whether to use the CUBE_CAPTION or the CUBE_DESCRIPTION as caption for cube nodes in the tree.
  //Most XML/A providers have a CUBE_CAPTION but SAP/HANA does not; the DESCRIPTION usually contains the human friendly name in that case.
  useDescriptionAsCubeCaption: false,
  //configure what is considered "low cardinality" for a level.
  //If the level has this or less members, they are automatically expanded in the treeview.
  maxLowCardinalityLevelMembers: 5,
  //metadataRestrictions is a means to lock down the datasources, catalogs and cubes
  //that xavier will serve to the user up front.
  //You can also use this to set which cube is "autoSelected" - this one will be automatically selected and loaded.
  /*
  metadataRestrictions: {
    datasources: [                //datasources to discover
      {
        restriction: {
          //DataSourceName: "icCube",
          //URL: "",
          //ProviderName: ""
        },
        catalogs: [               //catalogs to discover for this datasource
          {
            restriction: {
              CATALOG_NAME: "FoodMart"
            },
            cubes: [              //cubes to discover for this catalog
              {
                restriction: {
                  CUBE_NAME: "Sales"
                },
                autoSelect: true, //whether this cube should be automatically selectd.
                metadata: {       //use this chached metadata rather than discovering it dynamically
                }
              },
              {
                restriction: {
                  CUBE_NAME: "Store"
                }
              }
            ]
          },
          {
            restriction: {
              CATALOG_NAME: "SteelWheels"
            },
            cubes: [              //cubes to discover for this catalog
              {
                restriction: {
                  CUBE_NAME: "SteelWheelsSales"
                },
                metadata: {       //use this chached metadata rather than discovering it dynamically
                }
              }
            ]
          }
        ]
      }
    ]
  },
  */
  //specify matchers and extra properties to apply to XML/A schema elements
  metadataFilter: [
    {
      matcher: {},  //match any datasource
      rules: [  //rules to match DISCOVER request types
        {
          matcher: Xmla.MDSCHEMA_MEASURES,  //rules applied to measures
          rules: [
            {
              description: "General statistics",
              matcher: {},
              ifMatch: {
                derivedMeasures: [
                  {
                    classes: ["derived-measure-average"],
                    name: "${1} avg",
                    captionMessageKey: "Average of ${1}",
                    tooltipMessageKey: "${1} as the average over categories that appear on all axes in only this query",
                    formula: "Avg(<SET-OF-CHILDREN>, <MEASURE>)",
                    formatString: "Standard",
                    folder: gMsg("Statistics")
                  },
                  {
                    classes: ["derived-measure-sum"],
                    name: "${1} sum",
                    captionMessageKey: "Sum of ${1}",
                    tooltipMessageKey: "${1} as the sum over categories that appear on all axes in only this query",
                    formula: "Sum(<SET-OF-CHILDREN>, <MEASURE>)",
                    folder: gMsg("Statistics")
                  },
                  {
                    classes: ["derived-measure-count"],
                    name: "${1} count",
                    captionMessageKey: "Count of ${1}",
                    tooltipMessageKey: "${1} as the count over categories that appear on all axes in only this query",
                    formula: "Count(<SET-OF-CHILDREN>, EXCLUDEEMPTY)",
                    formatString: "#",
                    folder: gMsg("Statistics")
                  },
                  {
                    classes: ["derived-measure-minimum"],
                    name: "${1} min",
                    captionMessageKey: "Minimum of ${1}",
                    tooltipMessageKey: "${1} as the minimum over categories that appear on all axes in only this query",
                    formula: "Min(<SET-OF-CHILDREN>, <MEASURE>)",
                    folder: [gMsg("Statistics"), gMsg("Min/Max")]
                  },
                  {
                    classes: ["derived-measure-maximum"],
                    name: "${1} max",
                    captionMessageKey: "Maximum of ${1}",
                    tooltipMessageKey: "${1} as the maximum over categories that appear on all axes in only this query",
                    formula: "Max(<SET-OF-CHILDREN>, <MEASURE>)",
                    folder: [gMsg("Statistics"), gMsg("Min/Max")]
                  },
                  {
                    classes: ["derived-measure-median"],
                    name: "${1} median",
                    captionMessageKey: "Median of ${1}",
                    tooltipMessageKey: "${1} as the median over categories that appear on all axes in only this query",
                    formula: "Median(<SET-OF-CHILDREN>, <MEASURE>)",
                    folder: gMsg("Statistics")
                  },
                  {
                    classes: ["derived-measure-rank"],
                    name: "${1} rank",
                    captionMessageKey: "Rank of ${1}",
                    tooltipMessageKey: "${1} as the rank over categories that appear on all axes in only this query",
                    formula: "Rank(<TUPLE-OF-CURRENT>, <SET-OF-SIBLINGS>, <MEASURE>)",
                    formatString: "#",
                    folder: gMsg("Statistics")
                  },
                  {
                    classes: ["derived-measure-sample-standard-deviation"],
                    name: "${1} stdev",
                    captionMessageKey: "Sample standard deviation of ${1}",
                    tooltipMessageKey: "${1} as the sample standard deviation over categories that appear on all axes in only this query",
                    formula: "Stdev(<SET-OF-CHILDREN>, <MEASURE>)",
                    formatString: "Standard",
                    folder: [gMsg("Statistics"), gMsg("Standard deviation")]
                  },
                  {
                    classes: ["derived-measure-population-standard-deviation"],
                    name: "${1} stdevp",
                    captionMessageKey: "Population standard deviation of ${1}",
                    tooltipMessageKey: "${1} as the population standard deviation over categories that appear on all axes in only this query",
                    formula: "StdevP(<SET-OF-CHILDREN>, <MEASURE>)",
                    formatString: "Standard",
                    folder: [gMsg("Statistics"), gMsg("Standard deviation")]
                  },
                  {
                    classes: ["derived-measure-cumulative-sum"],
                    name: "Cumulative sum of ${1}",
                    captionMessageKey: "Cumulative sum of ${1}",
                    tooltipMessageKey: "The cumulative sum of ${1}",
                    formula: "Sum(<SET-OF-PRECEDING-SIBLINGS>, <MEASURE>)",
                    folder: [gMsg("Statistics"), gMsg("Running calculations")]
                  },
                  {
                    classes: ["derived-measure-cumulative-sum"],
                    name: "Cumulative sum of ${1} over rows",
                    captionMessageKey: "Cumulative sum of ${1} over rows",
                    tooltipMessageKey: "The cumulative sum of ${1} over rows",
                    formula: "Sum(<SET-OF-PRECEDING-SIBLINGS-ON-ROWS>, <MEASURE>)",
                    folder: [gMsg("Statistics"), gMsg("Running calculations")]
                  },
                  {
                    classes: ["derived-measure-cumulative-sum"],
                    name: "Cumulative sum of ${1} over columns",
                    captionMessageKey: "Cumulative sum of ${1} over columns",
                    tooltipMessageKey: "The cumulative sum of ${1} over columns",
                    formula: "Sum(<SET-OF-PRECEDING-SIBLINGS-ON-COLUMNS>, <MEASURE>)",
                    folder: [gMsg("Statistics"), gMsg("Running calculations")]
                  },
                  {
                    classes: ["derived-measure-delta"],
                    name: "Delta of ${1}",
                    captionMessageKey: "Delta of ${1}",
                    tooltipMessageKey: "The delta of ${1}",
                    formula: "<MEASURE> - (<MEASURE>, <SET-OF-SIBLINGS>.Item(Rank(<TUPLE-OF-CURRENT>, <SET-OF-SIBLINGS>) - 2))",
                    folder: [gMsg("Statistics"), gMsg("Running calculations")]
                  }
                ]
              }
            },
            {
              description: "Special derived measures for declared additive measures",
              matcher: {
                MEASURE_AGGREGATOR: [ //rules for additive measures:
                  Xmla.Rowset.MDMEASURE_AGGR_SUM,
                  Xmla.Rowset.MDMEASURE_AGGR_COUNT,
                  Xmla.Rowset.MDMEASURE_AGGR_DST
                  //Xmla.Rowset.MDMEASURE_AGGR_CALCULATED:
                  //Xmla.Rowset.MDMEASURE_AGGR_UNKNOWN:
                ]
              },
              ifMatch: {
                derivedMeasures: [
                  {
                    classes: ["derived-measure-percentage"],
                    name: "${1} percentage of all",
                    captionMessageKey: "${1} percentage of all",
                    tooltipMessageKey: "${1} as a percentage of all categories along all hierarchies on all axes.",
                    formatString: "0.00%",
                    formula: "<MEASURE> / Sum(<SET-OF-EVERYTHING>, <MEASURE>)",
                    folder: gMsg("Percentages")
                  },
                  {
                    classes: ["derived-measure-percentage"],
                    name: "${1} percentage of parent",
                    captionMessageKey: "${1} percentage of parent",
                    tooltipMessageKey: "${1} as a percentage of the parent level of all hierarchies along all axes.",
                    formatString: "0.00%",
                    formula: "<MEASURE> / Sum(<SET-OF-PARENTS>, <MEASURE>)",
                    folder: gMsg("Percentages")
                  },
                  {
                    classes: ["derived-measure-percentage"],
                    name: "${1} percentage",
                    captionMessageKey: "${1} percentage",
                    tooltipMessageKey: "${1} as a percentage all categories that appear on all axes in only this query",
                    formatString: "0.00%",
                    formula: "<MEASURE> / Sum(<SET-OF-SIBLINGS>, <MEASURE>)",
                    folder: gMsg("Percentages")
                  },
                  {
                    classes: ["derived-measure-percentage"],
                    name: "${1} rows percentage",
                    captionMessageKey: "${1} rows percentage",
                    tooltipMessageKey: "${1} as a percentage all categories that appear on the rows axis in only this query",
                    formatString: "0.00%",
                    formula: "<MEASURE> / Sum(<SET-OF-SIBLINGS-ON-ROWS-AXIS>, <MEASURE>)",
                    folder: gMsg("Percentages")
                  },
                  {
                    classes: ["derived-measure-percentage"],
                    name: "${1} columns percentage",
                    captionMessageKey: "${1} columns percentage",
                    tooltipMessageKey: "${1} as a percentage all categories that appear on the columns axis in only this query",
                    formatString: "0.00%",
                    formula: "<MEASURE> / Sum(<SET-OF-SIBLINGS-ON-COLUMNS-AXIS>, <MEASURE>)",
                    folder: gMsg("Percentages")
                  }
                ]
              }
            }
          ]
        }
/*
        {
          matcher: Xmla.DBSCHEMA_CATALOGS,  //rules applied to catalogs
          rules: [
            {
              matcher: {
                CATALOG_NAME: "FoodMart"  //rule for the FoodMart catalog
              },
              ifNotMatch: {
                exclude: true             //catalogs are excluded unless they are called "FoodMart"
              }
            }
          ]
        },
        {
          matcher: Xmla.MDSCHEMA_DIMENSIONS,    //rules applied to dimensions
          rules: [
            {
              matcher: {
                DIMENSION_TYPE: 1 //match all Time dimensions
              },
              ifMatch: {
                mandatory: XmlaMetadataFilter.PROP_MANDATORY_SOME //queries must use "some" (i.e. at least one, i.e. one or more) time dimensions.
              },
              description: gMsg("At least one Date dimension is required.")
            }
          ]
        }
*/
      ]
    }
  ],
  //whether to show a welcome tab on startup.
  showWelcomeTab: true,
  //visualization to create automatically when selecting a cube.
  autoCreateVisualization: {
    id: "pivot-table",
    //you can suppress the tab being closeable by setting this to false.
    closeable: true
  },
  visualizations: [
    {id: "table", tooltip: "New Data table", componentConstructor: XavierTableTab},
    {id: "correlationmatrix", tooltip: "New Correlation Matrix", componentConstructor: XavierCorrelationMatrixTab},
    {id: "pivot-table", tooltip: "New Pivottable", componentConstructor: XavierPivotTableTab, conf: {
      showHorizontalHierarchyHeaders: true,
      showVerticalHierarchyHeaders: true
    }},
    {id: "pie-chart", tooltip: "New Piechart", componentConstructor: XavierPieChartTab},
    {id: "bar-chart", tooltip: "New Barchart", componentConstructor: XavierGroupedBarChartTab},
    {id: "time-series-chart", tooltip: "New Time Series Chart", componentConstructor: XavierTimeSeriesChartTab},
    {id: "combi-chart", tooltip: "New Combichart", componentConstructor: XavierCombiChartTab}
  ]
  /* createToolbar: true */,
  /* autoRunEnabled: true */
};

var xmlaFactory = new XmlaFactory({
  xmlaUrl: xavierOptions.xmlaUrl,
  listeners: {
    error: function(xmlaFactory, event, error) {
      initialized();
      var exception = error.exception;
      var message = exception.toString() || exception.message;
      if (error.code && error.desc) {
        message += "\n" + error.code + ": " + error.desc;
      }
      showAlert("Unexpected Error", message);
    },
    found: function(xmlaFactory, event, xmla){
      initialized();

      //you can add global hooks to xmla to implement application wide behavior
      var globalListeners = {};

      //global execute hooks:
      var execTimeStart = function(event, options, xmla){
        if (console && console.time) {
          console.time(options.statement);
        }
      };
      var execTimeEnd = function(event, options, xmla){
        if (console && console.time) {
          console.timeEnd(options.statement);
        }
      };
      globalListeners[Xmla.EVENT_EXECUTE] = execTimeStart;
      globalListeners[Xmla.EVENT_EXECUTE_SUCCESS] = execTimeEnd;
      globalListeners[Xmla.EVENT_EXECUTE_ERROR] = function(){
        debugger;
      };
      xmla.addListener(globalListeners);

      //global discover hooks
      var discoverMessage = function(options){
        return [
          options.requestType,
          "; properties: ",
          JSON.stringify(options.restrictions)
        ].join("");
      };
      var discoverTimeStart = function(event, options, xmla){
        if (console && console.time) {
          console.time(discoverMessage(options));
        }
      };
      var discoverTimeEnd = function(event, options, xmla){
        if (console && console.time) {
          console.timeEnd(discoverMessage(options));
        }
      };
      globalListeners[Xmla.EVENT_DISCOVER] = discoverTimeStart;
      globalListeners[Xmla.EVENT_DISCOVER_SUCCESS] = discoverTimeEnd;
      globalListeners[Xmla.EVENT_DISCOVER_ERROR] = function(){
        debugger;
      };
      xmla.addListener(globalListeners);

      //attach the xmla instance
      xavierOptions.xmla = xmla;

      //instantiate the application
      window.xavierApplication = new XavierApplication(xavierOptions);
    },
    notfound: function(xmlaFactory, event) {
      initialized();
      showAlert("Not Found",
        "Unfortunately, we did not find a suitable XML/A provider.\n" +
        "Please supply one in the URL using the XmlaUrl querystring parameter."
      );
    }
  }
})
xmlaFactory.createXmla();
