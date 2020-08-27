<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact(Request $request){
        try{
            // Vérifié la valeur des données:
            $this->validate($request, [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'message' => 'required'
            ]);
            $data = [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'message' => $request->message
            ];
            // Envoie du mail:
            Mail::to('it.intersession.swapp@gmail.com')->send(new ContactMail($data));
            return ['type' => 'success', 'message' => 'Votre message a été transmis avec succès.'];
        }catch(\Swift_TransportException $e){
            return ['type' => 'error', 'code' => $e->getCode(),'message' => 'Un problème est survenue lors de l\'envoie du message, veuillez rééssayer plus tard', 'errorMessage' => $e->getMessage()];
        }
        catch(\Exception $e){
            return ['type' => 'error', 'code' => $e->getCode(),'message' => 'Un problème est survenue lors de l\'envoie du message, veuillez rééssayer plus tard', 'errorMessage' => $e->getMessage()];
        }
    }
}
