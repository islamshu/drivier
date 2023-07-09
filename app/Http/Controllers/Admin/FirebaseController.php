<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Kreait\Firebase;
use Kreait\Firebase\Factory;
// use Kreait\Firebase\ServiceAccount;
// use Kreait\Firebase\Database;
use App\Driver;
use DB;
class FirebaseController extends Controller
{
    public function index(){
        // $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/public/wtcdelivery-a6795.json');
        // $firebase = (new Factory);
        // dd(__DIR__ . '/public/wtcdelivery-a6795.json');
        $factory = (new Factory)->withServiceAccount('E:\xampp\htdocs\logic\public\wtcdelivery-a6795.json');

        $database = app('firebase.database');


        $drivers = Driver::where('active' , 1)->get();

        $locations = [];

        // dd($drivers);
        foreach ($drivers as $d) {

            $latitude = $database->getReference('LocationUser/'. $d->id .'/latitude');
            $longitude = $database->getReference('LocationUser/'. $d->id .'/longitude');

            if ($latitude->getValue() != null && $longitude->getValue() != null) {
                $latLng = array(
                    'id' => $d->id,
                    'lat' => $latitude->getValue(),
                    'lng' => $longitude->getValue(),
                );
               
                
                array_push($locations , $latLng);
            }
        }


        $onlineDrivers = [];
        // dd($locations);

        foreach ($locations as $value) {
            $driver = Driver::find($value['id']);

            $driver->driver_lat = $value['lat'];
            $driver->driver_lon = $value['lng'];

            array_push($onlineDrivers , $driver);
            // dd($value->id);
        }
       


        return view('track' , compact('onlineDrivers'));


        // $latitude = $database->getReference('LocationUser/1/latitude');
        // $longitude = $database->getReference('LocationUser/1/longitude');

        // // $snapshot = $reference->getSnapshot();
        // $lat = $latitude->getValue();
        // $lng = $longitude->getValue();
        // return  'Latitude : ' . $lat. '<br> Longitude : ' . $lng;
        // $firebase = (new Factory)->withServiceAccount(__DIR__ . '/public/wtcdelivery-a6795.json');
        // https://wtcdelivery-a6795.firebaseio.com/

        // firebase-adminsdk-z8084@wtcdelivery-a6795.iam.gserviceaccount.com

        // dd($firebase);
        // ->withServiceAccount($serviceAccount)
        // ->withDatabaseUri('https://wtcdelivery-a6795.firebaseio.com/')
        // ->create();
        // $database = $firebase->getDatabase();
        // $newPost = $database
        // ->getReference('blog/posts')
        // ->push([
        // 'title' => 'Post title',
        // 'body' => 'This should probably be longer.'
        // ]);
        //$newPost->getKey(); // => -KVr5eu8gcTv7_AHb-3-
        //$newPost->getUri(); // => https://my-project.firebaseio.com/blog/posts/-KVr5eu8gcTv7_AHb-3-
        //$newPost->getChild('title')->set('Changed post title');
        //$newPost->getValue(); // Fetches the data from the realtime database
        //$newPost->remove();
        // echo"<pre>";
        // print_r($newPost->getvalue());

        // return view('test');
    }
    
    
    protected function getNearsDriverLocation($lat , $lng) {
        $drivers = DB::table('drivers')
            ->select('name', 'latitude', 'longitude', 'region', DB::raw(sprintf(
                '(6371 * acos(cos(radians(%1$.7f)) * cos(radians(latitude)) * cos(radians(longitude) - radians(%2$.7f)) + sin(radians(%1$.7f)) * sin(radians(latitude)))) AS distance',
                // $request->input('latitude'),
                // $request->input('longitude')
                $lat,
                $lng
            )))
            ->having('distance', '<', 50)
            ->orderBy('distance', 'asc')
            ->get();


        // Solution 2 

        $cities = City::select(DB::raw('*, ( 6367 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
        ->having('distance', '<', 25)
        ->orderBy('distance')
        ->get();

        return $drivers;
    }
}
