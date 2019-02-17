<div class="collapse form-group mt-4">
    <select type="text" class="form-control rounded-sm border-grey-light select-collapsable"
        onchange="javascript:location.href = 'doctors/' + this.value + '/appointments'"
    >
        <option value="">Select a doctor</option>

        @foreach ($doctors as $doctor)
            <option value="{{ $doctor->id }}">
                {{ $doctor->title_name }}
            </option>
        @endforeach
    </select>
</div>