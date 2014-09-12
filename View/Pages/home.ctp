
<h1>EPE Time-Series Service</h1>
<p><em>Access oceanographic data and information the easy way.</em></p>

<p>This server provides an easy way to access information and data from a number of popular oceanographic web services.  It was developed to support the educational visualization tools of the Ocean Observatories Initiative (OOI) <a href="http://education.oceanobservatories.org">Ocean Education Portal</a>.</p>
<p>With the Time-Series API, you can retrieve station information and data from a number of popular oceanographic web services.  The following services are currently supported: </p>
<ul>
  <li><a href="http://dods.ndbc.noaa.gov/">NDBC DODS</a></li>
  <li><a href="http://opendap.co-ops.nos.noaa.gov/ioos-dif-sos/">NOAA CO-OPS SOS (in development)</a></li>
</ul>

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
    <p>Returns a json array of all networks</p>
    
    <h3>Network Details</h3>
    <p>Example: <?php echo $this->html->link('/networks/view/ndbc',array('controller'=>'networks','action'=>'view','ndbc'))?></p>
    <p>Details for the specified network, given as /networks/(name).</p>
    <p>Returns a json array of the selected network.</p>        
  </div>
  
  <div class="tab-pane" id="parameters">
    <h3>Full Parameter List</h3>
    <p>Example: <?php echo $this->html->link('/parameters',array('controller'=>'parameters'))?></p>
    <p>A full listing of all parameters available in the system.</p>
    <p>Returns a json array of all parameters</p>
    
    <h3>Parameter Details</h3>
    <p>Example: <?php echo $this->html->link('/parameters/view/air_temperature',array('controller'=>'parameters','action'=>'view','air_temperature'))?></p>
    <p>Details for the specified parameter, given as /parameters/(name).</p>
    <p>Returns a json array of the selected parameter.</p>        
  </div>
  
  <div class="tab-pane" id="stations">
    <h3>Full Station List </h3>
    <p>Example: <?php echo $this->html->link('/stations',array('controller'=>'stations'))?></p>
    <p>A full listing of all stations currently in the system.</p>
    <p>Returns a geojson array of all stations.</p>
    
    <h3>Station Details</h3>
    <p>Example: <?php echo $this->html->link('/stations/view/ndbc/44025',array('controller'=>'stations','action'=>'view','ndbc','44025'))?></p>
    <p>Details for the specified station, given as /stations/(network)/(name).  (network) should be NDBC or CO-OPS.  (name) is the station's name, which can be found in the station listing.</p>
    <p>Returns a json array of the selected station.</p>
    
    <h3>Station Search</h3>
    <p>Example: <?php echo $this->html->link('/stations/search?networks=CO-OPS&parameters=salinity&location=-77,35,-69,42&start_time=1&end_time=now',array('controller'=>'stations','action'=>'search','?'=>array('networks'=>'CO-OPS','parameters'=>'salinity','location'=>'-77,35,-69,42','start_time'=>'1','end_time'=>'now')))?></p>
    <p>Search for stations within the specified criteria.</p>
    <p>Optional parameters:</p>
    <ul>
      <li><strong>networks</strong>: comma separated list of desired networks</li>
      <li><strong>parameters</strong>: comma separated list of desired parameters (returns any matches, i.e. not just intersecting matches)</li>
      <li><strong>location</strong>: lon_min,lat_min,lon_max,lat_max</li>
      <li><strong>start_time</strong>: Either 0000-00-00T00:00Z or number of days before end_time</li>
      <li><strong>end_time</strong>: Either 0000-00-00T00:00Z or now.  Note, both start_time and end_time must be specified if either is given.</li>
    </ul>
    <p>Returns a geojson array of all stations found.</p>    
  </div>
  
  <div class="tab-pane" id="data">
    <h3>Time-Series Data</h3>
    <p>Example: <?php echo $this->html->link('/timeseries?network=NDBC&station=44025&parameter=air_temperature&start_time=5&end_time=now',array('controller'=>'timeseries','action'=>'?network=NDBC&station=44025&parameter=air_temperature&start_time=5&end_time=now'))?></p>
    <p>Example: <?php echo $this->html->link('/timeseries?network=CO-OPS&station=8635750&parameter=air_temperature&start_time=1&end_time=2013-07-01',array('controller'=>'timeseries','action'=>'?network=CO-OPS&station=8635750&parameter=air_temperature&start_time=1&end_time=2013-07-01'))?></p>
    
    <p>Request time-series data for a specific station and parameter over the specified time range.</p>
    <p>Optional parameters:</p>
    <ul>
      <li><strong>network</strong>: should be NDBC or CO-OPS</li>
      <li><strong>station</strong>: is the station's name, which can be found in the station listing</li>
      <li><strong>parameter</strong>: desired parameter (currently, only one request at a time is supported)</li>
      <li><strong>start_time</strong>: Either 0000-00-00T00:00Z or number of days before end_time</li>
      <li><strong>end_time</strong>: Either 0000-00-00T00:00Z or 'now'.  Note, both start_time and end_time must be specified if either is given.</li>
      <li><strong>type</strong>: (optional): raw (default)</li>
    </ul>
    <p>Returns a csv file of time and observed values.</p>
  </div>
</div>

  </div>
</div>





