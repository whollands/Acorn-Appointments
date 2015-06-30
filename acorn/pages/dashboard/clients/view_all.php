<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header


$Query = "SELECT ClientID, Name FROM Clients ORDER BY ClientID";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
?>

<div class="container">

<div class="col-md-11">
	<h1><i class="fa fa-users"></i> Clients</h1>
</div>

<div class="col-md-1">
	<a href="<?php echo constant("BASE_URL"); ?>dashboard/clients/add" class="btn btn-success btn-md" style="text-align:right;"><i class="fa fa-plus"></i> New Client</a>
</div>

<?php
		
if($Result->num_rows >= 1)
{
?>

<div class="row">
 <div class="col-lg-6">
    <div class="input-group">
    <form action="<?php echo constant("BASE_URL"); ?>dashboard/clients/search" method="get">
      <input type="search" name="search_term" class="form-control" placeholder="Search for clients...">
    </form>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div>
  
<table class="table table-hover">

<thead>
	<tr>
		<td>Name</td>
		<td>Bookings Made</td>
		<td>Actions</td>
	</tr>
</thead>
<tbody>
<?php
	while($row = $Result->fetch_assoc())
	{
	echo "<tr>";
	echo "<td>" . $row["Name"] . "</td>";
	echo "<td>";
		$Query_2 = "SELECT ClientID FROM Appointments WHERE ClientID='".$row["ClientID"]."'";
		$Result_2 = $GLOBALS["MYSQL_CON"]->query($Query_2);
		echo $Result_2->num_rows;
	echo "</td>";
	echo "<td>";
	echo "<a href=\"" . constant("BASE_URL") . "dashboard/clients/view/" .$row["ClientID"]."\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-search\"></i> View</a>&nbsp;";
	echo "<a href=\"" . constant("BASE_URL") . "dashboard/clients/edit/" .$row["ClientID"]."\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-pencil\"></i> Edit</a>&nbsp;";
	echo "<a href=\"" . constant("BASE_URL") . "dashboard/clients/delete/" .$row["ClientID"]."\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i> Delete</a>";
	echo "</td>";
	echo "</tr>";
	}
	
	?>
	
	</tbody>
</table>

	<?php
}
else
{
	echo "No clients yet.";
}
?>


</div>

<?php

include("acorn/global/admin-html-footer.php");
// include html footer


