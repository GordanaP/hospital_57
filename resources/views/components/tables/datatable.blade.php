<main class="card card-body border-grey-lighter px-0" id="{{ $card_id }}">

    @if ($collection->count())
        <table class="table hover mt-2 admin-table" cellspacing="0" width="100%"
            id="{{ $table_id }}">

            <thead class="bg-grey-lightest text-grey-dark text-xs uppercase">

                <th>
                    @include('partials.form._checkbox')
                </th>

                {{ $slot }}

            </thead>

            <tbody></tbody>

        </table>
    @else
        @include('partials.table._empty')
    @endif

</main>