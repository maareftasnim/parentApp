<?php

use App\Http\Controllers\Dashboard\admin\AdminHomeController;
use App\Http\Controllers\Dashboard\BulletinController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\CustomLoginController;
use App\Http\Controllers\Dashboard\EmploiController;
use App\Http\Controllers\Dashboard\etudiant\EtudiantController;
use App\Http\Controllers\Dashboard\OptionsController;
use App\Http\Controllers\Dashboard\Parent\ParentController;
use App\Http\Controllers\Dashboard\QuestionController;
use App\Http\Controllers\Dashboard\QuizNameController;
use App\Http\Controllers\Dashboard\SeancesController;
use App\Http\Controllers\Dashboard\Teachers\TeacherHomeController;
use App\Http\Controllers\Dashboard\TestsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix'=>'teacher','namespace'=>'Dashboard\Teachers','middleware'=>['auth:teachers']],function(){
    Route::get('dashboard',[TeacherHomeController::class ,'index'])->name('teacher.dashboard');
});
Route::group(['prefix'=>'admin','namespace'=>'Dashboard\admin','middleware'=>['auth:admin']],function(){
    Route::get('dashboard',[AdminHomeController::class ,'index'])->name('teacher.dashboard');
});
Route::get('/login', [CustomLoginController::class, 'index'])->name('login.index')->middleware(['guest:admin', 'guest:teachers']);
//Route::post('teacher-login',CustomLoginController::class .'@LoginTeacher')->name('teacher.loginteacher');
Route::group(['prefix' => 'admin', 'namespace' => 'Dashboard'], function () {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('logout', [CustomLoginController::class ,'logoutAdmin'])->name('admin.logout');
        Route::post('logouts', [CustomLoginController::class, 'logoutAdmin'])->name('logoutadmin');
    });

    Route::group(['middleware' => 'guest:admin'], function () {
       // Route::get('login-index', [CustomLoginController::class, 'index'])->name('login.index');
        Route::post('login', [CustomLoginController::class, 'LoginAdmin'])->name('admin.login');
    });
});
Route::group(['prefix'=>'teacher','namespace'=>'Dashboard','middleware'=>['guest:teachers']],function (){
    //Route::get('login-index',[CustomLoginController::class ,'index'])->name('login.index');
    Route::post('login',[CustomLoginController::class ,'LoginTeacher'])->name('teacher.login');

});
Route::group(['prefix'=>'teacher','namespace'=>'Dashboard','middleware'=>['auth:teachers']],function (){
    Route::post('logouts', [CustomLoginController::class ,'logoutTeacher'])->name('logoutteacher');
    Route::get('logout', [CustomLoginController::class ,'logoutTeacher'])->name('teacher.logout');

});



//route des parents
Route::group(['prefix'=>'parents','namespace'=>'Dashboard/Parent','middleware'=>'auth:parents'],function(){
    Route::post('logout', [ParentController::class,'logout'])->name('parents.logout');
    Route::get('logout', [ParentController::class,'logout'])->name('parents.parents.logout');
    //Route::get('/{id}', [ParentController::class ,'show'])->name('parents.show');
    Route::get('/{id}/edit',[ParentController::class ,'edit'])->name('parents.edit');
    Route::put('/{id}/update', [ParentController::class ,'update'])->name('parents.update');
    Route::get('show/{id}', [ParentController::class ,'show'])->name('parents.show');

});
Route::group(['prefix'=>'parents','namespace'=>'Dashboard/Parent','middleware'=>'guest:parents'],function(){
    Route::get('login',[ParentController::class,'loginView'])->name('login');
    Route::post('checklogin', [ParentController::class, 'login'])->name('parents.login');
    Route::get('/registre',[ParentController::class ,'wizard'])->name('parents.wizard');

});
//route des etudiants

