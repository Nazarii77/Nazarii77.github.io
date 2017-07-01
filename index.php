<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <title>Companies editing tool with AngularJS, NodeJS, MySQL db</title>
  <link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/foundation/5.3.3/css/foundation.min.css'>
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <script src='http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.3/fetch.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.3/require.min.js"></script>
  <script src="js/angular.js"></script>  <!--  can`t include -->
  <script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>

<script>   
	var app = angular.module( 'app', [ ] )
.controller('companiesCtrl', function( $scope ){
  $scope.currentCompanyId = -1;
  $scope.currentMainCompanyId = -1;
  $scope.companies = <?php include "php scripts/child_company.php"; ?> ;
  $scope.main_companies = <?php include "php scripts/main_company.php"; ?> ;

  $scope.addNewCompany = function() {

    if ( $scope.name != '' ) {
      $scope.companies.push({
        name: $scope.name,
        earnings: $scope.earnings,
        owner: $scope.owner
      });
      $scope.name = '';
      $scope.earnings = '';
      $scope.owner = '';
    }
  }

  <?php include "php scripts/add_main_company.php"; ?> 



    $scope.addNewMainCompany = function() {

$.ajax({
    type: "POST",
    url: 'php scripts/add_main_company.php',
    data: {company_name: 'Wayne', company_earnings: 231237},
    success: function(data){
       // alert(data);
    }
});


    if ( $scope.company_name != '' ) {


      $scope.main_companies.push({
        company_name: $scope.company_name,
        company_earnings: $scope.company_earnings,
        combined_earnings: $scope.company_earnings   /////+ ernings of child

      });

      $scope.company_name = '';
      $scope.company_earnings = '';
      $scope.combined_earnings = '';

    }
  }






  $scope.saveCompany = function() {
    if( $scope.currentCompanyId > -1 ){
      var id = $scope.currentCompanyId;
      $scope.companies[id].name = $scope.name;
      $scope.companies[id].earnings = $scope.earnings;
      $scope.companies[id].owner = $scope.owner;
      $scope.name = '';
      $scope.earnings = '';
      $scope.owner = '';
      $scope.currentCompanyId = -1;
    }
  }
    $scope.saveMainCompany = function() {
    if( $scope.currentMainCompanyId > -1 ){
      var id = $scope.currentMainCompanyId;
      $scope.main_companies[id].company_name = $scope.company_name;
      $scope.main_companies[id].company_earnings = $scope.company_earnings;
      $scope.main_companies[id].combined_earnings = $scope.company_earnings   ;//////+  ernings of child
      $scope.company_name = '';
      $scope.company_earnings = '';
      $scope.combined_earnings = '';
      $scope.currentMainCompanyId = -1;
    }
  }
  $scope.editCompany = function ( id ) {
    $scope.currentCompanyId = id;
    $scope.name = $scope.companies[id].name;
    $scope.earnings = $scope.companies[id].earnings;
    $scope.owner = $scope.companies[id].owner;
  }
    $scope.editMainCompany = function ( id ) {
    $scope.currentMainCompanyId = id;
    $scope.company_name = $scope.main_companies[id].company_name;
    $scope.company_earnings = $scope.main_companies[id].company_earnings;
    $scope.combined_earnings = $scope.main_companies[id].company_earnings;
  }
  $scope.deleteCompany = function( id ) {
    $scope.companies.splice( id, 1 );
  }
    $scope.deleteMainCompany = function( id ) {
    $scope.main_companies.splice( id, 1 );
  }
})
</script>


</head>

<body>

  <div ng-app="app" ng-controller="companiesCtrl">

<h1 style="text-align:center"; >Main companies</h1>
<form>
	<div class="row">
		<div class="small-4 columns">
			<label class="right inline">Main company name</label>
		</div>
		<div class="small-8 columns">
			<input type="text" ng-model="company_name" />
		</div>	
	</div>
	<div class="row">
		<div class="small-4 columns">
			<label class="right inline">Main company earnings</label>
		</div>
		<div class="small-8 columns">
			<input type="text" ng-model="company_earnings" />
		</div>
	</div>
	
	<div class="row">
		<div class="small-3 columns"></div>
		<div class="small-9 columns">
			<button class="small radius" ng-click="addNewMainCompany()" "  ng-hide="currentMainCompanyId > -1">ADD</button>
			<button class="small radius" ng-click="saveMainCompany()" ng-show="currentMainCompanyId > -1">Save</button>
		</div>
	</div>
</form>

<table id="companies">
<thead>
	<tr>
		<th>#</th>
		<th>Name</th>
		<th>Earnings</th>
		<th>Combined earnings</th>
		<th></th>
	</tr>
</thead>
<tbody>
	<tr ng-repeat="Company in main_companies">	
<td>{{ $index + 1 }}</td>
		<td>{{ Company.company_name }}</td>
		<td>{{ Company.company_earnings }}</td>
		<td>{{ Company.all_earnings }}</td>
		<td>
			<ul class="button-group radius">
				<li><button class="tiny radius" ng-click="editMainCompany($index)">Edit</button></li>
				<li><button class="tiny radius alert" ng-click="deleteMainCompany($index)">Delete</button></li>
			</ul>
		</td>
	</tr>
</tbody>
</table>	



<br>
<br>



<h1 style="text-align:center"; >Child companies</h1>
<form>
	<div class="row">
		<div class="small-4 columns">
			<label class="right inline">Child company name</label>
		</div>
		<div class="small-8 columns">
			<input type="text" ng-model="name" />
		</div>	
	</div>
	<div class="row">
		<div class="small-4 columns">
			<label class="right inline">Child company earnings</label>
		</div>
		<div class="small-8 columns">
			<input type="text" ng-model="earnings" />
		</div>
	</div>
	<div class="row">
		<div class="small-4 columns">
			<label class="right inline">Owner company id</label>
		</div>
		<div class="small-8 columns">
			<input type="text" ng-model="owner" />
		</div>
	</div>
	<div class="row">
		<div class="small-3 columns"></div>
		<div class="small-9 columns">
			<button class="small radius" ng-click="addNewCompany()" ng-hide="currentCompanyId > -1">ADD</button>
			<button class="small radius" ng-click="saveCompany()" ng-show="currentCompanyId > -1">Save</button>
		</div>
	</div>
</form>

<table id="companies">
<thead>
	<tr>
		<th>#</th>
		<th>Name</th>
		<th>Earnings</th>
		<th>Owner</th>
		<th></th>
	</tr>
</thead>
<tbody>
	<tr ng-repeat="Company in companies">	
		<td>{{ $index + 1 }}</td>
		<td>{{ Company.company_name }}</td>
		<td>{{ Company.company_earnings }}</td>
		<td>{{ Company.owner }}</td>
		<td>
			<ul class="button-group radius">
				<li><button class="tiny radius" ng-click="editCompany($index)">Edit</button></li>
				<li><button class="tiny radius alert" ng-click="deleteCompany($index)">Delete</button></li>
			</ul>
		</td>
	</tr>
</tbody>
</table>



</div>
</body>
</html>
