<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Topics;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function Trainerindex() {
        return view('Trainer.Page.indexTrainer');
    }

    public function Profileindex() {
        $account=Auth::user();
        return view('Trainer.Page.Profile.profileAccount', compact('account'));
    }

    public function getUpdateProfile() {
        $account=Auth::user();
        return view('Trainer.Page.Profile.updateAccount', compact('account'));
    }

    public function postUpdateProfile(Request $request) {
        $user = Auth::user();

        $user->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'department' => $request->input('department'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('trainer.profile')->with('success', 'Profile updated successfully!');
    }

    public function Topicindex() {
        $user = Auth::user(); // Assuming the user is logged in
        $assignedTopics = DB::table('assigned_topics')
        ->join('human_resources', 'assigned_topics.trainer_id', '=', 'human_resources.id')
        ->join('topics', 'assigned_topics.topic_id', '=', 'topics.id')
        ->select(
            'assigned_topics.id', 
            'assigned_topics.trainer_id', 
            'human_resources.name as trainer_name', 
            'assigned_topics.topic_id', 
            'topics.name as topic_name',
            'topics.description'
        )
        ->where('trainer_id', $user->id)->get();
        return view('Trainer.Page.Topic.listTopic', compact('assignedTopics'));
    }

}
