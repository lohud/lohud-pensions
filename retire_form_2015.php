<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// header("Location: http://data.lohud.com/tools/pensions/retire_form_2015.php");
// die();

require('mysql_connect2.php');

function selectDistinct ($connection, $tableName, $attributeName, $counties = 0, $pulldownName, $alltext,$selected) {
  $defaultWithinResultSet = FALSE;
  // Query to find distinct values of $attributeName in $tableName
  $distinctQuery = "SELECT DISTINCT {$attributeName} FROM {$tableName} WHERE 1";
  if($counties&&is_array($counties)) {
    $distinctQuery .=" and ccde in (\"" . implode('", "', $counties) . "\")";
  }
  elseif(strlen($counties)==2) {
    $distinctQuery .=" and ccde = \"" . $counties . "\"";
  }
  $distinctQuery .= " and  {$attributeName} IS NOT NULL AND LENGTH({$attributeName})>0 ORDER BY 1";
  //for debugging only
  //echo $distinctQuery;
  // Run the distinctQuery on the databaseName
  $resultId = mysql_query ($distinctQuery) or die ("\n<select name=\"{$pulldownName}\" id=\"id_{$pulldownName}\" ><option selected = 1 value =\"all\">No records found</option>");
  // Start the select widget
  print "\n<select name=\"{$pulldownName}\" id=\"id_{$pulldownName}\" ><option value =\"all\">All {$alltext}</option>";
  // Retrieve each row from the query
  while ($row = @ mysql_fetch_array($resultId)){
    // Get the value for the attribute to be displayed
    $result = addslashes($row[$attributeName]);
    // Check if a defaultValue is set and, if so, is it the
    // current database value?
    print "\n\t<option";
    if ($result == $selected) {
      print " selected = \"yes\"";
    }
    print " value=\"{$result}\">{$result}";
    print "</option>";
  }
print "\n</select>";
} //ends function
//include("header.html");    
$pageref = "NYS Retirement 2015" ;  
include('header.php')
?>
<div id='banner' style="height:77px;"></div>
<script>
if(window.self==window.top) {
  var banner = document.getElementById("banner");
  banner.style.backgroundColor = "black"; 
  banner.innerHTML = "<a href='http://www.lohud.com'><img src='http://data.lohud.com/lohud%20logos/site-masthead-logo.png' width='300' /></a><br>";
}
</script>  

  <div class="row" style="padding-top:20px; padding-bottom:20px;">
    <div class="large-12 columns">
      <h3 class="pcase">Find NY state and local pensions (2015)</h3>
      <p>See records for all 394,021 retirees from agencies and municipalities whose pensions were calculated by the end of the fiscal year March 31.</p>
      <p>School districts are included but list only non-professional employees. Teachers and administrators use a different retirement system.</p>
      <form action="see_retire_2015.php" id="searchform" method="get" name="searchform" target="dataframe" class="callout primary">
        <table valign="top">
          <tr>
            <td>
              <fieldset>
                <legend>Search options</legend> 
                <label for="id_frmcounty&quot;">County:</label>
                <select id="id_frmcounty" name="county">
                  <option value="lohud">
                    Lower Hudson Valley
                  </option>
                  <option value="all">
                    Statewide
                  </option>
                  <option>
                    Westchester
                  </option>
                  <option>
                    Rockland
                  </option>
                  <option>
                    Putnam
                  </option>
                  <option>
                    Albany
                  </option>
                  <option>
                    Allegany
                  </option>
                  <option>
                    Bronx
                  </option>
                  <option>
                    Broome
                  </option>
                  <option>
                    Cattaraugus
                  </option>
                  <option>
                    Cayuga
                  </option>
                  <option>
                    Chautauqua
                  </option>
                  <option>
                    Chemung
                  </option>
                  <option>
                    Chenango
                  </option>
                  <option>
                    Clinton
                  </option>
                  <option>
                    Columbia
                  </option>
                  <option>
                    Cortland
                  </option>
                  <option>
                    Delaware
                  </option>
                  <option>
                    Dutchess
                  </option>
                  <option>
                    Erie
                  </option>
                  <option>
                    Essex
                  </option>
                  <option>
                    Franklin
                  </option>
                  <option>
                    Fulton
                  </option>
                  <option>
                    Genesee
                  </option>
                  <option>
                    Greene
                  </option>
                  <option>
                    Hamilton
                  </option>
                  <option>
                    Herkimer
                  </option>
                  <option>
                    Jefferson
                  </option>
                  <option>
                    Kings
                  </option>
                  <option>
                    Lewis
                  </option>
                  <option>
                    Livingston
                  </option>
                  <option>
                    Madison
                  </option>
                  <option>
                    Monroe
                  </option>
                  <option>
                    Montgomery
                  </option>
                  <option>
                    Nassau
                  </option>
                  <option>
                    New York
                  </option>
                  <option>
                    Niagara
                  </option>
                  <option>
                    Oneida
                  </option>
                  <option>
                    Onondaga
                  </option>
                  <option>
                    Ontario
                  </option>
                  <option>
                    Orange
                  </option>
                  <option>
                    Orleans
                  </option>
                  <option>
                    Oswego
                  </option>
                  <option>
                    Otsego
                  </option>
                  <option>
                    Queens
                  </option>
                  <option>
                    Rensselaer
                  </option>
                  <option>
                    Richmond
                  </option>
                  <option>
                    Saratoga
                  </option>
                  <option>
                    Schenectady
                  </option>
                  <option>
                    Schoharie
                  </option>
                  <option>
                    Schuyler
                  </option>
                  <option>
                    Seneca
                  </option>
                  <option>
                    St Lawrence
                  </option>
                  <option>
                    Steuben
                  </option>
                  <option>
                    Suffolk
                  </option>
                  <option>
                    Sullivan
                  </option>
                  <option>
                    Tioga
                  </option>
                  <option>
                    Tompkins
                  </option>
                  <option>
                    Ulster
                  </option>
                  <option>
                    Warren
                  </option>
                  <option>
                    Washington
                  </option>
                  <option>
                    Wayne
                  </option>
                  <option>
                    Wyoming
                  </option>
                  <option>
                    Yates
                  </option>
                  <option>
                    Unknown
                  </option>
                </select>
                <label for="id_frm_muni&quot;">Employer:</label>
                <select id="id_frm_muni" name="frm_muni">
                  <option selected="yes" value='all'>
                    Choose county to see employers
                  </option>
                </select>
                <label for="id_frm_name&quot;">Retiree name:</label>
                <input id="id_frm_name" name="frm_name" size="25" type="text">
                <legend>Advanced options</legend>
                <div class="large-6 columns">
                  <label for="id_frm_100k&quot;">Pensions over $100k only</label>
                  <input checked id="id_frm_100k" name="frm_100k" type="checkbox" value="yes">
                </div>
                <div class="large-6 columns">
                  <label for="id_frm_local&quot;">Local(non-state) employers only</label>
                  <input checked id="id_frm_local" name="frm_local" type="checkbox" value="yes">
                </div>
                <label for="id_frmyear&quot;">Retirement year:</label>
                <select id="id_frmyear" name="year">
                  <option value="all">
                    All
                  </option>
                  <option>
                    2015
                  </option>
                  <option>
                    2014
                  </option>
                  <option>
                    2013
                  </option>
                  <option>
                    2012
                  </option>
                  <option>
                    2011
                  </option>
                  <option>
                    2010
                  </option>
                  <option>
                    2009
                  </option>
                  <option>
                    2008
                  </option>
                  <option>
                    2007
                  </option>
                  <option>
                    2006
                  </option>
                  <option>
                    2005
                  </option>
                  <option>
                    2004
                  </option>
                  <option>
                    2003
                  </option>
                  <option>
                    2002
                  </option>
                  <option>
                    2001
                  </option>
                  <option>
                    2000
                  </option>
                </select>
              </fieldset>
              <input type="submit" class="button" value="SUBMIT">
              <input onclick="location.href='retire_form_2015.php'" class="button" type="button" value="NEW SEARCH">
              <input type="reset" class="button" value="RESET FORM">
            </td>
          </tr>
        </table>
      </form>
    </div>
    <div class="large-12 columns">
      <iframe frameborder="0" height="700" id="dataframe" name="dataframe" src="see_retire_2015.php?county=lohud&frm_100k=yes&frm_local=yes" width="100%"></iframe>
    </div>
  </div>
<?php
include('footer.php')
?>

