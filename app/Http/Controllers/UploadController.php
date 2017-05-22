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
use elearning1\Curso;

class UploadController extends Controller
{

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



    public function upload(Request $request)
    {

        ini_set('memory_limit', '-1');
        // obteniendo la informacion del archivo

      
        $file = Input::file('file');
        $mime = $file->getMimeType();


        list($tipo, $exten) = explode("/", $mime);

        $extension = Input::file('file')->getClientOriginalExtension();


        if ($extension != "exe") {
            if ($tipo != 'video') {
                //Ejecuta upload normal

                $this->validate($request, [
                    'nombreFile'=>'Required'
                  ]);
                
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


                if (!file_exists($destinationPath)) {
                     // Si el directorio no ha sido creado
                    if (!file_exists($destinationPath)) {
                        $iscreated = 0;
                        try {
                            //Intenta crearlo, con permisos de escritura
                            $iscreated = mkdir($destinationPath, 0700);
                        } catch (\Exception $e) {
                        }


                        //Error de creacion de carpeta
                        if ($iscreated == 0) {
                            Alert::error("Error de permisos", "No se pudo crear la carpeta")->persistent('Close');
                            return redirect()->back();
                        }
                    }
                }
                     //Necesito el curso al que pertenece.

                $pathRecurso = $destinationPath . "/". $curso ."/". $semana;
                     

                if (!file_exists($pathRecurso)) {
                    $iscreated = 0;
                    try {
                    //Intenta crearlo, con permisos de escritura
                        $iscreated = mkdir($pathRecurso, 0700, true);
                    } catch (\Exception $e) {
                    }

                    if ($iscreated == 0) {
                        Alert::error("Error >n<", "No se pudo crear la carpeta o ruta")->persistent('Close');
                            return redirect()->back();
                    }
                }

                 $fileName = rand(11111, 99999).'.'.$extension; // renameing image

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

                if ($result) {
                    Alert::success(":)", "Archivo Guardado");
                    return redirect()->back();
                } else {
                    unlink($rutaurl);
                    Alert::error("Disculpe!, intente de nuevo", "No se pudo guardar el archivo");
                    return redirect()->back();
                }
            } else {
                return $this->uploadVideos($request);
            }
        } else {
            Alert::error("NO puedes subir exe >:/", "Intente con otro tipo de archivo")->persistent('Close');
                    return redirect()->back();
        }
    }



    

    public function uploadVideos(Request $request)
    {
        ini_set('memory_limit', '-1');
         // obteniendo la informacion del archivo

          
        $file = Input::file('file');
        $mime = $file->getMimeType();

        if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/x-matroska" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv") {
            if (Input::file('file')->isValid()) {
                $extension = Input::file('file')->getClientOriginalExtension(); // obtiene la extension del archivo
                $originalName = Input::file('file')->getClientOriginalName(); //obtiene el nombre original del archivo
               
                //$fileName = rand(11111, 99999).'.'.$extension; // renameing image

            
                $contents = file_get_contents($file);

                $this->validate($request, [
                    'nombreFile'=>'Required'
                  ]);
        


                $nombre = $request->input('nombreFile');
                $notas = $request->input('notasFile');
                $vis = $request->input('visiblF');
                $estado = $request->input('estadoF');
                $recurso_padre = $request->input('recurso_padreF');
                $tipo_recurso = $request->input('tipoF');
                $semana = $request->input('semanaF');
                $rol =  $request->input('rolFile');
                $curso = $request->input('cursoF');
                $id =\Auth::user();
                $user = $id->id;

             

                //$rutaurl = $fileName;
                
                $contador = Recurso::where('Recurso.semana', '=', $semana)->max('secuencia');
                $contador= $contador+1;

              
                $this->soapWrapper->add('VideoWS', function ($service) {
                    $service->wsdl("http://localhost:8080/VideoWS/VideoWS?wsdl");
                    $service->trace(true);                                                   // Optional: (parameter: true/false)
                    $service->cache(WSDL_CACHE_NONE);                                        // Optional: Set the WSDL cache
                });

                $data = [
                   'fileName' => $originalName,
                   'video' => $contents,
                   'course' => $curso,
                   'user' => $user,
                ];

 

                $resultado = 0;
                try {
                    $respuesta =    $this->soapWrapper->call('VideoWS.upload', $data);
                    $resultado = json_decode(json_encode($respuesta->return), true);
                } catch (\Exception $e) {
                }

                if ($resultado == 0) {
                    Alert::error("Disculpe!, intente de nuevo", "Al parecer el WS dio problemas")->persistent('Close');
                    ;
                    return redirect()->back();
                }


               // var_dump($resultado->return);

            //   dd($array["id"]. "  Status " . $array["status"]);

            //     $fileName = rand(11111, 99999).'.'.$extension; // renameing image

                 $rutaurl = $resultado["id"] . '.' . $extension;


                if ($resultado["status"] == 1) {
                    $destinationPath=  'public/'.'videos/'.$curso.'/'.$semana.'/'.$rutaurl;
                    Storage::put($destinationPath, file_get_contents($file));



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

                    Alert::success(":)", "Archivo Guardado");
                    return redirect()->back();
                } else {
                    unlink($rutaurl);
                    Alert::error("Disculpe!, intente de nuevo", "No se pudo guardar el archivo");
                    return redirect()->back();
                }

                return redirect()->back();
            }
        } else {
            alert()->error("Este formato es invalido", "intente con otro video");
            return redirect()->back();
        }


