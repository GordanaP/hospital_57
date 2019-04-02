<div class="card card-body bg-yellow-lightest py-2 mr-1" style="flex: 2">
    <p class="font-bold">Annual statistics:</p>
    <hr class="mt-1 mb-2">

    <div class="flex">
        <div class="bg-yellow-lightest mr-1 flex"
        style="flex: 1;">
            <div class="vertical-text bg-yellow-lightest"
            style="flex: 1; border-left: 1px dashed #dddddd; border-right: 1px dashed #dddddd;">
                <span class="font-bold text-grey-dark">Allowed</span>
            </div>
            <div class="bg-yellow-lightest mt-2 pl-2"
            style="flex: 10;">
                <div class="flex">
                    <div class="bg-yellow-lightest" style="flex: 3">
                        Annual leave entitlement
                    </div>
                    <div id="annual-leave-allowed" class="bg-yellow-lightest" style="flex: 1"></div>
                </div>
                <div class="flex">
                    <div class="bg-yellow-lightest" style="flex: 3">
                        Annual leave carried over
                    </div>
                    <div id="annual-leave-carried-over" class="bg-yellow-lightest" style="flex: 1"></div>
                </div>
                <div class="flex">
                    <div class="bg-yellow-lightest" style="flex: 3">
                        Total allowance / not taken
                    </div>
                    <div id="annual-leave-total" class="bg-yellow-lightest" style="flex: 1"></div>
                </div>
            </div>
        </div>

        <div class="bg-yellow-lightest ml-1 flex" style="flex: 1;">
            <div class="vertical-text bg-yellow-lightest"
            style="flex: 1; border-left: 1px dashed #dddddd; border-right: 1px dashed #dddddd;">
                <span class="ml-2 font-bold text-grey-dark">Taken</span>
            </div>
            <div class="flex bg-yellow-lightest pl-2"
            style="flex: 10;">
                <div style="flex: 1">
                    <div class="flex">
                        <div class="bg-yellow-lightest" style="flex: 3">
                            Annual leave
                        </div>
                        <div id="annual-leave-taken" class="bg-yellow-lightest" style="flex: 1">
                        </div>
                    </div>
                    <div class="flex">
                        <div class="bg-yellow-lightest" style="flex: 3">
                            Sick leave
                        </div>
                        <div id="sick-leave" class="bg-yellow-lightest" style="flex: 1">
                        </div>
                    </div>
                    <div class="flex">
                        <div class="bg-yellow-lightest" style="flex: 3">
                            Materinity
                        </div>
                        <div id="maternity" class="bg-yellow-lightest" style="flex: 1">
                        </div>
                    </div>
                    <div class="flex">
                        <div class="bg-yellow-lightest" style="flex: 3">
                            Training
                        </div>
                        <div id="training" class="bg-yellow-lightest" style="flex: 1">
                        </div>
                    </div>
                </div>

                <div style="flex: 1">
                    <div class="flex">
                        <div class="bg-yellow-lightest" style="flex: 3">
                            Bereavement
                        </div>
                        <div id="bereavement" class="bg-yellow-lightest" style="flex: 1"></div>
                    </div>
                    <div class="flex">
                        <div class="bg-yellow-lightest" style="flex: 3">
                            Family
                        </div>
                        <div id="family" class="bg-yellow-lightest" style="flex: 1"></div>
                    </div>
                    <div class="flex">
                        <div class="bg-yellow-lightest" style="flex: 3">
                            Other leave
                        </div>
                        <div id="other" class="bg-yellow-lightest" style="flex: 1"></div>
                    </div>

                    <div class="flex">
                        <div class="bg-yellow-lightest" style="flex: 3">
                            Unpaid leave
                        </div>
                        <div id="unpaid" class="bg-yellow-lightest" style="flex: 1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card card-body bg-yellow-lightest py-2 ml-1" style="flex: 1">
    <p class="font-bold">Legend: </p>
    <hr class="mt-1 mb-2">

    <div class="flex">
        <div class="mr-4">
            @foreach (\App\LeaveType::all() as $type)
                <div class="flex items-center">
                    <i class="fa fa-square mr-2" style="color: {{ $type->color }}"></i>
                    <span class="text-xs">{{ $type->name }}</span>
                </div>
                @if ($type->id == 4)
                    @break
                @endif
            @endforeach
        </div>
        <div class="ml-4">
            @foreach (\App\LeaveType::all() as $type)
                @if ($type->id >= 5)
                    <div class="flex items-center">
                        <i class="fa fa-square mr-2" style="color: {{ $type->color }}"></i>
                        <span class="text-xs">{{ $type->name }}</span>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>