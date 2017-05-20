<?php

namespace elearning1\Http\Controllers;


use DB;
use Input;
use Validator;
use Redirect;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
// add request here like use Request or whatever you created

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Soap\Request\GetConversionAmount;
use App\Soap\Response\GetConversionAmountResponse;
use Illuminate\Support\Facades\Storage;


use App\Http\Controllers\VideoStream;
use elearning1\Semana;
use elearning1\Recurso;




class UploadController extends Controller {

	/**
   * @var SoapWrapper: objeto de conexion al servicio web 
   */
  protected $soapWrapper;

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function __construct(SoapWrapper $soapWrapper)
	{
		$this->middleware('auth');
		$this->soapWrapper = $soapWrapper;
	}

	public function index()
	{

	}



	public function upload(Request $request) {

		ini_set('memory_limit', '-1');
	 	// obteniendo la informacion del archivo

	  
		$file = Input::file('file');
		$mime = $file->getMimeType();


		list($tipo, $exten) = explode("/", $mime); 

		$extension = Input::file('file')->getClientOriginalExtension();


		if($extension != "exe"){

			if($tipo != 'video'){
				//Ejecuta upload normal
				$nombre = $request->input('nombreFile');
		        $notas = $request->input('notasFile');
		       // $url = $request->input('url');
		        $vis = $request->input('visiblF');
		        $estado = $request->input('estadoF');
		        $recurso_padre = $request->input('recurso_padreF');
		        $tipo_recurso = $request->input('tipoF');
		        $semana = $request->input('semanaF');
		        $rol =  $request->input('rolFile');
		        $curso = $request->input('cursoF');


		        
		        $destinationPath = $localRepo = realpath('../../../') . "/localRepository"; 


		        if(!file_exists($destinationPath)){
		        	
		        	 // Si el directorio no ha sido creado
		        	 if(!file_exists($destinationPath)){
						$iscreated = 0;
				     	try{
				     		//Intenta crearlo, con permisos de escritura
				     		$iscreated = mkdir($destinationPath, 0700);
				     	}catch(\Exception $e){}


				     	//Error de creacion de carpeta
				     	if($iscreated == 0){
							Alert::error("Error de permisos", "No se pudo crear la carpeta")->persistent('Close');
							return redirect()->back();     		
				     	}
				     	
				     }
				}
				     //Necesito el curso al que pertenece.

				$pathRecurso = $destinationPath . "/". $curso ."/". $semana;
				     

				if(!file_exists($pathRecurso)){
				    $iscreated = 0;
				    try{
				    //Intenta crearlo, con permisos de escritura
				    	$iscreated = mkdir($pathRecurso, 0700, true);
				     	}catch(\Exception $e){}

				    if($iscreated == 0){
						Alert::error("Error >n<", "No se pudo crear la carpeta o ruta")->persistent('Close');
							return redirect()->back();     		
				     }

				}

		     	 $fileName = rand(11111,99999).'.'.$extension; // renameing image

		     	 Input::file('file')->move($pathRecurso, $fileName); // uploading file to given path
					  
				 //Storage::disk('local')->put($fileName, $file);

					  
				 //que hara esto? 
				//echo asset("storage/" . $nombre);
					  
				/*** GUARDANDO LOS DATOS EN LA BASE DE DATOS RELACIONAL*/	  
				$sem = Semana::find($semana);
        
         		$contador = Recurso::where('Recurso.semana', '=', $semana)->max('secuencia');
         		$contador= $contador+1;

         		$rutaurl = $pathRecurso . "/". $fileName;

         		//dd("Recurso Padre: ". $recurso_padre);

         		 $result = Recurso::create([
		          'nombre'=> $nombre,
		          'notas'=> $notas,
		          'url' => $rutaurl,
		          'estado' => $estado,
		          'visibl' => $vis,
		          'recurso_padre' => $recurso_padre,
		          'tipo_recurso' => 6,
		          'secuencia' => $contador,
		          'semana' => $semana,
		          'rol' => $rol
		        ]);

         		 if($result){
         		 	Alert::success(":)", "Archivo Guardado");
					return redirect()->back();  

         		 }else{
         		 	unlink($rutaurl);
         		 	Alert::error("Disculpe!, intente de nuevo", "No se pudo guardar el archivo");
         		 	return redirect()->back();  

         		 }


				
						    		 		

			}else{

				dd("Es un video");

				//llama a metodo por WS
			}
		}else{

			Alert::error("NO puedes subir exe >:/", "Intente con otro tipo de archivo")->persistent('Close');
					return redirect()->back();   


		}

	}



	public function uploadVideos(Request $request){


	}







	public function downloadImageIns($id_recurso){

		$recurso = Recurso::find($id_recurso);

		$dir = $recurso->url;

		$ext = $recurso->extencion();

		$file = fopen($dir, "r");

		$newPath =  'public/'.$id_recurso . '/tmp'. $id_recurso . '.'. $ext;

			Storage::put($newPath, $file);
			echo asset('storage/' . $file. '.' . $ext);

		

		$p = 'storage/'. $newPath;

		//return $p;


		

		return redirect()->home();
	}







	public function getDownload(Request $request){

		$nombre = $request->input('nameFile');

		$url = $request->input('urlFiles');

		$ext = $request->input('extRec');

		
		
		$mimetype = \GuzzleHttp\Psr7\mimetype_from_extension($ext);
		
		       



  		  $headers = array(
              'Content-Type: '.$mimetype,
            );

		return response()->download($url, $nombre.".".$ext, $headers);

	}












	public function store(Request $request)
	{
		/*if ($request->hasFile('files')) {
			$file = $request->file('files');
		foreach($file as $files){
			$filename = $files->getClientOriginalName();
			$extension = $files->getClientOriginalExtension();
			$picture = sha1($filename . time()) . '.' . $extension;
			$folder = project::select('folder')->where('id', session('progetto'))->get();*/
			
			//specify your folder
			
			/*$destinationPath = public_path() . '/files_clients/' .$folder[0]->folder. '/';
			$files->move($destinationPath, $picture);
			$destinationPath1='http://'.$_SERVER['HTTP_HOST'].'/files_clients/' .$folder[0]->folder. '/';
					$filest = array();
					$filest['name'] = $picture;
					$filest['size'] = $this->get_file_size($destinationPath.$picture);
					$filest['url'] = $destinationPath1.$picture;
			$filest['thumbnailUrl'] = $destinationPath1.$picture;
			$filesa['files'][]=$filest;}
		return  $filesa;
		}*/
	}

// add more customized code available at https://github.com/blueimp/jQuery-File-Upload in https://github.com/blueimp/jQuery-File-Upload/blob/master/server/php/UploadHandler.php

	/*
     * jQuery File Upload Plugin PHP Class
     * https://github.com/blueimp/jQuery-File-Upload
     *
     * Copyright 2010, Sebastian Tschan
     * https://blueimp.net
     *
     * Licensed under the MIT license:
     * http://www.opensource.org/licenses/MIT
     */

	protected function get_file_size($file_path, $clear_stat_cache = false) {
		if ($clear_stat_cache) {
			if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
				clearstatcache(true, $file_path);
			} else {
				clearstatcache();
			}
		}
		return $this->fix_integer_overflow(filesize($file_path));
	}

	protected function fix_integer_overflow($size) {
		if ($size < 0) {
			$size += 2.0 * (PHP_INT_MAX + 1);
		}
		return $size;
	}

}
