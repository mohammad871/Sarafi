<?php

namespace App\Http\Livewire;
use App\Models\Note;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Session;
class MyNote extends Component
{
    // for storing the edit model
    public $note;

    public $error = [];
    public $showEditModal   = false;
    public $showDeleteModal = false;

    // for getting all input data
    public $data = [];

    public function create() {
        $this->data = $this->error = [];
        $this->showEditModal = $this->showDeleteModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function store()
    {
        Validator::make($this->data, [
            'note'=> 'required'
        ])->validate();

        Note::create($this->data);
        $this->dispatchBrowserEvent('message', ['text'=> 'یاداشت جدید موفقانه اضافه گردید!', 'type'=> 'success']);
        $this->data = [];
    }

    public function edit(\App\Models\Note $note) {
        $this->showEditModal = true;
        $this->showDeleteModal = false;
        $this->note = $note;
        $this->dispatchBrowserEvent('show-form');
        $this->data = $note->toArray();
    }

    public function update() {
        Validator::make($this->data, [
            'note'=> 'required'
        ])->validate();

        $this->note->update($this->data);
        $this->dispatchBrowserEvent('message', ['text'=> 'تغیرات در یاداشت انجام شد!', 'type'=> 'success']);
        $this->dispatchBrowserEvent('hide-form');
    }

    public function destroy() {
        $this->data->delete();
        $this->dispatchBrowserEvent('message', ['text'=> 'message', 'یاداشت حذف شد', 'type'=> 'success']);
    }

    public function confirmDelete(\App\Models\Note $note) {
        $this->data = [];
        $this->dispatchBrowserEvent('show-form');
        $this->showDeleteModal = true;
        $this->data = $note;
    }

    public function render()
    {
        $notes = Note::all();
        return view('livewire.my-note', compact('notes'));
    }
}
