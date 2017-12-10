<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function index(){
      return view('welcome');
    }

    public function getContacts(Request $request){
      $req = $request->all();
      $contacts = Contact::paginate(10);
      if($req['sort']){
        $sort = explode('|', $req['sort']);
        $contacts = Contact::orderBy($sort[0], $sort[1])->paginate(10);
      }
      return $contacts;
    }

    public function store(Request $request){
      $contact = $request->all();
      $store = Contact::create($contact);
      if($store){
        return response('success', 200);
      }
      else{
        return response('failed', 500);
      }
    }

    public function edit($id){
      $contact = Contact::find($id);

      if($contact){
        return $contact;
      }
      else{
        return response('failed', 500);
      }
    }

    public function update(Request $request){
      $contact = $request->all();
      $update = Contact::find($contact['id'])->update($contact);
      if($update){
        return response('success', 200);
      }
      else{
        return response('failed', 500);
      }
    }

    public function destroy($id){
      $destroy = Contact::destroy($id);
      if($destroy){
        return response('success', 200);
      }
      else{
        return response('failed', 500);
      }
    }
}
