<div class="mainright">
    <div class="mainrightinner">
        
        <div class="widgetbox">
            <div class="title"><h2 class="chart"><span>Active Visits</span></h2></div>
            <div class="chartbox widgetcontent">
                <h2>1800</h2>
                <div class="clear"></div>
                <img src="images/charts/meter.png" height="80" width="146" alt="" />
                <div class="clear"></div>
                <!--<div id="jGaugeDemo1" class="jgauge"></div>-->
                <script type="text/javascript">
        
    
            // DEMOGAUGE1 - A very basic 'bare-bones' example...
        var demoGauge1 = new jGauge(); // Create a new jGauge.
        demoGauge1.id = 'jGaugeDemo1'; // Link the new jGauge to the placeholder DIV.
        
    
                        
        // This function is called by jQuery once the page has finished loading.
        $j(document).ready(function()
        {
            demoGauge1.init(); // Put the jGauge on the page by initializing it.
            
            
            // Configure demoGauge3 for random value updates.
            demoGauge1.setValue(1);
            setInterval('randVal()', 10);
        });
        
        // That's all folks! We've created a jGauge and put it on the page! :-D
        // The following JavaScript functions are for the demonstration.
        // ----------------------------------------------------------------------
        
        
        
        
        // This is a test function that changes the gauge value.
        function setVal(value)
        {
            demoGauge1.setValue(value);
            demoGauge2.setValue(value);
        }
        
        // This is another test function that changes the gauge value.
        function bumpVal(value)
        {
            demoGauge1.setValue(demoGauge1.value + value);
            demoGauge2.setValue(demoGauge2.value + value);
        }
        
        // This is a test function that changes the number of ticks.
        function setTickCount(value)
        {
            demoGauge1.ticks.count = value;
            demoGauge1.updateTicks();
            
        }
        
        // This is a test function that changes the range styling.
        function setRange(radius, thickness, start, end, color)
        {
            demoGauge1.range.radius = radius;
            demoGauge1.range.thickness = thickness;
            demoGauge1.range.start = start;
            demoGauge1.range.end = end;
            demoGauge1.range.color = color;
            demoGauge1.updateRange();
        }
    </script>
                <div class="one_half">
                    <div class="analytics analytics2">
                        <small>Visitors For Today</small>
                        <h1>23 321</h1>
                        <small>18,222 unique</small>
                    </div><!--visitoday-->
                </div><!--one_half-->
                
                <div class="one_half last">
                    
                    <div class="one_half">
                        <div class="analytics">
                            <small>bounce</small>
                            <h3>23.2%</h3>
                        </div><!--analytics-->
                    </div><!--one_half-->
                    
                    <div class="one_half last">
                        <div class="analytics textright">
                            <small class="block">visitors</small>
                            <h3>56.8%</h3>
                        </div><!--analytics-->
                    </div><!--one_half last-->
                    <br clear="all" />
                    
                    <div class="analytics average margintop10">
                        Average <h3>87.44%</h3>
                    </div><!--analytics-->
                    
                </div><!--one_half-->
                
                
                <br clear="all" />
            </div><!--widgetcontent-->
        </div><!--Active Visits-->
        
        
        <div class="widgetbox">
            <div class="title"><h2 class="pie"><span style="text-align:left !important;">Engagement</span></h2></div>
            <div class="widgetcontent padding0" style="text-align:center;">
                <div class="clear"></div>
                <img src="images/charts/pie.png" height="198" width="254" alt="" />
                <div class="clear"></div>
                <script>

// Run the code when the DOM is ready
$j( pieChart );

