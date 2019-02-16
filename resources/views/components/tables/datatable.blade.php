<div class="card card-body border-grey-lighter card-shadow px-0">

    @if ($collection->count())
        <table class="table hover mt-2 admin-table" cellspacing="0" width="100%"
            id="{{ $table_id }}">

            <thead class="bg-grey-lightest text-grey-dark text-xs uppercase">

                <th>
                    <label class="checkbox-container mb-4"><input type="checkbox"
                        id="checkAll{{ ucfirst($items) }}">

                        <span class="checkmark"></span>

                    </label>
                </th>

                {{ $slot }}

            </thead>

            <tbody></tbody>

        </table>
    @else
        @include('partials.table._empty')
    @endif

</div>