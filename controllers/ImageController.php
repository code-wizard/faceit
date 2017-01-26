<?php

namespace app\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\web\Response;
use app\models\Image;
use app\models\Face;
use yii\helpers\Url;
/**
* 
*/
class ImageController extends Controller
{
	public function behaviors()
    {

        return [
             'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                   [
                        'actions' => ['detect-face','list-image'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    // [
                    //     'actions' => [''],
                    //     'allow' => true,
                    //     'roles' => ['@'],
                    // ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'detect-face' => ['post',"get"],
                ],
            ],
        ];
    }
    public function actionDetectFace(){
    	Yii::$app->response->format=Response::FORMAT_JSON;
    	if(Yii::$app->request->isPost){
    		$request = Yii::$app->request;
    		$imageUrls = $request->post("url");
    		$r = $this->face($imageUrls);
    		if($r["status"]==1){
    			return array("message"=>"Download completed","image_urls"=>$r["image_urls"],"status"=>$r,"no_of_faces"=>$r["no_of_faces"],"no_of_saved_images"=>$r["no_of_saved_images"]);
    		}
    		else{
    			return array("message"=>"An error occurred. Please ensure all the links are valid image links","status"=>$r);
    		}
    		// else{
    		// 	return array("message"=>"No face detected","status"=>$r);
    		// }
    		

    	}
    }

    public function actionListImage(){

        return $this->render("list");
    }
	private function face($imageUrls){
       	
       	$noOfImagesSaved=0;
       	$faceCount=0;
        $imageArray=array();
        foreach ($imageUrls as $u) {
        	$headers = array('Accept' => 'application/json',"X-Mashape-Key"=>"DRrnFDL9C1mshset121xFvJxr8v8p1NyWlRjsn9nIzWDxSQK8K");
	        $data = array("minHeadScale" => "0.125", "selector" => "FULL",
	            "url" => $u,
	            "api_key"=>"715fddea07599850b279c83ce1d234eb"
	        );
	        $body = \Unirest\Request\Body::form($data);

	        //make a post call the face detection api
	        $response = \Unirest\Request::post("https://animetrics.p.mashape.com/v2/detect", $headers, $body);
	        
	        $image = json_decode($response->raw_body,true)["images"];
	        //retrive list of faces in the image
	        $faces =$image[0]["faces"];

	        //check if there is a face in the picture
	        if($faces){

	            $transaction = Yii::$app->db->beginTransaction();

	            try{
	                $image=$image[0];
	                $path=pathinfo($u);
	                $im = new Image();
	                $im->name=time().".".$path["extension"];
	                $im->width=$image["width"];
	                $im->height=$image["height"];
	                $im->link="/downloaded_images/".$im->name;
	                $im->save();

	                foreach ($faces as $face) {
	                	
	                    $f= new Face();
	                    $f->width=$face["width"];
	                    $f->height=$face["height"];
                        $f->top_left_x =$face["topLeftX"];
                        $f->top_left_y =$face["topLeftY"];
	                    $f->gender=$face["attributes"]["gender"]["type"];
	                    $f->confident_level=$face["attributes"]["gender"]["confidence"];
	                    $f->image_id=$im->getPrimaryKey();
	                    $f->save();
	                    $faceCount++;
	                }
	                //Save the image
	                $this->downloadFile($u,$im->name);
	                //keep count of the number of images that were saved
	                $noOfImagesSaved++;
	                $transaction->commit();
                     array_push($imageArray,["id"=>$im->getPrimaryKey(),"link"=>Url::base(true).$im->link]);
	                // $r = array("status"=>1,"no_of_faces"=>sizeof($faces),"no_of_saved_images"=>$noOfImagesSaved);
	            }catch(Exception $ae){
	                $transaction->rollback();
	                return array("status"=>2);
	            }

	            // array("status"=>3);
	        }
        }
        return  array("status"=>1,"no_of_faces"=>$faceCount,"no_of_saved_images"=>$noOfImagesSaved,"image_urls"=>$imageArray);
        
           
    }

    private function downloadFile($url,$name)
    {
    	$ch = curl_init($url);
                $fp = fopen(Yii::getAlias("@webroot").'/downloaded_images/'.$name, 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_exec($ch);
                curl_close($ch);
                fclose($fp); 
    }
}
