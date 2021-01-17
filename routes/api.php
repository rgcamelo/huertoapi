<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::resource('gardens', 'Garden\GardenController', ['except' => ['create','edit']]);
Route::resource('gardens.beds', 'Garden\GardenBedController', ['only' => ['index'] ]);
Route::resource('gardens.cares', 'Garden\GardenCareController', ['only' => ['index'] ]);
Route::resource('gardens.crops', 'Garden\GardenCropController', ['only' => ['index'] ]);
Route::resource('gardens.grounds', 'Garden\GardenGroundController', ['except' => ['create', 'show', 'edit']]);
Route::resource('gardens.plants', 'Garden\GardenPlantController', ['only' => ['index'] ]);
Route::resource('gardens.seeds', 'Garden\GardenSeedController', ['only' => ['index'] ]);

Route::resource('grounds', 'Ground\GroundController', ['only' => ['index','show']]);
Route::resource('grounds.beds', 'Ground\GroundBedController', ['except' => ['create', 'show', 'edit']]);
Route::resource('grounds.cares', 'Ground\GroundCareController', ['only' => ['index'] ]);
Route::resource('grounds.crops', 'Ground\GroundCropController', ['only' => ['index'] ]);
Route::resource('grounds.garden', 'Ground\GroundGardenController', ['only' => ['index'] ]);
Route::resource('grounds.plants', 'Ground\GroundPlantController', ['only' => ['index'] ]);
Route::resource('grounds.seeds', 'Ground\GroundSeedController', ['only' => ['index'] ]);


//Route::resource('seedbeds', 'Seedbed\SeedbedController', ['only' => ['index','show']]);

//Route::resource('terraces', 'Terrace\TerraceController', ['only' => ['index','show']]);

//Route::resource('furrows', 'Furrow\FurrowController', ['only' => ['index','show']]);

Route::resource('beds', 'Bed\BedController', ['only' => ['index','show']]);
Route::resource('beds.garden', 'Bed\BedGardenController', ['only' => ['index'] ]);
Route::resource('beds.ground', 'Bed\BedGroundController', ['only' => ['index'] ]);
Route::resource('beds.plants', 'Bed\BedPlantController', ['only' => ['index'] ]);
Route::resource('beds.seed', 'Bed\BedSeedController', ['only' => ['index'] ]);
Route::resource('beds.seed.plants', 'Bed\BedSeedPlantController', ['except' => ['create', 'show', 'edit']]);
Route::resource('beds.cares', 'Bed\BedCareController', ['only' => ['index'] ]);
Route::resource('beds.crop', 'Bed\BedCropController', ['only' => ['index'] ]);

//Route::resource('zones', 'Zone\ZoneController', ['except' => ['create','edit']]);

Route::resource('seeds', 'Seed\SeedController', ['except' => ['create','edit']]);
Route::resource('seeds.beds', 'Seed\SeedBedController', ['only' => ['index'] ]);
Route::resource('seeds.cares', 'Seed\SeedCareController', ['only' => ['index'] ]);
Route::resource('seeds.crops', 'Seed\SeedCropController', ['only' => ['index'] ]);
Route::resource('seeds.gardens', 'Seed\SeedGardenController', ['only' => ['index'] ]);
Route::resource('seeds.grounds', 'Seed\SeedGroundController', ['only' => ['index'] ]);
Route::resource('seeds.plants', 'Seed\SeedPlantController', ['only' => ['index'] ]);

Route::resource('plants', 'Plant\PLantController', ['only' => ['index','show']]);
Route::resource('plants.bed', 'Plant\PlantBedController', ['only' => ['index'] ]);
Route::resource('plants.cares', 'Plant\PlantCareController', ['only' => ['index'] ]);
Route::resource('plants.crop', 'Plant\PlantCropController', ['only' => ['index'] ]);
Route::resource('plants.garden', 'Plant\PlantGardenController', ['only' => ['index'] ]);
Route::resource('plants.ground', 'Plant\PlantGroundController', ['only' => ['index'] ]);
Route::resource('plants.seed', 'Plant\PlantSeedController', ['only' => ['index'] ]);

Route::resource('crops', 'Crop\CropController', ['only' => ['index','show']]);
Route::resource('crops.plant', 'Crop\CropPlantController', ['only' => ['index']]);
Route::resource('crops.seed', 'Crop\CropSeedController', ['only' => ['index']]);
Route::resource('crops.cares', 'Crop\CropCareController', ['only' => ['index']]);
Route::resource('crops.bed', 'Crop\CropBedController', ['only' => ['index']]);
Route::resource('crops.ground', 'Crop\CropGroundController', ['only' => ['index']]);
Route::resource('crops.garden', 'Crop\CropGardenController', ['only' => ['index']]);

Route::resource('cares', 'Care\CareController', ['only' => ['index','show']]);
Route::resource('cares.plant', 'Care\CarePlantController', ['only' => ['index']]);
Route::resource('cares.seed', 'Care\CareSeedController', ['only' => ['index']]);
Route::resource('cares.crop', 'Care\CareCropController', ['only' => ['index']]);
Route::resource('cares.bed', 'Care\CareBedController', ['only' => ['index']]);
Route::resource('cares.ground', 'Care\CareGroundController', ['only' => ['index']]);
Route::resource('cares.garden', 'Care\CareGardenController', ['only' => ['index']]);

Route::resource('users', 'User\UserController', ['except' => ['create','edit']]);