          return redirect()->back();
    }



    function UpdateArchivo(Request $request)
    {
         ini_set('memory_limit', '-1');
        // obteniendo la informacion del archivo

      
        $file = Input::file('file');


        if ($file) {
            $mime = $file->getMimeType();

            list($tipo, $exten) = explode("/", $mime);

            $extension = Input::file('file')->getClientOriginalExtension();


            if ($extension != "exe") {
                if ($tipo != 'video') {
                    $nombre = $request->input('nombre');
                    $notas = $request->input('notas');
                    $vis = $request->input('visibl');
                    $estado = $request->input('estado');
                    $id = $request->input('id_recurso');
                    $rol =  $request->input('rol');


                    $destinationPath = $localRepo = realpath('../../../') . "/localRepository";


                    if (!file_exists($destinationPath)) {
                         // Si el directorio no ha sido creado
                        if (!file_exists($destinationPath)) {
                            $iscreated = 0;
                            try {
                                //Intenta crearlo, con permisos de escritura
                                $iscreated = mkdir($destinationPath, 0700);
                            } catch (\Exception $e) {
                            }


                            //Error de creacion de carpeta
                            if ($iscreated == 0) {
                                Alert::error("Error de permisos", "No se pudo crear la carpeta")->persistent('Close');
                                return redirect()->back();
                            }
                        }
                    }
                     //Necesito el curso al que pertenece.
                    $rec = Recurso::find($id);
                    $curs1 = $rec->Curso();

                    $sem = $rec->semana;

                    $pathRecurso = $destinationPath."/".$curs1."/".$sem;
                     

                    if (!file_exists($pathRecurso)) {
                        $iscreated = 0;
                        try {
                        //Intenta crearlo, con permisos de escritura
                            $iscreated = mkdir($pathRecurso, 0700, true);
                        } catch (\Exception $e) {
                        }

                        if ($iscreated == 0) {
                            Alert::error("Error >n<", "No se pudo crear la carpeta o ruta")->persistent('Close');
                            return redirect()->back();
                        }
                    }

                     $fileName = rand(11111, 99999).'.'.$extension; // renameing image

                     $result = Input::file('file')->move($pathRecurso, $fileName); // uploading file to given path
                     
                     $rutaurl = $pathRecurso . "/". $fileName;

                     $result = $rec->update([
                        'nombre' => $nombre,
                        'notas'=>$notas,
                        'url' => $rutaurl,
                        'visibl' => $vis,
                        'estado' => $estado,
                        'rol' => $rol
             
                     ]);

                    if ($result) {
                        Alert::success(":)", "Archivo Modificado");
                        return redirect()->back();
                    } else {
                         Alert::error("Error >n<", "No se pudo modificar el archivo")->persistent('Close');
                        return redirect()->back();
                    }
                } // Es video
                else {


                    return $this ->modificarVideo($request);
                }
            } else {
                alert()->error("Este formato es invalido", "intente con otro video");
                return redirect()->back();
            }
        } // No se modifica el archivo
        else {
            $nombre = $request->input('nombre');
            $notas = $request->input('notas');
            $vis = $request->input('visibl');
            $estado = $request->input('estado');
            $id = $request->input('id_recurso');
            $rol =  $request->input('rol');

            $rec = Recurso::find($id);

            $result = $rec->update([
                        'nombre' => $nombre,
                        'notas'=>$notas,
                        'visibl' => $vis,
                        'estado' => $estado,
                        'rol' => $rol
             
                     ]);

            if ($result) {
                Alert::success(":)", "Archivo Modificado");
                return redirect()->back();
            } else {
                Alert::error("Error >n<", "No se pudo modificar el archivo")->persistent('Close');
                        return redirect()->back();
            }
        }
    }


    public function modificarVideo(Request $request)
    {

        ini_set('memory_limit', '-1');
         // obteniendo la informacion del archivo

          
        $file = Input::file('file');
        $mime = $file->getMimeType();

        if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/x-matroska" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv") {
            if (Input::file('file')->isValid()) {
                $extension = Input::file('file')->getClientOriginalExtension(); // obtiene la extension del archivo
                $originalName = Input::file('file')->getClientOriginalName(); //obtiene el nombre original del archivo

                $contents = file_get_contents($file); // contenido

                $nombre = $request->input('nombre');
                $notas = $request->input('notas');
                $vis = $request->input('visibl');
                $estado = $request->input('estado');
                $id = $request->input('id_recurso');
                $rol =  $request->input('rol');

                $idc =\Auth::user();
                $user = $idc->id;

                 $rec = Recurso::find($id);
                 $curs1 = $rec->Curso();
                 $sem = $rec->semana;

                $this->soapWrapper->add('VideoWS', function ($service) {
                    $service->wsdl("http://localhost:8080/VideoWS/VideoWS?wsdl");
                    $service->trace(true);                                                   // Optional: (parameter: true/false)
                    $service->cache(WSDL_CACHE_NONE);                                        // Optional: Set the WSDL cache
                });

                $data = [
                   'fileName' => $originalName,
                   'video' => $contents,
                   'course' => $curs1,
                   'user' => $user,
                ];


                $resultado = 0;
                try {
                    $respuesta =    $this->soapWrapper->call('VideoWS.upload', $data);
                    $resultado = json_decode(json_encode($respuesta->return), true);
                } catch (\Exception $e) {
                }

                if ($resultado == 0) {
                    Alert::error("Disculpe!, intente de nuevo", "Al parecer el WS dio problemas")->persistent('Close');
                    ;
                    return redirect()->back();
                }

                $rutaurl = $resultado["id"] . '.' . $extension;


                if ($resultado["status"] == 1) {
                    $destinationPath=  'public/'.'videos/'.$curs1.'/'.$sem.'/'.$rutaurl;
                    Storage::put($destinationPath, file_get_contents($file));

                    $result = $rec->update([
                        'nombre' => $nombre,
                        'notas'=>$notas,
                        'url' => $rutaurl,
                        'visibl' => $vis,
                        'estado' => $estado,
                        'rol' => $rol
                     ]);

                    Alert::success(":)", "Archivo Modificado");
                    return redirect()->back();


                }
            }
        } else {
            alert()->error("Este formato es invalido", "intente con otro video");
            return redirect()->back();
        }
    }





    public function downloadImageIns($id_recurso)
    {

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







    public function getDownload(Request $request)
    {

        $nombre = $request->input('nameFile');

        $url = $request->input('urlFiles');

        $ext = $request->input('extRec');

        
        
        $mimetype = \GuzzleHttp\Psr7\mimetype_from_extension($ext);
        
               



          $headers = array(
              'Content-Type: '.$mimetype,
            );

        return response()->download($url, $nombre.".".$ext, $headers);
    }



    public function downloadVideo(Request $request)
    {

       //setea un tiempo limite para descargar 300 segundos = 5 minutos
        set_time_limit(300);
        ini_set('memory_limit', '-1');


        $url = $request->input('urlFiles');

        list($urlfile, $exten) = explode(".", $url);

        $fileName = $urlfile;

        //dd($fileName);

        $semana = $request->input('semanaFile');
        $sem = Semana::find($semana);
        $curso = Curso::find($sem->curso);
        $cursoid= $curso->id_curso;

        
        $this->soapWrapper->add('VideoWS', function ($service) {
                    $service->wsdl("http://localhost:8080/VideoWS/VideoWS?wsdl");
                    $service->trace(true);                                                   // Optional: (parameter: true/false)
                    $service->cache(WSDL_CACHE_NONE);                                        // Optional: Set the WSDL cache
        });

        $data = [
        'fileName' => $fileName
        ];

        $resultado = $this->soapWrapper->call('VideoWS.download', $data);
        
        $destinationPath=  'public/'.'videos/'.$cursoid.'/'.$semana.'/'.$fileName . "." . $exten;

        Storage::put($destinationPath, $resultado->return);

        return redirect()->back();
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

    protected function get_file_size($file_path, $clear_stat_cache = false)
    {
        if ($clear_stat_cache) {
            if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
                clearstatcache(true, $file_path);
            } else {
                clearstatcache();
            }
        }
        return $this->fix_integer_overflow(filesize($file_path));
    }

    protected function fix_integer_overflow($size)
    {
        if ($size < 0) {
            $size += 2.0 * (PHP_INT_MAX + 1);
        }
        return $size;
    }
}
