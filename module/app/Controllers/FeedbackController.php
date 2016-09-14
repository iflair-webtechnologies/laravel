<?php

namespace Villato\Http\Controllers;

use Mail;
use Villato\Http\Requests\FeedbackRequest;

class FeedbackController extends Controller
{
    public function postFeedback(FeedbackRequest $request)
    {
        $data = $request->only(['email', 'name', 'comment']);

        if ($user = $request->user()) {
            $data['email'] = $user->email;
            $data['name'] = $user->name;
        }

        $data['title'] = 'Villato Feedback';

        Mail::send('emails.feedback.user', $data, function ($message) use ($data) {
            $message->subject($data['title']);
            $message->from('info@villato.nl', 'Villato');
            $message->to($data['email']);
        });

        Mail::send('emails.feedback.admin', $data, function ($message) use ($data) {
            $message->subject($data['title'] . ' - ' . $data['name']);
            $message->from($data['email'], $data['name']);
            $message->to('info@villato.nl');
        });

        return response()->json([
            'success' => true,
            'message' => 'Uw feedback is verzonden.',
        ]);
    }

}