<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view( 'note.index' )->with_notes( Note::query()->paginate( 10 ) );
	}

	public function trash() {
		return view( 'note.trash' )->with_notes( Note::onlyTrashed()->paginate( 10 ) );
	}

	public function search( Request $request ) {
		$start = microtime( true );
		$notes = Note::query()->where( 'content', 'like', '%' . $request->post( 'query' ) . '%' )
		             ->orWhere( 'title', 'like', '%' . $request->post( 'query' ) . '%' )
		             ->paginate( 10 );
		$delta = microtime( true ) - $start;

		return view( 'note.index' )->with_notes( $notes )->with_delta( $delta );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view( 'note.create' )->with_note( new Note() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$this->custom_validate( $request );
		( new Note( $request->all() ) )->save();
		$request->session()->flash( 'message', 'Saved!' );

		return redirect( '/' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		return view( 'note.show' )->with_note( Note::query()->find( $id ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		return view( 'note.edit' )->with_note( Note::query()->find( $id ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		$this->custom_validate( $request );
		( Note::query()->find( $id ) )->fill( $request->all() )->save();
		$request->session()->flash( 'message', 'Updated!' );

		return redirect( '/' );

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Request $request, $id ) {
		Note::destroy( $id );
		$request->session()->flash( 'message', 'Deleted' );

		return redirect( '/' );
	}

	public function trash_delete( Request $request, $id ) {
		Note::onlyTrashed()->find( $id )->forceDelete();
		return redirect( '/trash' );
	}

	public function trash_restore( Request $request, $id ) {
		Note::onlyTrashed()->find( $id )->restore();

		return redirect( '/trash' );
	}

	/**
	 * @param Request $request
	 *
	 * @return array
	 */
	protected function custom_validate( Request $request ): array {
		return $this->validate( $request, [
			'title' => 'required'
		] );
	}
}
