<?php

require_once "../autoloader.php";

useApiVersion1();

//"http://drnkmobile.com/api/v1/businesses/" + typeOfBusiness+"/?zipcode="+currentUserZip + "&radius=10"
//([vV]\d+)

function useApiVersion1() {
	if (!empty($_GET['company_city'])) {

		$companyCity = $_GET['company_city'];
		$jsonBuilder = new JSONBuilder();
//        if(cityRequested()){
//            $jsonBuilder->companyCity();
//        }
		if (liquorStoresRequested()) {
            $jsonBuilder->includeLiquorStores();
		}
		if (barsRequested()) {
            $jsonBuilder->includeBars();
		}

		$json = $jsonBuilder->buildJSON($companyCity);
		echo $json;
	}
}


function liquorStoresRequested() {
	return isset($_GET['liquorstore']) && strtolower($_GET['liquorstore']) == "true";
}

function barsRequested() {
	return isset($_GET['bar']) && strtolower($_GET['bar']) == "true";
}

//function cityRequested(){
//    if(isset($_GET['company_city'])){
//        if($_GET['company_city']=="muncie"){
//            return $_GET['company_city']=="muncie";
//        }else{
//            return $_GET['company_city']=="bloomington";
//        }
//    }
////    return isset($_GET['city']) && strtolower($_GET['city']) == "muncie";
//}

?>