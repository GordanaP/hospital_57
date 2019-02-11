<th>Id</th>
<th>Name</th>
<th>Birthday</th>
@if (request()->route()->named('patients.index'))
    <th>Doctor</th>
@endif
<th></th>