Route::group(['prefix'=>'etudiants','namespace'=>'Dashboard/etudiant','middleware'=>'auth:parents'],function (){
    Route::get('{id}/editparents',[EtudiantController::class ,'editparents'])->name('etudiant.editparent');
    Route::put('{id}/updateparents',[EtudiantController::class ,'updateparents'])->name('etudiant.updateparent');
    Route::get('{id}/show',[EtudiantController::class ,'show'])->name('etudiant.show');
    //Route::get('emploi/{id}/show',[EmploiController::class,'show'])->name('emploi.show');
    Route::get('/create', [EtudiantController::class ,'create'])->name('etudiant.create');
    Route::post('/store',[EtudiantController::class ,'store'])->name('etudiant.store');
    Route::get('shownote/{id}/{semestre_id}',[BulletinController::class ,'index'])->name('etudiant.shownote');
    Route::get('showConvocation/{id}',[EtudiantController::class ,'showConvocation'])->name('etudiant.showConvocation');
    Route::get('showCours/{id}',[EtudiantController::class ,'showCours'])->name('etudiant.showCours');
    Route::get('showTravail/{id}',[EtudiantController::class ,'showTravail'])->name('etudiant.showTravail');


});
Route::group(['prefix'=>'seance','namespace'=>'Dashboard','middleware'=>'auth:parents'],function (){
    Route::get('seance/edite/{id}',[SeancesController::class,'edit'])->name('edite.seance');
    Route::put('seance/{id}',[SeancesController::class,'update'])->name('update.seance');
    Route::delete('/delete-seance/{id}', [SeancesController::class,'delete'])->name('seance.delete');
    Route::get('fetch_teacher_matier',[SeancesController::class,'fetch_teacher_matier'])->name('teachermatier');
    Route::post('/create',[SeancesController::class,'store'])->name('seance.store');
    Route::get('/class_teacher',[SeancesController::class,'class_teacher'])->name('class_teacher');
    Route::get('/matier_teacher',[SeancesController::class,'matier_teacher'])->name('matier_teacher');

});
Route::group(['prefix'=>'emploi','namespace'=>'Dashboard','middleware'=>'auth:parents'],function (){
    Route::get('create',[EmploiController::class,'create'])->name('emploi.create');
    Route::post('store',[EmploiController::class,'store'])->name('emploi.store');
    Route::get('{id}/edite',[EmploiController::class,'edite'])->name('seance.edite');
    Route::put('{id}',[EmploiController::class,'update'])->name('seance.update');
    Route::get('/emploiliste',[EmploiController::class,'create'])->name('seance.create');
    Route::delete('delete/{id}',[EmploiController::class,'delete'])->name('delete.emploi.delete');
    Route::get('emploi/{id}/show',[EmploiController::class,'showEmploi'])->name('emploi.show');

});
// route bulletin

Route::group(['prefix'=>'bulletin','namespase'=>'Dashboard','middleware'=>'auth:parents'],function (){
    Route::get('/{id}',[BulletinController::class ,'index'])->name('bulletin.index');
});

//route de quiz
Route::group(['prefix'=>'quiz','namespace'=>'Dashboard'],function (){
    Route::get('categories',[CategoriesController::class,'index'])->name('categories.index');
    Route::get('categories/create',[CategoriesController::class,'create'])->name('categories.create');
    Route::post('categories/store',[CategoriesController::class,'store'])->name('categories.store');
    Route::get('categories/edit/{id}',[CategoriesController::class,'edit'])->name('categories.edit');
    Route::put('categories/{id}/update',[CategoriesController::class,'update'])->name('categories.update');

    Route::get('questions',[QuestionController::class,'index'])->name('questions.index');
    Route::get('questions/create',[QuestionController::class,'create'])->name('questions.create');
    Route::post('questions/store',[QuestionController::class,'store'])->name('questions.store');
    Route::get('questions/edit/{id}',[QuestionController::class,'edit'])->name('questions.edit');
    Route::put('questions/{id}/update',[QuestionController::class,'update'])->name('questions.update');

    Route::get('options',[OptionsController::class,'index'])->name('options.index');
    Route::get('options/create',[OptionsController::class,'create'])->name('options.create');
    Route::post('options/store',[OptionsController::class,'store'])->name('options.store');
    Route::get('options/edit/{id}',[OptionsController::class,'edit'])->name('options.edit');
    Route::put('options/{id}/update',[OptionsController::class,'update'])->name('options.update');

    Route::get('test/{id?}',[TestsController::class,'index'])->name('test.index');
    Route::post('test/create/',[TestsController::class,'store'])->name('test.store');

    Route::get('resultat',[TestsController::class,'index']);
    Route::post('check-first', [TestsController::class, 'index']);
    Route::get('finish', [TestsController::class, 'indextest'])->name('finish');

    Route::get('name',[QuizNameController::class,'index'])->name('quiz.index');
    Route::get('name/create',[QuizNameController::class,'create'])->name('quiz.create');
    Route::post('name/store',[QuizNameController::class,'store'])->name('quiz.store');
    Route::get('name/edit/{id}',[QuizNameController::class,'edit'])->name('quiz.edit');
    Route::put('name/{id}/update',[QuizNameController::class,'update'])->name('quiz.update');




});
