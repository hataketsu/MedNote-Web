<?php

use App\Note;
use Illuminate\Http\Request;

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

Route::middleware( 'auth:api' )->get( '/user', function ( Request $request ) {
	return $request->user();
} );

Route::get( 'notes', function () {
	return Note::all();
} );

Route::get( 'notes/{id}', function ( $id ) {
	return Note::query()->findOrFail( $id );
} );


Route::post( 'notes', function ( Request $request ) {
	$notes = json_decode( $request->get( "notes" ), true );
	$new   = 0;
	$up    = 0;
	foreach ( $notes as $note ) {
		if ( $note['id'] >= 1000000 ) {
			$noteModel = new Note();
			$noteModel->fill( $note );
			$noteModel->save();
			$new ++;
		} else if ( ( $sNote = Note::find( $note['id'] ) ) != null ) {
			if ( $sNote->updated_at < $note['deleted_at'] ) {
				$sNote->delete();
			} else if ( $sNote->updated_at < $note['updated_at'] ) {
				$sNote->delete();
				$noteModel = new Note();
				$noteModel->fill( $note );
				$noteModel->save();
				$up ++;
			}
		}
	}

	return "Uploaded " . sizeof( $notes ) . " notes, $new new, $up up";
} );


Route::get( "ping", function () {
	return "connected";
} );
