<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowButton extends Component
{
    private $profile;
    public $profile_id;
    public $following = "Follow";


    public function mount($profile_id)
    {
        $this->profile = User::find($profile_id);
        if ($this->profile != null && auth()->user() != null) {
            auth()->user()->following($this->profile) ? $this->following = "Unfollow" : $this->following = "Follow";
        }
    }

    public function ToggleFollowing($profile_id)
    {
        $this->profile = User::find($profile_id);
        if ($this->profile != null && auth()->user() != null) {
            auth()->user()->follows()->toggle($this->profile);
            auth()->user()->following($this->profile) ? $this->following = "Unfollow" : $this->following = "Follow";
            auth()->user()->setAccepted($this->profile);
        }
        else{
            redirect(route('login'));
        }
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
