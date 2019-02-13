<form action="{{ route('schedule.update', $doctor) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="card card-shadow w-4/5 mx-auto">
        <div class="card-body">

            <div class=" p-4 -ml-5 border-l-4 border-teal-lighter">
                <p class="text-sm text-grey-darker font-gabriela">
                    * Required fields
                </p>
            </div>

            @for ($i = 0; $i < $business_days->count(); $i++)
                <fieldset>
                    <div class="flex">
                        <div class="flex-1 mr-1">
                            <div class="flex flex-col">
                                <label class="day-label">Day #{{ $i+1 }}
                                    @if ($i == 0)
                                        <span class="text-red text-lg">*</span>
                                    @endif
                                </label>
                                    <select name="days[{{ $i }}][day_id]" class="form-control">
                                        <option value="">Select a day</option>
                                        @foreach ($business_days as $day)
                                            <option value="{{ $day->id }}"
                                                {{ getSelected($day->id, old('days.'.$i.'.day_id') ?: $doctor->presentScheduledValue($i)) }}
                                            >
                                                {{ $day->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('days.'.$i.'.day_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('days.'.$i.'.day_id') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group flex-1 mr-1 {{ $i == 0 ? 'mt-1' : '' }}">
                            <div class="flex flex-col">
                                <label class="text-grey-dark">Start</label>
                                <input type="text" name="days[{{ $i }}][start_at]"
                                    class="form-control w-full" placeholder="00:00"
                                    value="{{ old('days.'.$i.'.start_at') ?: $doctor->presentScheduledValue($i, 'start_at') }}"
                                />

                                @if ($errors->has('days.'.$i.'.start_at'))
                                    <span class="invalid-feedback w-full" role="alert">
                                        <strong>{{ $errors->first('days.'.$i.'.start_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group flex-1 mr-1 {{ $i == 0 ? 'mt-1' : '' }}">
                            <div class="flex flex-col">
                                <label class="text-grey-dark">End</label>
                                <input type="text" name="days[{{ $i }}][end_at]"
                                    class="form-control w-full" placeholder="00:00"
                                    value="{{ old('days.'.$i.'.end_at') ?: $doctor->presentScheduledValue($i, 'end_at') }}"
                                />

                                @if ($errors->has('days.'.$i.'.end_at'))
                                    <span class="invalid-feedback w-full" role="alert">
                                        <strong>{{ $errors->first('days.'.$i.'.end_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </fieldset>
            @endfor
        </div>

        <div class="card-footer form-footer">
            <button type="submit" class="btn button-teal xl:float-right mr-1"
                name="submitbtn"
                value="doAndDisplay">
                {{ $btn_redirect }}
            </button>

            <button type="submit" class="btn button-teal xl:float-right mr-6"
                name="submitbtn"
                value="doAndRepeat">
                {{ $btn_back }}
            </button>
        </div>
    </div>

</form>