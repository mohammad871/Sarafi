<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $profile_photo_path;
    public $data = [];
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->edit();
    }

    public function edit() {
        $this->data = session()->get('user')->toArray();
    }

    public function update() {
        $result = true;
        \Illuminate\Support\Facades\Validator::make($this->data, [
            'name'=> 'required',
            'oldPassword'=> 'required'
        ])->validate();
        $user = session()->get('user');
        $dbPass = $user->password;
        if(Hash::check($this->data['oldPassword'], $dbPass)) {
            if($this->profile_photo_path) {
                $filename = $this->profile_photo_path->store('img', 'public');
                $oldPhoto = public_path()."\\storage\\img\\".$user->profile_photo_path;
                if(File::exists($oldPhoto)){
                    File::delete($oldPhoto);
                }
                $user->profile_photo_path = $this->profile_photo_path->hashName();
            }
            if(isset($this->data['newPassword']) && isset($this->data['newRePassword'])) {
                if($this->data['newPassword'] == $this->data['newRePassword']) {
                    $user->password = Hash::make($this->data['newPassword']);
                } else {
                    $result = false;
                    $this->dispatchBrowserEvent('message', ['type'=> 'error', 'text'=> 'پسورد جدید با تکرارش یکسان نیست!!!']);
                }
            }
            $user->name = $this->data['name'];
        } else {
            $result = false;
            $this->dispatchBrowserEvent('message', ['type'=> 'error', 'text'=> 'پسورد قبلی درست نیست دوباره کوشش نماید!!!']);
        }
        $user->save();
        session()->put('user', $user);
        if($result) {
            $this->dispatchBrowserEvent('message', ['type' => 'success', 'text' => 'پروفایل موفقانه تغیر یافت!!!']);
        }
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
