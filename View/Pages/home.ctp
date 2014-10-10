
<h1>EPE Time-Series Service</h1>
<p><em>Access oceanographic data and information the easy way.</em></p>

<p>This server provides an easy way to access station information and data from a number of popular oceanographic data providers, including  <a href="http://dods.ndbc.noaa.gov/">NDBC DODS</a>, and <a href="http://opendap.co-ops.nos.noaa.gov/ioos-dif-sos/">NOAA CO-OPS SOS (in development)</a>.  It was developed to support the educational visualization tools of the Ocean Observatories Initiative (OOI) <a href="http://education.oceanobservatories.org">Ocean Education Portal</a>.  Use the menu below to find more about the different services available through this API.</p>

<hr>

<div class="row">
  <div class="col-md-3">

<!-- Nav tabs -->
<ul class="nav nav-pills nav-stacked" role="tablist">
  <li class="active"><a href="#networks" role="tab" data-toggle="tab">Networks</a></li>
  <li><a href="#parameters" role="tab" data-toggle="tab">Parameters</a></li>
  <li><a href="#stations" role="tab" data-toggle="tab">Stations</a></li>
  <li><a href="#data" role="tab" data-toggle="tab">Data</a></li>
</ul>

    
  </div>
  <div class="col-md-9">

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="networks">
    <h3>Full Network List</h3>
    <p>Example: <?php echo $this->html->link('/networks',array('controller'=>'networks'))?></p>
    <p>A full listing of all networks available in the system.</p>
    <p><em>Returns a JSON array of all networks.</em></p>
    
    <h3>Network Details</h3>
    <p>Example: <?php echo $this->html->link('/networks/view/ndbc',array('controller'=>'networks','action'=>'view','ndbc'))?></p>
    <p>Details for the specified network, given as /networks/(name).</p>
    <p><em>Returns a JSON array of the selected network.</em></p>        
  </div>
  
  <div class="tab-pane" id="parameters">
    <h3>Full Parameter List</h3>
    <p>Example: <?php echo $this->html->link('/parameters',array('controller'=>'parameters'))?></p>
    <p>A full listing of all parameters available in the system.</p>
    <p><em>Returns a JSON array of all parameters.</em></p>
    
    <h3>Parameter Details</h3>
    <p>Example: <?php echo $this->html->link('/parameters/view/air_temperature',array('controller'=>'parameters','action'=>'view','air_temperature'))?></p>
    <p>Details for the specified parameter, given as /parameters/(name).</p>
    <p><em>Returns a JSON array of the selected parameter.</em></p>        
  </div>
  
  <div class="tab-pane" id="stations">
    <h3>Full Station List </h3>
    <p>Example: <?php echo $this->html->link('/stations',array('controller'=>'stations'))?></p>
    <p>A full listing of all stations currently in the system.</p>
    <p><em>Returns a GeoJSON array of all stations.</em></p>
    
    <h3>Station Details</h3>
    <p>Example: <?php echo $this->html->link('/stations/view/ndbc/44025',array('controller'=>'stations','action'=>'view','ndbc','44025'))?></p>
    <p>Details for the specified station, given as /stations/(network)/(name).  (network) should be NDBC or CO-OPS.  (name) is the station's name, which can be found in the station listing.</p>
    <p><em>Returns a JSON array of the selected station.</em></p>
    
    <h3>Station Search</h3>
    <p>Examples:</p>
    <ul><li><?php echo $this->html->link('/stations/search?networks=ndbc&parameters=salinity&location=-77,35,-69,42&start_time=2013-01-01&end_time=2014-01-01','/stations/search?networks=ndbc&parameters=salinity&location=-77,35,-69,42&start_time=2013-01-01&end_time=2014-01-01')?></li>   
   <li><?php echo $this->html->link('/stations/search?networks=NDBC&parameters=air_temperature,salinity&location=-77,25,-69,45&start_time=10&end_time=now','/stations/search?networks=NDBC&parameters=air_temperature,salinity&location=-77,25,-69,45&start_time=10&end_time=now')?></li></ul>    
    <p>Search for stations within the specified criteria.</p>
    <p>Optional parameters:</p>
    <ul>
      <li><strong>networks</strong>: comma separated list of desired networks</li>
      <li><strong>parameters</strong>: comma separated list of desired parameters (returns any matches, i.e. not just intersecting matches)</li>
      <li><strong>location</strong>: lon_min,lat_min,lon_max,lat_max</li>
      <li><strong>start_time</strong>: Either 0000-00-00T00:00Z or number of days before end_time</li>
      <li><strong>end_time</strong>: Either 0000-00-00T00:00Z or now.  Note, both start_time and end_time must be specified if either is given.</li>
    </ul>
    <p><em>Returns a GeoJSON array of all stations found.</em></p>    
  </div>
  
  <div class="tab-pane" id="data">
    <h3>Time-Series Data</h3>
    <p>Examples:</p>
    <ul><li><?php echo $this->html->link('/timeseries?network=ndbc&station=44025&parameter=air_temperature&start_time=5&end_time=now',array('controller'=>'timeseries','action'=>'?network=ndbc&station=44025&parameter=air_temperature&start_time=5&end_time=now'))?></li>
    <li><?php echo $this->html->link('/timeseries?network=ndbc&station=44027&parameter=air_temperature&start_time=1&end_time=2013-07-01',array('controller'=>'timeseries','action'=>'?network=ndbc&station=44027&parameter=air_temperature&start_time=1&end_time=2013-07-01'))?></li></ul>
    
    <p>Request time-series data for a specific station and parameter over the specified time range.</p>
    <p>Required parameters:</p>
    <ul>
      <li><strong>network</strong>: the network name </li>
      <li><strong>station</strong>: the station name, which can be found in the station listing</li>
      <li><strong>parameter</strong>: desired parameter (currently, only one request at a time is supported)</li>
      <li><strong>start_time</strong>: Either a formatted data/time (0000-00-00T00:00Z or 0000-00-00) or the number of days before end_time</li>
      <li><strong>end_time</strong>: Either a formatted date/time or 'now'.  Note, both start_time and end_time must be specified if either is given.</li>
      <li><strong>type</strong>: (optional): raw (default)</li>
    </ul>
    <p><em>Returns a CSV file of time and observed values.</em></p>
  </div>
</div>

  </div>
</div>





