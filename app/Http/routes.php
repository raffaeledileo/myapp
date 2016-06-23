<?php

use Illuminate\Http\Request;

//you must set "allow_url_fopen" as TRUE in "php.ini"

include_once("simple_html_dom.php");




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/findCompare', function (Request $request) {
	$url1 = $request->input('url1') ;
	$url2 = $request->input('url2');
	//inizializzo i vettori
	$dominio1 = [];
	$dominio2 = [];

//controllo inizializzazione
	$cond1=isset($dominio1);
	$cond2=isset($dominio2);
	//find
	if (!$cond1 || !$cond2 ) {
		return redirect('/');
	}
	// restiituisce un vettore di link
	 

	 $dominio1 = find($url1);
	 $dominio2 = find($url2);
	
	

   	// compare
	 $similarwords =[];
	 foreach ($dominio1 as $element1) {
		foreach ($dominio2 as $element2) {
				similar_text ($element1, $element2, $perc);
				if ($perc >= 90) {
					//devo fare un array push e non questa assegnazione
					//array_push($similarwords, //l'elemento di sotto qui in mezzo);
							$similarwords[] =
											  ['parola1' =>$element1,
											   'parola2' =>$element2,
											   'percentuale' => $perc 
											  ];
											
				}
			
		}
	}
	 	   	// create CSV

array_to_csv_download($similarwords);

});

Route::get('/phpinfo', function () {
    phpinfo();
});

    function find($url) {
    $dominio = [];
    $hmtldoc  = file_get_html($url);
		foreach($hmtldoc->find('a') as $element)  {
		   	 // Find all links 
		       // echo $element->href;
		   	   array_push($dominio, $element->href);
		   	}
	return $dominio;
}

function array_to_csv_download($similarwords) {
		// output headers so that the file is downloaded rather than displayed
		header('Content-type: text/csv');
		header('Content-Disposition: attachment; filename="demo.csv"');
		 
		// do not cache the file
		header('Pragma: no-cache');
		header('Expires: 0');
		 
		// create a file pointer connected to the output stream
		$file = fopen('php://output', 'w');

		// save the column headers
		fputcsv($file, array('parola1', 'parola2', 'percentuale'));

		foreach ($similarwords as $elemento) {

			fputcsv($file, $elemento);
			
		}
		
		fclose($file);

}