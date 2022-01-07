<div>
    <form action="{{ route('assignment.update') }}" method="POST">
        @method('PATCH')
        @csrf
        <div class="mb-4">
            <label for="supervisor" class="fw-bold form-label">Penyelia :</label>
            <input type="text" name="supervisor" value="{{ old('supervisor', $user->profile->supervisor ?? '') }}" class="form-control @error('supervisor')is-invalid @enderror">
            @error('supervisor') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
        <label class="fw-bold form-label">Tarikh dan catatan tugasan :</label>
        @if ($assignments->count() > 0)
            <table class="table border table-sm mb-1">
                    @php $bil = 1 @endphp
                    @foreach($assignments as $key => $value)
                        <tr class="align-middle">
                            <th class="text-center" style="width:5%">{{ $bil }}.</th>
                            <td style="width:20%">{{ $value->date ? $value->date->format('d/m/Y') : '--' }}</td>
                            <td>{{ $value->note }}</td>
                            <td class="text-center" style="width:5%">
                                <button type="button" wire:click="delete({{ $value->id }})" class="btn btn-link text-danger btn-sm"><i
                                        class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @php $bil++ @endphp
                    @endforeach
                {{-- </tbody> --}}
            </table>
        @endif
        {{-- <div class="row mb-1">
            <div class="col">
                <label for="date" class="visually-hidden">Tarikh Tugasan</label>
                <input type="date" name="assignments[0][date]" class="form-control @error('assignments.0.date')is-invalid @enderror" placeholder="Tarikh tugasan" wire:model="date.0">
                @error('assignments.0.date') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="col">
                <label for="note" class="visually-hidden">Catatan</label>
                <input type="text" name="assignments[0][note]" class="form-control @error('assignments.0.note')is-invalid @enderror" placeholder="Catatan" wire:model="note.0">
                @error('assignments.0.note') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="col">
                <button class="btn btn-success" wire:click.prevent="add({{ $i }})"><i class="fas fa-plus"></i></button>
            </div>
        </div> --}}
        @foreach($inputs as $key => $value)
        <div class="row g-3 mb-1">
            <div class="col">
                <label for="title" class="visually-hidden">Tarikh Tugasan</label>
                <input type="date" name="assignments[{{ $value }}][date]" class="form-control @error('assignments.'.$value.'date')is-invalid @enderror" placeholder="Tarikh tugasan" wire:model="date.{{ $value }}">
                @error('assignments.'.$value.'date') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="col">
                <label for="title" class="visually-hidden">Catatan</label>
                <input type="text" name="assignments[{{ $value }}][note]" class="form-control @error('assignments.'.$value.'note')is-invalid @enderror" placeholder="Catatan" wire:model="note.{{ $value }}">
                @error('assignments.'.$value.'note') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="col">
                <a class="btn btn-link btn-sm text-muted" wire:click.prevent="remove({{ $key }})">Padam</a>
            </div>
        </div>
        @endforeach
        <div class="mb-3">
            <a href="#" class="btn btn-link btn-sm text-muted px-0" wire:click.prevent="add({{ $i }})">Tambah tarikh dan catatan tugasan</a>
            {{-- <div class="form-text">
                Tambah tarikh dan nota berkaitan tugasan yang diberikan.
            </div> --}}
        </div>
        {{-- wire:click.prevent="store()" --}}
        <div class="my-4">
            <label for="manager" class="fw-bold form-label">Pelulus :</label>
            <select name="manager" id="manager" class="form-select @error('manager')is-invalid @enderror">
                <option value="">Sila pilih</option>
                <option value="1" {{ $user->profile->manager == 1 ? 'selected' : '' }}>Norhany Ishak</option>
                <option value="2" {{ $user->profile->manager == 2 ? 'selected' : '' }}>Norhadfizah Yusoff</option>
            </select>
            @error('manager') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
        <div class="my-5">
            <button class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
