<?php

namespace App\Http\Livewire\Assignment;

use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $assignments, $date, $note;
    public $user;
    public $inputs = [];
    public $i = 1;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function store()
    {
        $this->validate([
            'date.0' => 'required',
            'note.0' => 'required',
            'date.*' => 'required',
            'note.*' => 'required',
        ],[
            'date.0.required' => 'Ruangan tarikh ini wajib diisi',
            'note.0.required' => 'Ruangan nota ini wajib diisi',
            'date.*.required' => 'Ruangan tarikh ini wajib diisi',
            'note.*.required' => 'Ruangan nota ini wajib diisi',
        ]);
        $user = Auth::user();

        if ($this->date) {
            foreach ($this->date as $key => $value) {
                $newAssignment = $user->assignments()->create(['date' => $this->date[$key], 'note' => $this->note[$key]]);
            }
        }

        $this->inputs = [];

        $this->resetInputFields();

        if ($this->date) {
            session()->flash('message', 'Contact Has Been Created Successfully.');
        }
    }

    private function resetInputFields(){
        $this->date = '';
        $this->note = '';
    }

    public function delete($id)
    {
        Assignment::find($id)->delete();

        session()->flash('message', 'Contact Has Been Deleted Successfully.');

    }

    public function render()
    {
        $this->assignments = Assignment::all();
        return view('livewire.assignment.create');
    }
}
