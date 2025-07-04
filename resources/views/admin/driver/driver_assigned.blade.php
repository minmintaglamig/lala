<table>
    <thead>
        <tr>
            <th>CLIENT NAME</th>
            <th>CLIENT CONTACT</th>
            <th>PICKUP ADDRESS</th>
            <th>DROPOFF ADDRESS</th>
            <th>PACKAGE DESCRIPTION</th>
            <th>SCHUDULED TIME</th>
            <th>STATUS</th>
            <th>VEHICLE TYPE</th>
            <th>DISTANCE</th>
            <th>PRICE</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($jobs as $job)
            <tr>
                <td>{{ $job->client_name }}</td>
                <td>{{ $job->client_contact }}</td>
                <td>{{ $job->pickup_address }}</td>
                <td>{{ $job->dropoff_address }}</td>
                <td>{{ $job->package_description }}</td>
                <td>{{ $job->scheduled_time }}</td>
                <td>{{ $job->delivery_status }}</td>
                <td>{{ $job->vehicle_type }}</td>
                <td>{{ $job->distance }}</td>
                <td>{{ $job->price }}</td>
                <td>
                    <a href="#">ACCEPT</a>
                    /
                    <a href="#">REJECT</a>
                </td>
            </tr>
        @empty
            <tr>

            </tr>
        @endforelse
    </tbody>
</table>
