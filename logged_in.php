<!-- if you need user information, just put them into the $_SESSION variable and output them here -->
<!DOCTYPE html>
<html lang="LT">
<head>
	<meta charset="utf-8">
    <!-- ===========================
    INFORMACIJA
    =========================== -->    
    <meta name="description" content="KALĖDINIS LOTO, Registruok pirkimo kvitą ir laimėk vertingus prizus">
    <meta name="keywords" content="Kalėdos, Kalėdinis, loterija, loto">
        
    <!-- ===========================
    PUSLAPIO PAVADINIMAS
    =========================== -->
    <title>LOTERIJA - Registruok pirkimo kvitą ir laimėk!</title>
    
    <!-- ===========================
    FAVICONS
    =========================== -->
    <link rel="icon" href="img/favicon.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-ipad-retina.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-iphone-retina.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-ipad.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-iphone.png" />
    
    <!-- ===========================
    CSS
    =========================== --> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="tablesorter-master/css/theme.bootstrap_3.css">
	<link rel="stylesheet" href="tablesorter-master/addons/pager/jquery.tablesorter.pager.css">
	<link rel="stylesheet" href="css/admin.css">
	 
    <!-- ===========================
    SCRIPT'AI
    =========================== -->    
		
    <script src="js/jquery-3.2.1.js"></script> 
	<script type="text/javascript" src="tablesorter-master/js/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="tablesorter-master/js/jquery.tablesorter.widgets.js"></script>
	<script type="text/javascript" src="tablesorter-master/addons/pager/jquery.tablesorter.pager.js"></script>
	<script>
	$(function() {

	$.tablesorter.themes.bootstrap = {
    // these classes are added to the table. To see other table classes available,
    // look here: http://getbootstrap.com/css/#tables
    table        : 'table table-bordered table-striped',
    caption      : 'caption',
    // header class names
    header       : 'bootstrap-header', // give the header a gradient background (theme.bootstrap_2.css)
    sortNone     : '',
    sortAsc      : '',
    sortDesc     : '',
    active       : '', // applied when column is sorted
    hover        : '', // custom css required - a defined bootstrap style may not override other classes
    // icon class names
    icons        : '', // add "bootstrap-icon-white" to make them white; this icon class is added to the <i> in the header
    iconSortNone : 'bootstrap-icon-unsorted', // class name added to icon when column is not sorted
    iconSortAsc  : 'glyphicon glyphicon-chevron-up', // class name added to icon when column has ascending sort
    iconSortDesc : 'glyphicon glyphicon-chevron-down', // class name added to icon when column has descending sort
    filterRow    : '', // filter row class; use widgetOptions.filter_cssFilter for the input/select element
    footerRow    : '',
    footerCells  : '',
    even         : '', // even row zebra striping
    odd          : ''  // odd row zebra striping
  };

  // call the tablesorter plugin and apply the uitheme widget
  $("table").tablesorter({
    // this will apply the bootstrap theme if "uitheme" widget is included
    // the widgetOptions.uitheme is no longer required to be set
    theme : "bootstrap",

    widthFixed: true,

    headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!

    // widget code contained in the jquery.tablesorter.widgets.js file
    // use the zebra stripe widget if you plan on hiding any rows (filter widget)
    widgets : [ "uitheme", "filter", "columns", "zebra" ],

    widgetOptions : {
      // using the default zebra striping class name, so it actually isn't included in the theme variable above
      // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
      zebra : ["even", "odd"],

      // class names added to columns when sorted
      columns: [ "primary", "secondary", "tertiary" ],

      // reset filters button
      filter_reset : ".reset",

      // extra css class name (string or array) added to the filter element (input or select)
      filter_cssFilter: "form-control",

      // set the uitheme widget to use the bootstrap theme class names
      // this is no longer required, if theme is set
      // ,uitheme : "bootstrap"

    }
  })
  .tablesorterPager({

    // target the pager markup - see the HTML block below
    container: $(".ts-pager"),

    // target the pager page select dropdown - choose a page
    cssGoto  : ".pagenum",

    // remove rows from the table to speed up the sort of large tables.
    // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
    removeRows: false,

    // output string - default is '{page}/{totalPages}';
    // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
    output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'

  });

});
	</script>
	</head>
	<body>
	<!-- DEŠINIAM KAMPE RODOMAS PRISIJUNGĘS VARTOTOJAS ir ATSIJUNGIMO NUORODA -->
	<div style='float:right;'>
		Prisijungėte kaip <span class="highlight"><?php echo $_SESSION['user_name']; ?>.</span><br> 
		<a href="duom.php?logout">Atsijungti</a>
	</div>
	
	<h3>Registruotų pirkimo kvitų sąrašas</h3>
	<!-- LENTELĖS FILTRŲ IŠVALYMAS  -->
	<button type="button" class="reset">Išvalyti filtravimą</button><br><br>
	<!-- LENTELĖS STULPELIŲ PAVADINIMAI  -->
	<table id="filters" class="tablesorter">
    <thead>
	 <tr>
	   <th>VARDAS</th>
	   <th>EL. PAŠTAS</th>
	   <th>TELEFONAS</th>
	   <th>KVITO Nr.</th>
	   <th>REGISTRAVIMO DATA</th>
	 </tr>
	</thead>
	<tfoot>
	<tr>
		<th>VARDAS</th>
	   <th>EL. PAŠTAS</th>
	   <th>TELEFONAS</th>
	   <th>KVITO Nr.</th>
	   <th>REGISTRAVIMO DATA</th>
	</tr>
	<tr>
	<!-- PUSLAPIAVIMUI  -->
	<th colspan="7" class="ts-pager form-inline">
        <div class="btn-group btn-group-sm" role="group">
          <button type="button" class="btn btn-default first"><span class="glyphicon glyphicon-step-backward"></span></button>
          <button type="button" class="btn btn-default prev"><span class="glyphicon glyphicon-backward"></span></button>
        </div>
        <span class="pagedisplay"></span>
        <div class="btn-group btn-group-sm" role="group">
          <button type="button" class="btn btn-default next"><span class="glyphicon glyphicon-forward"></span></button>
          <button type="button" class="btn btn-default last"><span class="glyphicon glyphicon-step-forward"></span></button>
        </div>
        <select class="form-control input-sm pagesize" title="Pasirinkite puslapio dydį">
          <option selected="selected" value="10">10</option>
          <option value="20">20</option>
          <option value="30">30</option>
          <option value="all">Visi</option>
        </select>
        <select class="form-control input-sm pagenum" title="Pasirinkite puslapį"></select>
      </th>
	</tr>
	</tfoot>
	<!-- ATVAIZDUOJAMI LENTELĖS DUOMENYS IŠ DUOMENŲ BAZĖS  -->
	<tbody> 
	<?php
		require '/home/mcntlt/domains/mcpoint.lt/public_html/nfq/db.php'; //Darbas su DB
		$db = new Db();
		//Traukiami visi lentelė stulpeliai iš DB
		$rows = $db -> select("SELECT * FROM `kvitai`");
		//lentelės duomenys 
		foreach($rows as $data){
		echo '<tr>';
		echo '<td>'.$data['fname'].'</td>';
		echo '<td>'.$data['email'].'</td>';
		echo '<td>'.$data['tel'].'</td>';
		echo '<td>'.$data['kvnr'].'</td>';
		echo '<td>'.$data['kada'].'</td>';
		echo '</tr>';
		}
	?>
	</tbody>
	</table>
	<br><br><br><br>
  </body>
</html>