function pieChart() {

  // Config settings
  var chartSizePercent = 55;                        // The chart radius relative to the canvas width/height (in percent)
  var sliceBorderWidth = 1;                         // Width (in pixels) of the border around each slice
  var sliceBorderStyle = "#fff";                    // Colour of the border around each slice
  var sliceGradientColour = "#ddd";                 // Colour to use for one end of the chart gradient
  var maxPullOutDistance = 25;                      // How far, in pixels, to pull slices out when clicked
  var pullOutFrameStep = 4;                         // How many pixels to move a slice with each animation frame
  var pullOutFrameInterval = 40;                    // How long (in ms) between each animation frame
  var pullOutLabelPadding = 65;                     // Padding between pulled-out slice and its label  
  var pullOutLabelFont = "bold 16px 'Trebuchet MS', Verdana, sans-serif";  // Pull-out slice label font
  var pullOutValueFont = "bold 12px 'Trebuchet MS', Verdana, sans-serif";  // Pull-out slice value font
  var pullOutValuePrefix = "$";                     // Pull-out slice value prefix
  var pullOutShadowColour = "rgba( 0, 0, 0, .5 )";  // Colour to use for the pull-out slice shadow
  var pullOutShadowOffsetX = 5;                     // X-offset (in pixels) of the pull-out slice shadow
  var pullOutShadowOffsetY = 5;                     // Y-offset (in pixels) of the pull-out slice shadow
  var pullOutShadowBlur = 5;                        // How much to blur the pull-out slice shadow
  var pullOutBorderWidth = 2;                       // Width (in pixels) of the pull-out slice border
  var pullOutBorderStyle = "#333";                  // Colour of the pull-out slice border
  var chartStartAngle = -.5 * Math.PI;              // Start the chart at 12 o'clock instead of 3 o'clock

  // Declare some variables for the chart
  var canvas;                       // The canvas element in the page
  var currentPullOutSlice = -1;     // The slice currently pulled out (-1 = no slice)
  var currentPullOutDistance = 0;   // How many pixels the pulled-out slice is currently pulled out in the animation
  var animationId = 0;              // Tracks the interval ID for the animation created by setInterval()
  var chartData = [];               // Chart data (labels, values, and angles)
  var chartColours = [];            // Chart colours (pulled from the HTML table)
  var totalValue = 0;               // Total of all the values in the chart
  var canvasWidth = 160;                  // Width of the canvas, in pixels
  var canvasHeight = 160;                 // Height of the canvas, in pixels
  var centreX;                      // X-coordinate of centre of the canvas/chart
  var centreY;                      // Y-coordinate of centre of the canvas/chart
  var chartRadius;                  // Radius of the pie chart, in pixels

  // Set things up and draw the chart
  init();


  /**
   * Set up the chart data and colours, as well as the chart and table click handlers,
   * and draw the initial pie chart
   */

  function init() {

    // Get the canvas element in the page
    canvas = document.getElementById('chart');

    // Exit if the browser isn't canvas-capable
    if ( typeof canvas.getContext === 'undefined' ) return;

    // Initialise some properties of the canvas and chart
    canvasWidth = canvas.width;
    canvasHeight = canvas.height;
    centreX = canvasWidth / 2;
    centreY = canvasHeight / 2;
    chartRadius = Math.min( canvasWidth, canvasHeight ) / 2 * ( chartSizePercent / 100 );

    // Grab the data from the table,
    // and assign click handlers to the table data cells
    
    var currentRow = -1;
    var currentCell = 0;

    $('#chartData td').each( function() {
      currentCell++;
      if ( currentCell % 2 != 0 ) {
        currentRow++;
        chartData[currentRow] = [];
        chartData[currentRow]['label'] = $(this).text();
      } else {
       var value = parseFloat($(this).text());
       totalValue += value;
       value = value.toFixed(2);
       chartData[currentRow]['value'] = value;
      }

      // Store the slice index in this cell, and attach a click handler to it
      $(this).data( 'slice', currentRow );
      $(this).click( handleTableClick );

      // Extract and store the cell colour
      if ( rgb = $(this).css('color').match( /rgb\((\d+), (\d+), (\d+)/) ) {
        chartColours[currentRow] = [ rgb[1], rgb[2], rgb[3] ];
      } else if ( hex = $(this).css('color').match(/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/) ) {
        chartColours[currentRow] = [ parseInt(hex[1],16) ,parseInt(hex[2],16), parseInt(hex[3], 16) ];
      } else {
        alert( "Error: Colour could not be determined! Please specify table colours using the format '#xxxxxx'" );
        return;
      }

    } );

    // Now compute and store the start and end angles of each slice in the chart data

    var currentPos = 0; // The current position of the slice in the pie (from 0 to 1)

    for ( var slice in chartData ) {
      chartData[slice]['startAngle'] = 2 * Math.PI * currentPos;
      chartData[slice]['endAngle'] = 2 * Math.PI * ( currentPos + ( chartData[slice]['value'] / totalValue ) );
      currentPos += chartData[slice]['value'] / totalValue;
    }

    // All ready! Now draw the pie chart, and add the click handler to it
    drawChart();
    $j('#chart').click ( handleChartClick );
  }


  /**
   * Process mouse clicks in the chart area.
   *
   * If a slice was clicked, toggle it in or out.
   * If the user clicked outside the pie, push any slices back in.
   *
   * @param Event The click event
   */

  function handleChartClick ( clickEvent ) {

    // Get the mouse cursor position at the time of the click, relative to the canvas
    var mouseX = clickEvent.pageX - this.offsetLeft;
    var mouseY = clickEvent.pageY - this.offsetTop;

    // Was the click inside the pie chart?
    var xFromCentre = mouseX - centreX;
    var yFromCentre = mouseY - centreY;
    var distanceFromCentre = Math.sqrt( Math.pow( Math.abs( xFromCentre ), 2 ) + Math.pow( Math.abs( yFromCentre ), 2 ) );

    if ( distanceFromCentre <= chartRadius ) {

      // Yes, the click was inside the chart.
      // Find the slice that was clicked by comparing angles relative to the chart centre.

      var clickAngle = Math.atan2( yFromCentre, xFromCentre ) - chartStartAngle;
      if ( clickAngle < 0 ) clickAngle = 2 * Math.PI + clickAngle;
                  
      for ( var slice in chartData ) {
        if ( clickAngle >= chartData[slice]['startAngle'] && clickAngle <= chartData[slice]['endAngle'] ) {

          // Slice found. Pull it out or push it in, as required.
          toggleSlice ( slice );
          return;
        }
      }
    }

    // User must have clicked outside the pie. Push any pulled-out slice back in.
    pushIn();
  }


  /**
   * Process mouse clicks in the table area.
   *
   * Retrieve the slice number from the jQuery data stored in the
   * clicked table cell, then toggle the slice
   *
   * @param Event The click event
   */

  function handleTableClick ( clickEvent ) {
    var slice = $(this).data('slice');
    toggleSlice ( slice );
  }


  /**
   * Push a slice in or out.
   *
   * If it's already pulled out, push it in. Otherwise, pull it out.
   *
   * @param Number The slice index (between 0 and the number of slices - 1)
   */

  function toggleSlice ( slice ) {
    if ( slice == currentPullOutSlice ) {
      pushIn();
    } else {
      startPullOut ( slice );
    }
  }

 
  /**
   * Start pulling a slice out from the pie.
   *
   * @param Number The slice index (between 0 and the number of slices - 1)
   */

  function startPullOut ( slice ) {

    // Exit if we're already pulling out this slice
    if ( currentPullOutSlice == slice ) return;

    // Record the slice that we're pulling out, clear any previous animation, then start the animation
    currentPullOutSlice = slice;
    currentPullOutDistance = 0;
    clearInterval( animationId );
    animationId = setInterval( function() { animatePullOut( slice ); }, pullOutFrameInterval );

    // Highlight the corresponding row in the key table
    $j('#chartData td').removeClass('highlight');
    var labelCell = $('#chartData td:eq(' + (slice*2) + ')');
    var valueCell = $('#chartData td:eq(' + (slice*2+1) + ')');
    labelCell.addClass('highlight');
    valueCell.addClass('highlight');
  }

 
  /**
   * Draw a frame of the pull-out animation.
   *
   * @param Number The index of the slice being pulled out
   */

  function animatePullOut ( slice ) {

    // Pull the slice out some more
    currentPullOutDistance += pullOutFrameStep;

    // If we've pulled it right out, stop animating
    if ( currentPullOutDistance >= maxPullOutDistance ) {
      clearInterval( animationId );
      return;
    }

    // Draw the frame
    drawChart();
  }

 
  /**
   * Push any pulled-out slice back in.
   *
   * Resets the animation variables and redraws the chart.
   * Also un-highlights all rows in the table.
   */

  function pushIn() {
    currentPullOutSlice = -1;
    currentPullOutDistance = 0;
    clearInterval( animationId );
    drawChart();
    $j('#chartData td').removeClass('highlight');
  }
 
 
  /**
   * Draw the chart.
   *
   * Loop through each slice of the pie, and draw it.
   */

  function drawChart() {

    // Get a drawing context
    var context = canvas.getContext('2d');
        
    // Clear the canvas, ready for the new frame
    context.clearRect ( 0, 0, canvasWidth, canvasHeight );

    // Draw each slice of the chart, skipping the pull-out slice (if any)
    for ( var slice in chartData ) {
      if ( slice != currentPullOutSlice ) drawSlice( context, slice );
    }

    // If there's a pull-out slice in effect, draw it.
    // (We draw the pull-out slice last so its drop shadow doesn't get painted over.)
    if ( currentPullOutSlice != -1 ) drawSlice( context, currentPullOutSlice );
  }


  /**
   * Draw an individual slice in the chart.
   *
   * @param Context A canvas context to draw on  
   * @param Number The index of the slice to draw
   */

  function drawSlice ( context, slice ) {

    // Compute the adjusted start and end angles for the slice
    var startAngle = chartData[slice]['startAngle']  + chartStartAngle;
    var endAngle = chartData[slice]['endAngle']  + chartStartAngle;
      
    if ( slice == currentPullOutSlice ) {

      // We're pulling (or have pulled) this slice out.
      // Offset it from the pie centre, draw the text label,
      // and add a drop shadow.

      var midAngle = (startAngle + endAngle) / 2;
      var actualPullOutDistance = currentPullOutDistance * easeOut( currentPullOutDistance/maxPullOutDistance, .8 );
      startX = centreX + Math.cos(midAngle) * actualPullOutDistance;
      startY = centreY + Math.sin(midAngle) * actualPullOutDistance;
      context.fillStyle = 'rgb(' + chartColours[slice].join(',') + ')';
      context.textAlign = "center";
      context.font = pullOutLabelFont;
      context.fillText( chartData[slice]['label'], centreX + Math.cos(midAngle) * ( chartRadius + maxPullOutDistance + pullOutLabelPadding ), centreY + Math.sin(midAngle) * ( chartRadius + maxPullOutDistance + pullOutLabelPadding ) );
      context.font = pullOutValueFont;
      context.fillText( pullOutValuePrefix + chartData[slice]['value'] + " (" + ( parseInt( chartData[slice]['value'] / totalValue * 100 + .5 ) ) +  "%)", centreX + Math.cos(midAngle) * ( chartRadius + maxPullOutDistance + pullOutLabelPadding ), centreY + Math.sin(midAngle) * ( chartRadius + maxPullOutDistance + pullOutLabelPadding ) + 20 );
      context.shadowOffsetX = pullOutShadowOffsetX;
      context.shadowOffsetY = pullOutShadowOffsetY;
      context.shadowBlur = pullOutShadowBlur;

    } else {

      // This slice isn't pulled out, so draw it from the pie centre
      startX = centreX;
      startY = centreY;
    }

    // Set up the gradient fill for the slice
    var sliceGradient = context.createLinearGradient( 0, 0, canvasWidth*.95, canvasHeight*.95 );
    sliceGradient.addColorStop( 0, sliceGradientColour );
    sliceGradient.addColorStop( 1, 'rgb(' + chartColours[slice].join(',') + ')' );

    // Draw the slice
    context.beginPath();
    context.moveTo( startX, startY );
    context.arc( startX, startY, chartRadius, startAngle, endAngle, false );
    context.lineTo( startX, startY );
    context.closePath();
    context.fillStyle = sliceGradient;
    context.shadowColor = ( slice == currentPullOutSlice ) ? pullOutShadowColour : "rgba( 0, 0, 0, 0 )";
    context.fill();
    context.shadowColor = "rgba( 0, 0, 0, 0 )";

    // Style the slice border appropriately
    if ( slice == currentPullOutSlice ) {
      context.lineWidth = pullOutBorderWidth;
      context.strokeStyle = pullOutBorderStyle;
    } else {
      context.lineWidth = sliceBorderWidth;
      context.strokeStyle = sliceBorderStyle;
    }

    // Draw the slice border
    context.stroke();
  }


  /**
   * Easing function.
   *
   * A bit hacky but it seems to work! (Note to self: Re-read my school maths books sometime)
   *
   * @param Number The ratio of the current distance travelled to the maximum distance
   * @param Number The power (higher numbers = more gradual easing)
   * @return Number The new ratio
   */

  function easeOut( ratio, power ) {
    return ( Math.pow ( 1 - ratio, power ) + 1 );
  }

};

</script>
        <!--<canvas id="chart" width="295" height="175"></canvas>-->

                <!--<table id="chartData">

                <tr>
                <th>Widget</th><th>Sales ($)</th>
                </tr>

                <tr style="color: #0DA068">
                <td>SuperWidget</td><td>1862.12</td>
                </tr>

                <tr style="color: #194E9C">
                <td>MegaWidget</td><td>1316.00</td>
                </tr>

                <tr style="color: #ED9C13">
                <td>HyperWidget</td><td>712.49</td>
                </tr>

                <tr style="color: #ED5713">
                <td>WonderWidget</td><td>3236.27</td>
                </tr>

                <tr style="color: #057249">
                <td>MicroWidget</td><td>6122.06</td>
                </tr>

                <tr style="color: #5F91DC">
                <td>NanoWidget</td><td>128.11</td>
                </tr>

                <tr style="color: #F88E5D">
                <td>LovelyWidget</td><td>245.55</td>
                </tr>
                </table>-->

                </div><!--widgetcontent-->
                </div><!--Engagement-->

                <div class="widgetbox">
                    <div class="title">
                        <h2 class="timer"><span>Load Time</span></h2>
                    </div>
                    <div class="widgetcontent">
                        <div class="load_time">
                            <img src="images/charts/load_time.png" height="45" width="45" alt="" />
                            <p>
                                <strong>5</strong> sec
                                <br />
                                User page load
                            </p>
                        </div>
                        <div class="load_timer">
                            <img src="images/charts/load_time.png" height="45" width="45" alt="" />
                            <p>
                                <strong>1445</strong> sec
                                <br />
                                Server page load
                            </p>
                        </div>
                    </div><!--widgetcontent-->
                </div><!--Load Time-->

                <div class="widgetbox">
                    <div class="title">
                        <h2 class="browser1"><span>Browser Views</span></h2>
                    </div>
                    <div class="widgetcontent">
                        <img src="images/charts/bar.png" height="71" width="240" />
                        <div class="clear"></div>
                        <div class="browser_firefox">
                            <span></span> Firefox <strong>8255 users</strong>
                        </div>
                        <div class="browser_chrome">
                            <span></span> Google Chrome <strong>7800 users</strong>
                        </div>
                        <div class="browser_opera">
                            <span></span> Opera <strong>485 users</strong>
                        </div>
                        <div class="browser_safari">
                            <span></span> Safari <strong>970 users</strong>
                        </div>
                    </div><!--widgetcontent-->
                </div><!--browser views-->

                <div class="widgetbox">
                    <div class="title">
                        <h2 class="browser1"><span>Country Views</span></h2>
                    </div>
                    <div class="widgetcontent">
                        <img src="images/charts/world.png" height="168" width="262" />

                    </div><!--widgetcontent-->
                </div><!--world views-->

                </div><!--mainrightinner-->
                </div><!--mainright-->