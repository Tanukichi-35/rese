<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InformationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Manager;

class MailController extends Controller
{
  // メール送信画面の表示
  public function mail(){
    return view('admin.mail');
  }

  public function send(Request $request){

    $text = $request->text;

    if($request->toUsers){
      $users = User::All();
      foreach ($users as $user) {
          $mail = new InformationMail();
          $name = $user->name;
          $mail->to($user->email, $name.'様')
                ->subject($request->subject)
                ->view('emails.information', compact('name', 'text'))
                ->text('emails.information_plain', compact('name', 'text'));

          Mail::send($mail);
      }
    }
    if($request->toManagers){
      $managers = Manager::All();
      foreach ($managers as $manager) {
          $mail = new InformationMail();
          $mail->to($manager->email, $manager->name.'様')
                ->subject($request->subject)
                ->view('emails.information', compact('name', 'text'))
                ->text('emails.information_plain', compact('name', 'text'));

          Mail::send($mail);
      }
    }

    if (count(Mail::failures()) > 0) {
        $message = 'メール送信に失敗しました';

        // 元の画面に戻る
        return back()->withErrors($messages);
    }
    else{
        $messages = 'メールを送信しました';

        // 別のページに遷移する
        return redirect()->route('admin.mail')->with(compact('messages'));
    }		
  }
}
